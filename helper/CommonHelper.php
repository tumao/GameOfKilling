<?php

if(!function_exists('getResources'))
{
	function getResources($filePath = null)
	{
		$public_path = PUBLIC_PATH;
		$resources_path = $public_path.'/resources';
		if($filePath == null)
		{
			return $resources_path;
		}
		return $resources_path.'/'.$filePath;
	}
}
	

	// 获取config目录下的配置
if(!function_exists('getConfig'))
{
	function getConfig($fileAndKey)
	{
		list($file, $key) = explode('.', $fileAndKey);
		$file = CONFIG_PATH.'/'.$file.'.php';
		if(!$file || !$key)
		{
			throw new \Exception("TYPE OF PARAMATERS WRONG");
		}
		if(!is_file($file))
		{
			throw new \Exception("CAN NOT FIND FILE {$file}");
		}
		$configs = include($file);
		$value = $configs[$key];
		return $value;
	}
}

/*
 *	过滤函数 $filter 为十六进制
 *	all:0x0015,uri:0x0001,html:0x0002,script:0x0004,sql:0x0008
 */
if(!function_exists('parseDataByFilter'))
{
	function parseDataByFilter($data, $filter = FILTER_ALL)
	{
		if (is_array($data))
		{
			$result	= array();
			foreach ($data as $key => $value)
			{
				$result[$key]	= $this->parseDataByFilter($value, $filter);
			}
			return $result;
		}
		if (!is_string($data))
		{
			return false;
		}
		if ( @get_magic_quotes_gpc() )
		{
			$data	= stripslashes($data);
			$data	= preg_replace( "/\\\(?!&amp;#|\?#)/", "&#092;", $data );
		}
		if ($filter & FILTER_URI)
		{
			$data	= rawurldecode($data);
		}
		if ($filter & FILTER_HTML)
		{
			$data	= preg_replace("/&(?!#[0-9]+;)/s", '&amp;', 		$data );
			$data	= str_replace( "&"				, "&amp;"         , $data );
			$data	= str_replace( "<!--"			, "&#60;&#33;--"  , $data );
			$data	= str_replace( "-->"			, "--&#62;"       , $data );
			$data	= preg_replace( "/<script/i"	, "&#60;script"   , $data );
			$data	= str_replace( ">"				, "&gt;"          , $data );
			$data	= str_replace( "<"				, "&lt;"          , $data );
			$data	= str_replace( '"'				, "&quot;"        , $data );
			$data	= str_replace( "\n"				, "<br />"        , $data ); // Convert literal newlines
			$data	= str_replace( "$"				, "&#036;"        , $data );
			$data	= str_replace( "\r"				, ""              , $data ); // Remove literal carriage returns
			$data	= str_replace( "!"				, "&#33;"         , $data );
			$data	= str_replace( "'"				, "&#39;"         , $data ); // IMPORTANT: It helps to increase sql query safety.
		}
		if ($filter & FILTER_SCRIPT)
		{
			$data	= preg_replace( "/javascript/i" , "j&#097;v&#097;script", $data );
			$data	= preg_replace( "/alert/i"      , "&#097;lert"          , $data );
			$data	= preg_replace( "/about:/i"     , "&#097;bout:"         , $data );
			$data	= preg_replace( "/onmouseover/i", "&#111;nmouseover"    , $data );
			$data	= preg_replace( "/onclick/i"    , "&#111;nclick"        , $data );
			$data	= preg_replace( "/onload/i"     , "&#111;nload"         , $data );
			$data	= preg_replace( "/onsubmit/i"   , "&#111;nsubmit"       , $data );
			$data	= preg_replace( "/<body/i"      , "&lt;body"            , $data );
			$data	= preg_replace( "/<html/i"      , "&lt;html"            , $data );
			$data	= preg_replace( "/document\./i" , "&#100;ocument."      , $data );
		}
		if ($filter & FILTER_SQL)
		{
			$data	= str_replace( "'", "&#39;", $data);	// IMPORTANT: It helps to increase sql query safety.
		}
		return $data;
	}
}

if(!function_exists('info'))
{
	function info($message, $code = 1, $type = 'json')
	{
		if($type == 'json')
		{
			header('Content-type: application/json');
			echo json_encode(['info' => $message, 'code' => $code]);
			exit;
		}
		else
		{
			return ['info'=>$message, 'code' => $code];
		}
	}
}

/**
 * 解析xml
 * 
 * */
if (!function_exists('parse_xml'))
{
	function parse_xml ($data)
	{
		$parsed = (array) simplexml_load_string ($data, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $parsed;
	}
}