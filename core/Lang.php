<?php 

class Lang
{
	public static function get($fileAndName)
	{
		$arr = explode('.', $fileAndName);
		if(count($arr)<2)
		{
			throw new Exception("the type of  paramaters wrong");
			
		}

		list($file, $key) = $arr;

		$langConf = getConfig('common.lang');
		$langFile = LANG_PATH."/{$langConf}/".$file.'.lang.php';
		if(!is_file($langFile))
		{
			throw new \Exception('CAN NOT FIND '.$langFile);
		}

		$langs = include($langFile);
		return $langs[$key];
	}
}