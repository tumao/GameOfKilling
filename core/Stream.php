<?php
class Stream
{
	// receive post data and filt
	public static function p($key, $filter = FILTER_ALL)
	{
		if(!isset($_POST[$key]))
		{
			return false;
		}
		return parseDataByFilter($_POST[$key], $filter);
	}

	// get
	public static function g($key, $filter = FILTER_ALL)
	{
		if(!isset($_GET[$key]))
		{
			return false;
		}

		return parseDataByFilter($_GET[$key], $filter);
	}

	// request
	public static function r($key, $filter = FILTER_ALL)
	{
		if(!isset($_REQUEST[$key]))
		{
			return false;
		}

		return parseDataByFilter($_REQUEST[$key], $filter);
	}
}