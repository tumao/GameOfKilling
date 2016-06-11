<?php
namespace Core\Orms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Orm extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// GET请求
	protected function sent_get($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
 
		return $file_contents;
	}

	// xml POST请求
	protected function sent_post($url, $para, $certArr=array())
	{
		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//严格认证
		curl_setopt($curl, CURLOPT_VERBOSE, 1); //debug模式
		if(!empty($certArr))
		{
			curl_setopt($curl, CURLOPT_SSLCERT, $certArr['cert']);
			curl_setopt($curl, CURLOPT_SSLKEY, $certArr['key']);
			curl_setopt($curl, CURLOPT_CAINFO, $certArr['rootca']);
			//curl_setopt($curl, CURLOPT_SSLKEYPASSWD, 'c23b76fe5a1c7befb230debe7cdcdc83');
		}
		curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
		curl_setopt($curl,CURLOPT_POST,true); // post传输数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
		$responseText = curl_exec($curl);

		curl_close($curl);
		return $responseText;
	}

}