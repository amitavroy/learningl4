<?php

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
                'oauth_updated' => time(),
        );
        
        return $userData;
    }

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

    public function createUserProfile ($result)
    {
        // creating the sentry user
        $sentryUser = $this->createSentryUser($result);
        
        // getting the user data from OAuth
        $userData = $this->userDataFromOAuth($result);
        $userData['user_id'] = $sentryUser['id']; // setting the id from the sentry user table.
        
        // inserting the data
        $id = DB::table('user_details')->insertGetId($userData);
        
        // fetch the row which was inserted
        $row = DB::table('user_details')->where('oauth_email', $result['email'])->first();
        
        return $row;
    }

    private function createSentryUser ($result)
    {
        // Create the user
        $sentryUser = Sentry::createUser(
                array(
                        'email' => $result['email'],
                        'password' => time() . rand(999, 9999),
                        'activated' => true,
                        'first_name' => $result['given_name'],
                        'last_name' => $result['family_name'],
                ));
        
        return $sentryUser;
    }
    
    public function loginUser($userId)
    {
        $thisUser = Sentry::findUserById($userId);
        Sentry::login($thisUser, true);
        Session::put('checkAuth', 'true');
        Session::put('authUser', $this->getFullUserDetails($userId));
    }
    
    public function getFullUserDetails($userId)
    {
        $thisUser = Sentry::findUserById($userId);
        $thisUser['user_details'] = DB::table('user_details')->where('user_id', $userId)->first();
        
        return $thisUser;
    }
}