<?php
                                    require_once '../vendor/autoload.php';
                                    // init configuration
                                    $clientID = '485342405162-e47laijejt48r2ogqhmagnt0bha4j3q2.apps.googleusercontent.com';
                                    $clientSecret = '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';
                                    $redirectUri = 'http://localhost/restaurant-main/page/login.php';
                                    // create Client Request to access Google API
                                    $client = new Google_Client();
                                    $client->setClientId($clientID);
                                    $client->setClientSecret($clientSecret);
                                    $client->setRedirectUri($redirectUri);
                                    $client->addScope("email");
                                    $client->addScope("profile");

                                    // authenticate code from Google OAuth Flow
                                    if (isset($_GET['code'])) {
                                    
                                    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                                    $client->setAccessToken($token['access_token']);
                                    
                                    // get profile info
                                    $google_oauth = new Google_Service_Oauth2($client);
                                    $google_account_info = $google_oauth->userinfo->get();
                                    $userinfo = [
                                        'gg_email'=> $google_account_info['email'],
                                        'gg_fullname' => $google_account_info['name'],
                                        'gg_verifiedEmail' => $google_account_info['verifiedEmail'],
                                        'gg_token' => $google_account_info['id'],
                                    ];
                                    $_SESSION['dangnhap_home'] = $google_account_info->name;
                                    header('Location: login.php');
                                    // now you can use this profile info to create account in your website and make user logged in.
                                    }
                                    
?>