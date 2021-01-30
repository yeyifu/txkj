<?php
namespace app\lmsys\controller;

use app\common\controller\BaseController;
use app\common\controller\Sms;
use think\Request;
class SendSms extends BaseController{

    public function sendsms($code=null){
        $phone = input('post.phone');
        //8位数随机验证码
        $smscode = rand(10000000,99999999);
        $sms = new Sms;
        //检查登录号码是否存在
        $code = model('Sms')->check_phone($phone);
        if($code){
            $result = model('Sms')->getsms($phone);//根据号码获取验证码信息
            if(!!$result){//已经发送过验证码,数据库有记录
                //验证码是否过期
                $create_time = $result['create_time'];
                $now_time = time();
                $diff_time = round(($now_time-strtotime($create_time))/60);
                if($diff_time <= 60){//没过期，发送原验证码
                    $sendinfo = $sms->sendSms($phone,$result['smscode']);
//                    dump($sendinfo);
//                    exit;
                    if($sendinfo->Message == 'OK'){
                        $data=[
                            'status'=>'200',
                            'info'=>'发送成功'
                        ];
                    }else{
                        $data=[
                            'status'=>'500',
                            'info'=>'接口调用失败'
                        ];
                    }
                    return $data;
                }else{//过期，写入数据库发送新验证码
                    $res = model('Sms')->update_sms($phone,$smscode); //更新数据库验证码
                    if($res){
                        $sms->sendSms($phone,$smscode); //发送验证码
                        $data=[
                            'status'=>'200',
                            'info'=>'发送成功'
                        ];
                    }else{
                        $data=[
                            'status'=>'400',
                            'info'=>'发送失败'
                        ];
                    }
                    return $data;
                }
            }else{//第一次发送验证码
                $res = model('Sms')->setsms($phone,$smscode); //写入数据库
                if($res){
                    $sendinfo = $sms->sendSms($phone,$smscode); //发送验证码
                    if($sendinfo['message' == 'OK']){
                        $data=[
                            'status'=>'200',
                            'info'=>'发送成功'
                        ];
                    }else{
                        $data=[
                            'status'=>'400',
                            'info'=>'发送失败'
                        ];
                    }
                    return $data;
                }else{
                    //数据库写入失败
                    $data=[
                        'status'=>'400',
                        'info'=>'系统错误'
                    ];
                    return $data;
                }
            }
        }else{
            $data = [
                'status'=>'400',
                'info'=>'该账号不存在'
            ];
            return $data;
        }
    }
    
    //获取短信验证码,如果有效返回原验证码，失效返回false
    public function getsms($phone){
        //根据号码查询sms信息
        $data = model('Sms')->getsms($phone);
        // dump($data['smscode']);
        if($data){
            $create_time = $data['create_time'];
            $now_time = time();
            $diff_time = round(($now_time-strtotime($create_time))/60);
            if($diff_time <= 600){
                return $data['smscode'];
            }else{
                return false;
            }
        }
        
        
    }
}