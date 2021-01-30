<?php
namespace app\common\controller;
 //短信验证码引入阿里云短信命名空间
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;
use think\console\command\make\Controller;

class Sms extends Controller{
    static $acsClient = null;

    //手机验证码            手机号  验证码
    public function sendSms($phone,$code){
        require_once EXTEND_PATH.'sms-sdk/vendor/autoload.php';  //载入阿里云文件
        Config::load();
        //产品名称：云通信流量服务API产品，开发者无需替换
        $product = "Dysmsapi";
        //产品域名，开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";
        //设置自己的信息，accesskeyId;
        $accessKeyId = "LTAI8np4qiF3Uwdb";
        $accessKeySecret = "qKA2p5u51Xw2YvRnwsIPlsgKvGUcdQ";
        $region = "cn-hangzhou";
        //服务节点
        $endPointName = "cn-hangzhou";
            if(static::$acsClient == null){
                //初始化acsClient
                $profile = DefaultProfile::getProfile($region,$accessKeyId,$accessKeySecret);
                //增加服务节点
                DefaultProfile::addEndpoint($endPointName,$region,$product,$domain);
                //初始化Acsclient用于发送请求
                static::$acsClient = new DefaultAcsClient($profile);
            }
        //初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        //可选-启用htts协议
        //$request->setProtocol("https");
        //设置接收短信的号码
        $request->setPhoneNumbers($phone);
        //设置签名名称
        $request->setSignName("lmsys系统登录验证码");
        //设置模板CODE
        $request->setTemplateCode("SMS_180064103");
        //设置验证码
        $request->setTemplateParam(json_encode(array(
            'code' => $code,
            'product' => 'yaz'
        ),JSON_UNESCAPED_UNICODE));
        //发起访问请求
        $acsResponse = static::$acsClient->getAcsResponse($request);
        return $acsResponse;


    }

}