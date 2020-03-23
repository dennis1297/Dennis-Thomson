<?php 
include("config.php");

try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  
  if (! isset($accessToken)) {
    header("Location:".URL);
    exit;
  }
  
  // The OAuth 2.0 client handler helps us manage access tokens
  $oAuth2Client = $fb->getOAuth2Client();
    
  if (! $accessToken->isLongLived()) 
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    $response = $fb->get('/me?fields=id,email,last_name,first_name', $accessToken);
    $user = $response->getGraphUser();
    $_SESSION['fb_access_token'] = (string) $accessToken;

    $res=mysqli_query($conn,"select email from tbl_customer where email='".$user['email']."' limit 1");
    if(mysqli_num_rows($res) > 0){		
      $cus=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where email='".$user['email']."' limit 1"));

      $_SESSION["cus_id"]=$cus["customer_id"];
			$_SESSION["cus_group_id"]=$cus["customer_group_id"];
			$_SESSION["fname"]=$cus["firstname"];
      $_SESSION["lname"]=$cus["lastname"];
      $_SESSION["reg_type"]=$cus["reg_type"];

			$duration = time()+ 3600 * 24 * 60;
			setcookie('cus_id', $cus["customer_id"], $duration, "/");
			setcookie('cus_group_id', $cus["customer_group_id"], $duration, "/");
			setcookie('fname', $cus["firstname"], $duration, "/");
      setcookie('lname', $cus["lastname"], $duration, "/");
      setcookie('reg_type', $cus["reg_type"], $duration, "/");      
      setcookie('fb_access_token', $_SESSION['fb_access_token'], $duration, "/");

      header("Location:".URL);
    }
    else{
      $ins = mysqli_query($conn,"insert into tbl_customer(customer_group_id,firstname,lastname,email,mobileno,password,status,date_added,reg_type) values ('1','".$user['first_name']."','".$user['last_name']."','".$user['email']."','','','1','".date("Y-m-d H:i:s")."','facebook')");
      $cus_id = mysqli_insert_id($conn);
      if($ins){
        $cus=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id='$cus_id'"));
        $_SESSION["cus_id"]=$cus["customer_id"];
        $_SESSION["cus_group_id"]=$cus["customer_group_id"];
        $_SESSION["fname"]=$cus["firstname"];
        $_SESSION["lname"]=$cus["lastname"];
        $_SESSION["reg_type"]=$cus["reg_type"];
  
        $duration = time()+ 3600 * 24 * 60;
        setcookie('cus_id', $cus["customer_id"], $duration, "/");
        setcookie('cus_group_id', $cus["customer_group_id"], $duration, "/");
        setcookie('fname', $cus["firstname"], $duration, "/");
        setcookie('lname', $cus["lastname"], $duration, "/");
        setcookie('reg_type', $cus["reg_type"], $duration, "/");
        setcookie('fb_access_token', $_SESSION['fb_access_token'], $duration, "/");
      }
      header("Location:".URL);
    }

?>