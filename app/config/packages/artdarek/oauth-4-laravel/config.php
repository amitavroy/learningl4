<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),		
	        'Google' => array(
	                'client_id'     => '725897332478-dfpptsitk6t3iu4nk6sm2njrpo7q6bm5.apps.googleusercontent.com',
	                'client_secret' => '1iQmfNcM2Slau2fjNA14Odtk',
	                'scope'         => array('userinfo_email', 'userinfo_profile'),
	        ),
	)

);