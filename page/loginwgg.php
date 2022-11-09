<?php
                                    require_once '../vendor/autoload.php';
                                    session_start();
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
                                    $sql = "SELECT * FROM tbl_accgg WHERE gg_email = '{$userinfo['email']}'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result)>0){
                                        $userinfo = mysqli_fetch_assoc($result);

                                    }else {
                                        $sql = "INSERT INTO tbl_accgg(gg_firstname,gg_lastname,	gg_email,gg_fullname,gg_verifiedEmail,gg_token) VALUES ('{$userinfo['first_name']}','{$userinfo['last_name']}',
                                        '{$userinfo['email']}','{$userinfo['full_name']}','{$userinfo['verifiedEmail']}','{$userinfo['token']}')";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            
                                            $token = $userinfo['token'];
                                        }else {
                                            echo "User is not created!";
                                            die();
                                        }
                                    }
                                    $_SESSION['user_token'] = $token;
                                    $sql = "SELECT * FROM tbl_accgg WHERE gg_token = '{$SESSION['gg_token']}'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result)>0){
                                        $userinfo = mysqli_fetch_assoc($result);

                                    }
                                    else{

                                    }
                                    // now you can use this profile info to create account in your website and make user logged in.
                                    } else {
                                    echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
                                    }   
?>