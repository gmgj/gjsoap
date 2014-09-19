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

function display_file_as_text($filein) {
    $file = fopen ($filein, "rb");
    $lines = fread ($file, filesize ($filein));
    fclose ($file);
    echo "<pre style='margin:2em;'><code>";
    echo $lines;
    echo '</code></pre>';
}

function curPageURL() {
    $pageURL = 'http';
    if(isset($_SERVER["HTTPS"])) {
    	if($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
    	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
    	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
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

function checktext($strin){
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

function displaydefinedVariables($gjarrayIn) {
$msgd ='<h1>defined variables</h1>';
$msgd.='<table class="pt"><tr><th>variable</th> <th>value</th> </tr>';

    foreach ($gjarrayIn as $key => $value) {
    	if (is_array ($value)) {
    		$msgd.='<tr><td>$'.$key . '</td><td>';
    		if ( sizeof($value)>0 ) {
    			$msgd.='<table class="ft"><tr> <th>key</th> <th>value</th> </tr>';
    			foreach ($value as $skey => $svalue) {
    				//Array to string conversion
    				$msgd.='<tr><td>[' . $skey .']</td><td>"'. $svalue .'"</td></tr>';
    			}
    			$msgd.='</table>"';
    		} else {
    			$msgd.='EMPTY';
    		}
    		$msgd.='</td></tr>';
    	} else {
    		$msgd.='<tr><td>$' . $key .'</td><td>"'. $value .'"</td></tr>';
    	}
    }

$msgd.='</table>';
$msgd.="<HR>";
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
/* set $gjLocal and $gjDebug and call */


function gjShowErrors() {
//call this first after session start
global $gjDebug;
global $gjXDebug;
global $gjLocal;

if ($gjDebug) {
    // old stuff does not do well with E_STRICT error_reporting(E_ALL | E_STRICT);
    //error_reporting(E_ALL | E_STRICT);
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    ini_set('log_errors',1); //!!!!!
} else {
    error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	// error_reporting(E_ALL & ~E_DEPRECATED);
    ini_set('display_errors',0);
    ini_set('log_errors',0);
}

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
if ($gjLocal && $gjXDebug) {
	try {
		xdebug_enable();

		if (xdebug_is_enabled()) {
			error_log ('stack traces are enabled - debugging');
			//xdebug_start_error_collection();
			error_log ('xdebug_memory_usage() '. number_format(xdebug_memory_usage()));
			xdebug_start_trace();
		} else {
			error_log ('xdebug is not enabled not debugging');
		}

	} catch (Exception $e) {
		error_log('Caught Exception -> message: ',  $e->getMessage());
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