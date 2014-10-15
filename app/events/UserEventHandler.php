<?php

class UserEventHandler {
    
    /**
     * Handling the user login event
     */
    public function onUserLogin($user)
    {
        $thisUser = new User;

        /**
         * Updating an entry to the user table when the user last logged in.
         */
        $thisUser->updateLastLoggedIn($user->id);
    }

    /**
     * Subbscribing to the events and registerign the function 
     * from this class.
     */
    public function subscribe($events)
    {
        $events->listen('user.login', 'UserEventHandler@onUserLogin');
    }
}