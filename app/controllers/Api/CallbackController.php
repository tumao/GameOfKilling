<?php
namespace App\Api;

use App\Controllers\BaseController;
use App\Models\Weixin;

class CallbackController extends BaseController
{
	public function weixin()
	{
		// $signature = $_GET["signature"];
	 //    $timestamp = $_GET["timestamp"];
	 //    $nonce = $_GET["nonce"]; 
	          
		// $token = 'quick';
		// $tmpArr = array($token, $timestamp, $nonce);
		// sort($tmpArr, SORT_STRING);
		// $tmpStr = implode( $tmpArr );
		// $tmpStr = sha1( $tmpStr );
	 
		// if( $tmpStr == $signature ){
		//   return true;
		// }else{
		//   return false;
		// }
		$content = file_get_contents( 'php://input' );
		$data = new \SimpleXMLElement ( $content );
		\SeasLog::debug(json_encode($data));

	}
}