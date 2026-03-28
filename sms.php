<?php 
header("Content-Type: text/html; charset=utf-8");
function sendSMS($oursmsusername,$oursmspassword,$messageContent,$mobileNumber,$senderName)
{
$user = $oursmsusername;
$password = $oursmspassword;
$sendername = $senderName;
$text = urlencode( $messageContent);
$to = $mobileNumber;
// auth call
 
$url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=full";
//echo  $url;die();
//لارجاع القيمه json
//$url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=json";
// لارجاع القيمه xml
//$url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=xml";
// لارجاع القيمه string 
//$url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E";
// Call API and get return message
//fopen($url,"r");
 
// $ret = file_get_contents($url);
// echo nl2br($ret);

  $curl_handle=curl_init();
  curl_setopt($curl_handle,CURLOPT_URL,$url);
  curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
  curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
  $buffer = curl_exec($curl_handle);
  curl_close($curl_handle);
  if (empty($buffer)){
      print "Nothing returned from url.<p>";
  }
  else{
      print $buffer;
  }
  
}
 
//قم بستبدال المتغيرات في السطر التالي بالقيمه الخاصه بها 
 
// sendSMS('AhmedNAbil','CC123123@','test msg','972597233620','alfayez');
sendSMS('AhmedNAbil','CC123123@','test msg','972597233620','4jawaly.net');
 
?>
























<?php
/*
////////////////////////////////by Yasir Alsarmi////////////////////////////
$url = 'http://api.yamamah.com/SendSMSV2';
// $url = 'http://api.yamamah.com/SendSMSV3';
// $url = 'http://api.yamamah.com/SendSMS';

$fields = array(	
	
	"username"=> "966555080909",
	"password"=> "0555080909",
	"Tagname"=>  "0555080909",
// 	"RecepientNumber"=> "0538490899,966540088878,00972597233620",
	"RecepientNumber"=> "0538490899‬",
	"VariableList"=> "",
	"ReplacementList"=> "",
	"Message"=> "test Message",
	"SendDateTime"=> 0,
	"EnableDR"=> False
  );


 
$fields_string=json_encode($fields);
//open connection
$ch = curl_init($url);
curl_setopt_array($ch, array(
    CURLOPT_GET => TRUE,
    // CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
       'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => $fields_string
));
//execute post
$result = curl_exec($ch);
echo $result;
//close connection
curl_close($ch);
////////////////////////////////by Yasir Alsarmi////////////////////////////
*/
?>