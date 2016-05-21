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
        // public function __construct()
        // {
        //         parent::__construct();
        // }

        /**
         *      通知
         * 
         * */
        public function inform()
        {
                echo 'this is inform page';
        }

        /**
         *      游戏简介
         * 
         * 
         * */
        public function abstracts()
        {
                echo 'this is abstracts page';
        }


        /**
         *      关于
         * 
         * */
        public function about ()
        {
                echo 'this is about page';
        }
}