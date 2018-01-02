<?php

header('content-type:text/html;charset=utf-8');
 
$wx = new wechatApi();
 
$ret = "";
if($_GET['code']){
  $ret = $wx->getUserInfo($_GET['code']);

}else{
  $ret = ['error_code'=>4000,'error_msg'=>'您输入的参数有误'];
}
echo json_encode($ret);
exit();
 
 
class wechatApi{

  public function getUserInfo($code){
    
    $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx10e1dde2e7aea329&secret=05a0e06885b8490d8203b9cbcd8a616f&js_code=".$code."&grant_type=authorization_code";
    $result = $this->http_get($url);

    $ret = array();
    if ($result) {
          $json = json_decode($result, true);
          if (! $json || ! empty($json['errcode'])) {
              return $json;
          }
          return $json;
      }
  }

  public function http_get ($url, $header_arr = [])
    {
        $ch = @curl_init();
        if (stripos($url, "https://") !== FALSE) {
            @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        @curl_setopt($ch, CURLOPT_HEADER, false);
        if (!empty($header_arr)) {
            @curl_setopt($ch, CURLOPT_HTTPHEADER, $header_arr);
        }
        $content = @curl_exec($ch);
        $status = @curl_getinfo($ch);
        @curl_close($ch);
        if (intval($status["http_code"]) == 200) {
            return $content;
        } else {
            return false;
        }
    }
 
 
}
