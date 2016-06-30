<?php
/**
 * @author changchun
 * 微信页面中对应的主页模块
 */
namespace App\Controllers\Front\Main;

use App\Controllers\BaseController;

class MainController extends BaseController 
{
        /**
         *      构造函数，并且继承父类的构造
         * 
         * */
        public function __construct()
        {
                parent::__construct();
        }

        /**
         *      通知
         * 
         * */
        public function inform()
        {
                $this -> view -> addTitle ('最新通知');
                
                $this -> view -> show ('main/inform/index');
        }

        /**
         *      游戏简介
         * 
         * 
         * */
        public function abstracts()
        {
                $this -> view -> addTitle ('游戏简介');
                $this -> view -> addCss ('front/css/abstract.css');

                $this -> view -> show ('main/abstract/index');
        }


        /**
         *      关于
         * 
         * */
        public function about ()
        {      
                $this -> view -> addTitle ('关于');
                $this -> view -> addCss ('front/css/about.css');

                $this -> view -> show ('main/about/index');
        }
}