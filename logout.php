<?php 
	require_once "config.php";
	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: login.php');
		exit();
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$YOUR_SITE_URL = "https://fbloginbap.herokuapp.com/login.php";
	$url = 'https://www.facebook.com/logout.php?next=' . $YOUR_SITE_URL .
  '&access_token='.$accessTokentoken;
	session_destroy();
	header('Location: '.$url);

?>