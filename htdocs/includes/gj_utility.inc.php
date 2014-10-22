<?php
/**
* gj_utiltiy.inc.php
*
*
* @category Testing
* @package  utility
* @author   Gary Johnson <gary_johnson_53@hotmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://garyjohnsoninfo.info

add a javascript to update a cookie onstead of using ob_start
*/
function gjerror_log($strin) {
global $gjDebug;

    if (isset($gjDebug) && $gjDebug) {
        error_log($strin);
    }
}
//I want a way to pass variables back and forth, this does not work yet
//I think I will need to use a session variable
function js_SetVar($gjVar) {
    echo "<script language=\"JavaScript\">\n";
//echo "gjDebug = '".$gjDebug."';\n";
    echo "$gjVar = '".$gjVar."';\n";
    echo "</script>\n";
return true;
}

function js_redirect($url, $millseconds=5) {
    echo "<script language=\"JavaScript\">\n";
    echo "function redirect() {\n";
    echo "window.location = \"" . $url . "\";\n";
    echo "}\n";
    echo "timer = setTimeout('redirect()', '" . ($millseconds) . "');\n";
    echo "</script>\n";
return true;
}

function mailMe($ok, $to, $subject, $msg) {
    if($ok) {
        error_log ( "No Mail on local  message " .$msg );
    return;
    }

  //to for multiple addresses is gj@mail.com,gj2@mail.com
  //http://php.net/manual/en/function.mail.php

    $headers   = 'From: gj@garyjohnsininfo.info' . "\r\n";
    $headers  .='Reply-To: gj@garyjohnsininfo.info' . "\r\n";
    $headers  .='X-Mailer: PHP/' . phpversion();

    $msg = wordwrap($msg, 70, "\r\n");

    if (mail($to, $subject, $msg, $headers)) {
        //error_log ( "Mail Sent  " .$to. " message " .$msg );
        error_log ( "Mail Sent  " .$to );
    } else {
        error_log ( "Mail Failed  " .$to. " message " .$msg );
    }
}

function mailMeHTML($ok, $to,$subject,$msg) {
    if($ok) {
        error_log ( "No Mail on local  message " .$msg );
    return;
    }

    //$subject  = 'Message from garyjohnsonininfo';
    $headers  = 'From: gj@garyjohnsininfo.info' . "\r\n";
    $headers .= 'Reply-To: noreply@noreply.com' . "\r\n" ;
    $headers .= 'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-Type: text/html; charset=utf-8'. "\r\n";
    if (mail($to, $subject, $msg, $headers)) {
        error_log ( "HTML Mail Sent  " .$to  );
    } else {
        error_log ( "HTML Mail Failed  " .$to. " message " .$msg );
    }
}

function checktext($strin) {
    //'      -          .       0-  9        A-  Z      `        a-   z   sp     ?  ?       ?  ?      ?
    // [\x27\x2D\x2E\x30-\x39\x41-\x5a\x60\x61-\x7a\s\xC0-\xD6\xD8-\xF6\xF8-\xFF]+;

    $gjret =preg_match('/[\x27\x2D\x2E\x30-\x39\x41-\x5a\x60\x61-\x7a\s\xC0-\xD6\xD8-\xF6\xF8-\xFF]+/', $strin,$strmatched);
    if (count($strmatched)) {
        $gjtmp = strlen($strmatched[0]);
        $ok = ($gjtmp === strlen($strin) ? true : false);
    } else {
        $ok = false;
    }

    if ($ok) {
        $gjret2 =preg_match_all('/\x27/', $strin,$strmatched);
        if ($gjret2 && isset($strmatched[0][1])) {
            //echo "More than one single quote  ".$strin. "<br />";
            return false; // More than one single quote
        } else {
            //echo "we are good  ".$strin. "<br />";
            return true; // yippe
        }
    } else {
        //echo "not matched  ".$strin. "<br />";
        return false; //not my extended alpaha
    }
}

function checkemail($strin) {
    $email = htmlentities($strin);
    if (!(preg_match('/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/', $email))) {
        return false;
    }
    return true;
}

function logToFile($msg) {
  $fd = fopen("logfile.txt", "a");
    if($fd) {
      $str = "[" . date("Y/m/d h:i:s", time() + 18000) ."] " . $msg;
      fwrite($fd, $str . "\n");
      fclose($fd);
    } else {
      error_log("+++***".$msg,0); //php system logger
    }
}


