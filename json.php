<!doctype html>
<html lang="en">

<head>
	<link href="http://fonts.googleapis.com/css?family=Terminal+Dosis" rel="stylesheet" type="text/css" />
	<style>
		body {background: #F4F4F4;color: #000000;font-family: verdana,Arial,Helvetica,sans-serif;font-size: 11px;margin: 0 auto;padding: 20px}
		div {padding: 10px;margin: 10px;background: #f2f1f0;border: 1px solid #ddd}
		label { display: inline-block; margin-bottom:5px;width: 100px}
		input {border: 1px solid #343434;padding:2px;font-size: 10px}
	</style>
	
</head>

<body>



<?php
// Get remote file contents, preferring faster cURL if available
function remote_get_contents($url)
{
        if (function_exists('curl_get_contents') AND function_exists('curl_init'))
        {
                return curl_get_contents($url);
        }
        else
        {
                // A litte slower, but (usually) gets the job done
                return file_get_contents($url);
        }
}

function curl_get_contents($url)
{
        // Initiate the curl session
        $ch = curl_init();
        
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Removes the headers from the output
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        // Return the output instead of displaying it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // Execute the curl session
        $output = curl_exec($ch);
        
        // Close the curl session
        curl_close($ch);
        
        // Return the output as a variable
        return $output;
}


if (isset($_POST["usr"])&&isset($_POST["pwd"])&&isset($_POST["check"]))
{
	$username	= trim($_POST["usr"]);
	$password	= trim($_POST["pwd"]);
	$email		= trim($_POST["check"]);
	$api_url	= 'http://api.verify-email.org/api.php?';
	
	
	$url		= $api_url . 'usr=' . $username . '&pwd=' . $password . '&check=' . $email;
	$object		= json_decode(remote_get_contents($url));
	
	echo '<div id="response">';
	echo 'The email address ' . $email . ' is ' . ($object->verify_status?'GOOD':'BAD or cannot be verified') . '<br/>';
	echo 'authentication_status - ' . $object->authentication_status . ' (your authentication status: 1 - success; 0 - invalid user)<br/>';
	echo 'limit_status - ' . $object->limit_status . ' (1 - verification is not allowed, see limit_desc; 0 - not limited)<br/>';
	echo 'limit_desc - ' . $object->limit_desc . '<br/>';
	echo 'verify_status - ' . $object->verify_status . ' (entered email is: 1 - OK; 0 - BAD)<br/>';
	echo 'verify_status_desc - ' . $object->verify_status_desc . '<br/>';
	echo '</div>';
}

?>


<div>
	
	<form id="myForm" method="post" class="searchform" action="">
		<label>User Name</label><input type="text" name="usr" /><br/>
		<label>Password</label><input type="text" name="pwd" /><br/>
		<label>Email</label><input type="text" name="check" /><br/>
		<input type="submit" name="submitEmail" value="Verify"><br/>
	</form>
	
</div>

</body>
</html>