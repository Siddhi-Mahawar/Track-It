<?php
	include_once 'src/Google_Client.php';
	include_once 'src/contrib/Google_Oauth2Service.php';
	
	// Edit Following 3 Lines
	$clientId = '565982764567-mns8gk5r4abil16rl3lrbn85sjrrqbub.apps.googleusercontent.com'; //Application client ID
	$clientSecret = 'fpwThx-epLv6jioZbIIuGQ0P'; //Application client secret
	$redirectURL = 'https://localhost/Tvtracker/'; //Application Callback URL
	
	$gClient = new Google_Client();
	$gClient->setApplicationName('Tvtracker');
	$gClient->setClientId($clientId);
	$gClient->setClientSecret($clientSecret);
	$gClient->setRedirectUri($redirectURL);
	$google_oauthV2 = new Google_Oauth2Service($gClient);
?>