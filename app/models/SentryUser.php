<?php

/**
 * This class will handle all of the Sentry user functionalities. 
 * The user details table which is used to maintain the data for O Auth 
 * is also handled from this class. 
 * @author Amitav Roy
 *
 */
class SentryUser extends Eloquent
{

  /**
   * This function will check if the user exist in the Sentry user table.
   * Will return true or false accordingly.
   *
   * @param string $email          
   * @return boolean
   */
  public function checkIfUserExist ($email)
  {
    $user = DB::table('users')->where('email', '=', $email)->first();
    if ($user)
      return $user;
    else
      return false;
  }

  /**
   * This funtion will take the O Auth data which we get after authentication 
   * and return the prepared array ready for save or udpate to the users_detail table.
   * @param unknown $result
   * @return multitype:unknown number
   */
  private function userDataFromOAuth ($result)
  {
    $userData = array(
        'oauth_id' => $result['id'],
        'oauth_email' => $result['email'],
        'oauth_name' => $result['name'],
        'oauth_given_name' => $result['given_name'],
        'oauth_family_name' => $result['family_name'],
        'oauth_link' => $result['link'],
        'oauth_picture' => $result['picture'],
        'oauth_gender' => $result['gender'],
        'oauth_updated' => time()
    );
    
    return $userData;
  }

  /**
   * This function will get the prepared O Auth data and update the user_details table.
   * This function is called every time a user is loggin in to udate his profile info.
   * @param unknown $result
   * @return return the udpated row.
   */
  public function updateUserProfile ($result)
  {
    // getting the user data from OAuth
    $userData = $this->userDataFromOAuth($result);
    
    // updating the table
    DB::table('user_details')->where('oauth_email', $result['email'])->update(
        $userData);
    
    // get the row which was updated.
    $row = DB::table('user_details')->where('oauth_email', $result['email'])->first();
    
    return $row;
  }

  /**
   * This function will create a new user using Sentry and also insert a new record in user_details table.
   * This function takes the array from O Auth and after preping it, does the further steps.
   * @param unknown $result
   * @return unknown
   */
  public function createUserProfile ($result)
  {
    // creating the sentry user
    $sentryUser = $this->createSentryUser($result);
    
    // getting the user data from OAuth
    $userData = $this->userDataFromOAuth($result);
    $userData['user_id'] = $sentryUser['id']; // setting the id from the sentry
                                              // user table.
                                              
    // inserting the data
    $id = DB::table('user_details')->insertGetId($userData);
    
    // fetch the row which was inserted
    $row = DB::table('user_details')->where('oauth_email', $result['email'])->first();
    
    return $row;
  }

  /**
   * This private function is creating the Sentry user only.
   * @param unknown $result
   * @return unknown
   */
  private function createSentryUser ($result)
  {
    // Create the user
    $sentryUser = Sentry::createUser(
        array(
            'email' => $result['email'],
            'password' => time() . rand(999, 9999),
            'activated' => true,
            'first_name' => $result['given_name'],
            'last_name' => $result['family_name']
        ));
    
    return $sentryUser;
  }

  /**
   * This function will login a user based on the user id provided and set the session data accordingly.
   * @param unknown $userId
   */
  public function loginUser ($userId)
  {
    $thisUser = Sentry::findUserById($userId);
    Sentry::login($thisUser, true);
    Session::put('checkAuth', 'true');
    Session::put('authUser', $this->getFullUserDetails($userId));
  }

  /**
   * This function is accumulating the sentry user and also adding the user_details table details of a user. 
   * This can be always called instead of Snetry user to get all user details.
   * @param unknown $userId
   * @return unknown
   */
  public function getFullUserDetails ($userId)
  {
    $thisUser = Sentry::findUserById($userId);
    $thisUser['user_details'] = DB::table('user_details')->where('user_id', 
        $userId)->first();
    
    return $thisUser;
  }
}