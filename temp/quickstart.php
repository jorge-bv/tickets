<?php
require __DIR__ . '/vendor/autoload.php';

//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    $client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
   
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));
//     $authCode='4/xgFd66a78AtjgjJXQgsBXk0a5wmKfqdWApmAMUi-T5FOTCDmtZAuGwk';

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);
//
//            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
//        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
   
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);

// Print the labels in the user's account.
$user = 'me';
$time = strtotime(date('H:i:s', time()) . '-24 hour');
$results = $service->users_messages->listUsersMessages('me', ['q' => "in:inbox after:" . $time]);

if (count($results->getMessages()) == 0) {
  print "No messages found.\n";
} else {
  foreach ($results->getMessages() as $message) {
//          $_message = $service->users_threads->get($user, $message->threadId);
//          $ll=$_message->getMessages();
      
 
    $id = $message->getId();
    
$_message = $service->users_messages->get($user, $id);
$email = NULL;




$asunto = NULL;
$resp= FALSE;
foreach ($_message["payload"]["headers"] as $num => $item) {
    if($item["name"]==="In-Reply-To")
    {
      $resp=TRUE;
      
    }  else {
        
    
     if ($item["name"] === "From") {
        $email = $item['value'];
        $email2 = preg_replace("[\<|\>]", "", $email);
       
    }
    if ($item["name"] === "Subject") {
        $asunto = $item["value"];
        $asunto2= str_replace(" ","/",$asunto);
     
    }
    }
}
if($resp==TRUE)
{

    continue;
}
         
$match = NULL;
preg_match("([^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+)", $email2, $match);
$email3 = $match[0];
  $email4 = str_replace("@", "ARROBA", $email3);

  


   //$correox='bravov.joARROBAgmail.com';
   $output = NULL;
$code = NULL;


  $result= exec("php C:/xampp/htdocs/gestion-ticket/index.php gestion nueva_solicitud_correo ".$email4." ".urlencode($asunto2)." ".$id,$output,$code);

//print_r(urlencode($asunto));
 // print_r($asunto);
  
  }


  
}
