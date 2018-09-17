<?php
  require('textlocal.class.php');
  require('credential.php');
  //un-comment the code after adding the API_KEY
 //$textlocal = new Textlocal(false,false, API_KEY);
  $numbers = array($_POST['mob']);
  $sender = 'TXTLCL';
  $otp = mt_rand(10000,99999);
  $message = 'Hello'.$_POST['name'].'This is your OTP '.$otp;
  try{
       // $result = $textlocal->sendSms($numbers, $message, $sender);
  		$result ="success";
	    if ($result)
	    {
	     setcookie("otp",$otp);
	    }	      
    }
    catch (Exception $e) {
      die('Error: ' . $e->getMessage());
    }
  echo $message;
?>