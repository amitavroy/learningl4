<?php
use Illuminate\Support\Facades\Redirect;

class UserController extends BaseController
{

    protected $layout = 'html';

    public function handleLoginPage()
    {
        // get data from input
        $code = Input::get('code');
        
        // get google service
        $googleService = OAuth::consumer('Google');
        
        // if code is provided get user data and sign in
        if (! empty($code)) {
            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);
            
            // Send a request with it
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
            
            $user = new SentryUser();
            if ($user->checkIfUserExist($result['email'])) {
                // update the profile of the user
                $currentUser = $user->updateUserProfile($result);
                
                // login the user using entry authentication
                $user->loginUser($currentUser->user_id);
            } else {
                // create profile of the user in sentry and add user details
                // from OAuth
                $currentUser = $user->createUserProfile($result);
                
                // login the user using entry authentication
                $user->loginUser($currentUser->user_id);
            }
            
            return Redirect::to('o-auth/dashboard/' . $currentUser->user_id);
        } else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();
            
            // return to facebook login url
            return Redirect::to((string) $url);
        }
    }

    public function logout()
    {
        Sentry::logout();
        Session::flush();
        return Redirect::to('/');
    }

    public function handleDashboardPage($userId)
    {
        $User = new SentryUser();
        $currentUser = $User->getFullUserDetails($userId);
        $this->layout->menu = true;
        $this->layout->sidebar = false;
        $this->layout->content = View::make('oauth.login-page')->with('user', $currentUser);
    }
}