//old use generatedebugreport instead

function displaydefinedVariables($gjarrayIn)
{
echo '<h1>defined variables</h1>';
echo '<table class="pt"><tr><th>variable</th> <th>value</th> </tr>';
foreach ($gjarrayIn as $key => $value) {
    if (is_array ($value)) {
        echo '<tr><td>$'.$key . '</td><td>';
        if ( sizeof($value)>0 ) {
            echo '<table class="ft"><tr> <th>key</th> <th>value</th> </tr>';
            foreach ($value as $skey => $svalue) {
               //Array to string conversion
                echo '<tr><td>[' . $skey .']</td><td>"'. $svalue .'"</td></tr>';
            }
            echo '</table>"';
        } else {
            echo 'EMPTY';
        }
        echo '</td></tr>';
    } else {
        echo '<tr><td>$' . $key .'</td><td>"'. $value .'"</td></tr>';
    }
}
echo '</table>';
echo "<HR>";
}

/* set gjLocal to true and call */

function gjShowErrors() { //call this first after session start
error_reporting(E_ALL); //for test if sessionstart put it after error_reporting
ini_set('display_errors',1);  // 1 to display errors
ini_set('log_errors',1);

global $gjDebug;
global $gjLocal;

//usually have to set this in php.ini
//xdebug_disable();
//xdebug.collect_assignments
ini_set('xdebug.collect_includes', '1');
ini_set('xdebug.collect_params', '1'); //terse is 1
ini_set('xdebug.collect_return', '1');
ini_set('xdebug.collect_vars', '1'); //for xdebug_get_declared_vars().
//xdebug.coverage_enable
ini_set('xdebug.default_enable', '1');

ini_set('xdebug.dump.SERVER', 'REQUEST_URI,REQUEST_METHOD');
ini_set('xdebug.dump.GET', '*');
ini_set('xdebug.dump.SESSION', '*');
ini_set('xdebug.dump.REQUEST', '*');
ini_set('xdebug.dump.FILES', '*');
ini_set('xdebug.dump.COOKIE', '*');
ini_set('xdebug.dump_globals', '1');

//xdebug.dump_undefined
//xdebug.extended_info  only in php.ini
//xdebug.file_link_format for IDE
//xdebug.idekey
//xdebug.manual_url ,link to php manual  defualt http://www.php.net
ini_set('xdebug.max_nesting_level', '50');
//xdebug.overload_var_dump
//xdebug.profiler_append
//xdebug.profiler_enable
// ... more profiler options
// ... more remote options
ini_set('xdebug.scream', '1');
// xdebug.show_exception_trace
ini_set('xdebug.show_local_vars', '1');
//xdebug.show_mem_delta
//xdebug.trace_enable_trigger
ini_set('xdebug.trace_format', '0');  //0 is for the editor 1 is for IDEs 2 is html
// xdebug.trace_options
//xdebug.trace_output_dir  /tmp
// bad  see php.ini ini_set('xdebug.trace_output_name', 'F:\tmp');
ini_set('xdebug.var_display_max_children', '128');
ini_set('xdebug.var_display_max_data', '-1');
ini_set('xdebug.var_display_max_depth', '-1');


//not set up on hosted accounts
if ($gjLocal) {
    try {
        xdebug_enable();

        if (xdebug_is_enabled()) {
            echo 'stack traces are enabled - debugging<BR>';
            //xdebug_start_error_collection();
            echo 'xdebug_memory_usage() '. number_format(xdebug_memory_usage()).'<BR>';
            xdebug_start_trace();
            } else {
            echo 'not debugging<br>';
        }

    } catch (Exception $e) {
        echo 'Caught Exception -> message: ',  $e->getMessage(), "\n";
        //   or if extended over ridden exception var_dump e->getMessage()
    }
}


/*
xdebug_start_error_collection();
Starts recording all notices, warnings and errors and prevents their display
Xdebug will cause PHP not to display any notices, warnings or errors.
Instead, they are formatted according to Xdebug's normal error formatting rules
(ie, the error table with the red exclamation mark) and then stored in a buffer.
This will continue until you call .
xdebug_stop_error_collection();
This buffer's contents can be retrieved by calling
xdebug_get_collected_errors()
*/


/*
$bt = debug_backtrace();
- Generates a user-level error/warning/notice message
trigger_error("I want a backtrace", E_USER_ERROR);
debug_print_backtrace() - Prints a backtrace
*/

}

