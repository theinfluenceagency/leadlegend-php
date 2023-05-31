       
<?php
//Process a new form submission in HubSpot in order to create a new Contact.

$hubspotutk      = $_COOKIE['lltk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$pageUrl         = "";
$pageName        = "Contact Us";
// $ll_context      = array(
//  'lltk' => $lltk,
//  'ipAddress' => $ip_addr,
//  'pageUrl' =>"www.example.com/contact_us",
//  'pageName' => "Contact Us"
// );



$ll_context      = array(
 'lltk' =>"cookie",
 'ipAddress' => "ipaddress",
 'pageUrl' => "www.example.com/contact_us",
 'pageName' => "Contact Us"
);

$ll_context_json = json_encode($ll_context);

//Need to populate these variable with values from the form.
// $str_post = "firstName=" . urlencode($firstName) 
//  . "&lastName=" . urlencode($lastName) 
//  . "&email=" . urlencode($email) 
//  . "&phone=" . urlencode($phoneNumber) 
//  . "&company=" . urlencode($company) 
//  . "&message=" . urlencode($message) 
//  . "&ll_context=" . urlencode($ll_context_json); //Leave this one be


foreach ($_COOKIE as $key=>$val) {
  if (strpos($key, '_pk_id') !== false) {
    $keyName=$key;
}
}
$value=$_COOKIE[$keyName];
$keyArr=explode(".",$keyName);
$accountId=$keyArr[1];
$valArr=explode(".",$value);
$visitorId=$valArr[0];
$sessionId=$valArr[1];
$visit=$valArr[2];

// $str_post = "contactName=" . urlencode($contactName).
// 	"&accountId=".urlencode($accountId) .
// 	"&visitorId=".urlencode($visitorId) .
// 	"&email=".urlencode($email) .
// 	"&phoneNumber=" .urlencode($phoneNumber) .
// 	"&companyName=".urlencode($companyName);

$str_post = "contactName=" . urlencode("name").
	"&accountId=".urlencode("5dbfd2bc5146882975a63ae4") .
	"&visitorId=".urlencode("1234") .
	"&email=".urlencode("aswanth@hubspire.com") .
	"&phoneNumber=" .urlencode("7737776376") .
	"&companyName=".urlencode("Hubspire");

	// $str_post = "contactName=" . urlencode($contactName).
	// "&accountId=".urlencode($accountId) .
	// "&visitorTrackingId=".urlencode($visitorId) .
	// "&sessionId=".urlencode($sessionId) .
	// "&visit=".urlencode($visit) .
	// "&email=".urlencode($email) .
	// "&phoneNumber=" .urlencode($phoneNumber) .
	// "&companyName=".urlencode($companyName);

	



//replace the values in this URL with your ID and your GUID
$endpoint = 'http://35.182.231.171:3010/api/contacts/contactSubmit';

$ch = @curl_init();
@curl_setopt($ch, CURLOPT_POST, true);
@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
 'Content-Type: application/x-www-form-urlencoded'
));
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); //Log the response from HubSpot as needed.
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
@curl_close($ch);
echo 'status code starts here';
echo $status_code . " " . $response;
echo 'status code end here';

?>
