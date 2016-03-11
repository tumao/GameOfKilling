<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Weixin extends Orm
{

  	public $timestamps = false;

    public $data = array();

    public function __construct()
    {
      $content = wp_file_get_contents ( 'php://input' );
      ! empty ( $content ) || die ( '这是微信请求的接口地址，直接在浏览器里无效' );

      // if ($_GET ['encrypt_type'] == 'aes') {
      //   vendor ( 'WXBiz.wxBizMsgCrypt' );

      //   $this->sReqTimeStamp = I ( 'get.timestamp' );
      //   $this->sReqNonce = I ( 'get.nonce' );
      //   $this->sEncryptMsg = I ( 'get.msg_signature' );

      //   $map ['id'] = I ( 'get.id' );
      //   $info = M ( 'member_public' )->where ( $map )->find ();
      //   get_token ( $info ['token'] ); // 设置token

      //   $this->wxcpt = new \WXBizMsgCrypt ( 'weiphp', $info ['encodingaeskey'], $info ['appid'] );

      //   $sMsg = ""; // 解析之后的明文
      //   $errCode = $this->wxcpt->DecryptMsg ( $this->sEncryptMsg, $this->sReqTimeStamp, $this->sReqNonce, $content, $sMsg );
      //   if ($errCode != 0) {
      //     addWeixinLog ( $_GET, "DecryptMsg Error: " . $errCode );
      //     exit ();
      //   } else {
      //     // 解密成功，sMsg即为xml格式的明文
      //     $content = $sMsg;
      //   }
      // }

      $data = new \SimpleXMLElement ( $content );
    }

    public function getData()
    {
      return $this->data;
    }

}