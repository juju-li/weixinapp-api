<?php

header('content-type:text/html;charset=utf-8');
 
define("TOKEN", "my_weixin"); //define your token
$wx = new wechatApi();
 
if($_GET['code']){
  $wx->getUserInfo($_GET['code']);
 
}else{
  $ret = ['error_code'=>4000,'error_msg'=>'您输入的参数有误'];
  echo json_encode($ret);
  exit();
}
 
 
class wechatApi{

  public function getUserInfo($code){
    $ret = ['error_code'=>2000,'data'=>$code];
    echo json_encode($ret);
    exit();

  }
 
 
}
