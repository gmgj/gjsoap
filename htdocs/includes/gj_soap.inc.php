<?php
/**
* gj_soap.inc.php
*
*
* @category utilities for soap
* @package  soap extension
* @author   Gary Johnson <gary_johnson_53@hotmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://garyjohnsoninfo.info

*/

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

if (!extension_loaded('soap')) {
	error_log('soap extension not available');
	die('soap extension not available');
}