function gjAreLocal() {
$host = substr($_SERVER['SERVER_NAME'], 0, 5);

	if (in_array($host, array('local', '127.0', '192.1'))) {
		return true;
	} else {
		return false;
	}
}

//  $Arr = obj2array($Obj);
//   print_r ( $Arr );

function obj2array( &$Instance ) {
    $clone = (array) $Instance;
    $rtn = array ();
    $rtn['___SOURCE_KEYS_'] = $clone;

    while ( list ($key, $value) = each ($clone) ) {
        $aux = explode ("\0", $key);
        $newkey = $aux[count($aux)-1];
        $rtn[$newkey] = &$rtn['___SOURCE_KEYS_'][$key];
    }

    return $rtn;
}


	// adapted from get_define_vars comments on php.net
	// Function to create a debug report to display or email.
	// Usage: generateDebugReport(method,get_defined_vars(),email[optional]);
	// Where method is "browser" or "email".

	// Create an ignore list for keys returned by 'get_defined_vars'.
	// For example, HTTP_POST_VARS, HTTP_GET_VARS and others are
	// redundant (same as _POST, _GET)
	// Also include vars you want ignored for security reasons - i.e. PHPSESSID.
function generateDebugReport($method,$defined_vars,$email="undefined"){
	$ignorelist=array(
	"HTTP_POST_VARS",
	"HTTP_GET_VARS",
	"HTTP_COOKIE_VARS",
	"HTTP_SERVER_VARS",
	"HTTP_ENV_VARS",
	"HTTP_SESSION_VARS",
	"_ENV","PHPSESSID",
	"SESS_DBUSER",
	"SESS_DBPASS",
	"HTTP_COOKIE",
	#xml
	"CoreFilingMessage",
	"responseSOAP",
	"RecordDocketingMessage",
	"PaymentMessage",
	# cast as array
	#"SoapClient",
	#"DB_FPECF",
	# "DOMDocument",
	# maybe, maybe not
	"_SERVER",
	"GLOBALS"
	);

	$timestamp=date("m/d/y h:m:s");
	$message="Debug report created $timestamp\n";

	// Get the last SQL error for good measure, where $link is the resource identifier
	// for mysql_connect. Comment out or modify for your database or abstraction setup.
	//global $link;
	//$sql_error=mysql_error($link);
	//if($sql_error){
	//  $message.="\nMysql Messages:\n".mysql_error($link);
	// }
	// End MySQL

	// Could use a recursive function here. You get the idea ;-)
	foreach($defined_vars as $key=>$val){
		if(is_object($val)) {	$val = obj2array($val); $message.= ' obj2array: ' . "\n";}
		if(is_array($val) && !in_array($key,$ignorelist) && count($val) > 0){
			$message.="\n$key array (key=value):\n";
			foreach($val as $subkey=>$subval){
				if(!in_array($subkey,$ignorelist) && !is_array($subval)){
					$message.=$subkey." = ".$subval."\n";
				}
				elseif(!in_array($subkey,$ignorelist) && is_array($subval)){
					foreach($subval as $subsubkey=>$subsubval){
						if(!in_array($subsubkey,$ignorelist)){
							$message.=$subsubkey." = ".$subsubval."\n";
						}
					}
				}
			}
		}
		elseif(!is_array($val) && !in_array($key,$ignorelist) && $val){
			if(is_object($val)) {$val = obj2array($val); $message.= ' obj2array: ' . "\n";}
			$message.="\nVariable ".$key." = ".$val."\n";
		}
	}

	if($method=="browser"){
		//file_put_contents('gjdbg.html', '<pre>'.$message.'</pre>');
		echo nl2br($message);
	}
	elseif($method=="email"){
		if($email=="undefined"){
			$email=$_SERVER["SERVER_ADMIN"];
		}

		$mresult=mail($email,"Debug Report for ".$_ENV["HOSTNAME"]."",$message);
		if($mresult==1){
			echo "Debug Report sent successfully.\n";
		}
		else{
			echo "Failed to send Debug Report.\n";
		}
	}
}
