<?php 
class View extends \Smarty
{
	private $config = array();

	public $view;

	public $data;

	public $viewName;

	public $viewBasePath;	// 视图的根目录，即mainFrame的位置

	private $_current_css = array();

	private $_current_js = array();

	private $_title;

	// private $_shared = array();		// 共享的变量，在每个视图中都可以调用的

	public function __construct($viewName = null)
	{
		parent::__construct();
		$configFile = CONFIG_PATH.'/view.php';
		$config = require $configFile;
		$this->setTemplateDir($config['TPL_DIR']);
		// $this->setTemplateDir($this->viewBasePath);
		$this->setCompileDir($config['TPL_COMPILE_DIR']);
		$this->setConfigDir($config['TPL_CONFIG_DIR']);
		$this->setCacheDir($config['TPL_CACHE_DIR']);
		$this->viewName = $viewName;
	}

	/**
	 *	生成smarty对象
	 *
	 *
	 */
	public static function make($viewName = null)
	{
		if(!$viewName)
		{
			throw new Exception('没有找到视图');
		}
		else
		{
			return new \Tpl($viewName);
		}
	}

	public function with($key, $value)
	{
		$this->assign($key, $value);
	}

	private static function getFilePath($viewName)
	{
		$filePath = str_replace('.', '/', $viewName);
		return APP_PATH.self::VIEW_BASE_PATH.$filePath.'.php';
	}

	/**
	 * 
	 * 
	 * 
	 * */
	public function __destruct()
	{
		if($this->viewName)
		{
			$this->display($this->viewName.'.tpl');	
		}
		
	}

	/**
	 *	show the page view(the extend of display)
	 *
	 *
	 */
	public function show($tplName)
	{
		if(!empty($this->_current_css))
		{
			$this->assign('currentCss', $this -> _current_css);
		}

		if(!empty($this->_current_js))
		{
			$this->assign('currentJs', $this -> _current_js);
		}

		if ($this->_title)
		{
			$this->assign ('title', $this -> _title);
		}

		if(!$tplName)
		{
			throw new Exception(\Lang::get('view.TPL_NAME_CANNOT_NULL'));
		}
		$this->assign('contentTpl', $tplName.getConfig('common.tpl_ext'));	// todo 后缀在配置文件中可以以设置
		$this->display('mainFrame.tpl');
	}

	// public function share($key, $value)
	// {

	// }

	/**
	 *	添加css
	 *
	 *
	 */
	public function addCss($fileName)
	{
		$fileName = '/resources/'.$fileName;	// 在资源目录下的css
		if(!in_array($fileName, $this->_current_css))
		{
			$this->_current_css[] = $fileName;
		}
	}

	/**
	 *	添加js
	 *
	 *
	 */
	public function addJs($fileName)
	{
		$fileName = '/resources/'.$fileName; // 在资源目录下的js文件
		if(!in_array($fileName, $this->_current_js))
		{
			$this->_current_js[] = $fileName;
		}
	}

	/**
	 * 	添加title
	 * 
	 * 
	 * */
	public function addTitle ($title)
	{
		$this ->_title = $title;
	}

}