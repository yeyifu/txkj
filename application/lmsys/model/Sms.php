<?php

namespace app\lmsys\model;


use app\common\model\BaseModel;
use think\Db;
class Sms extends BaseModel {

    //第一次数据库写入手机短信验证码
    public function setsms($phone,$code){
        $sms = new Sms;
        $sms->data([
            'phone' => $phone,
            'smscode'  => $code,
            'create_time' => time(),
        ]);
        $res = $sms->allowField(true)->save();
        if($res == '1'){
            return true;
        }else{
            return false;
        }
    }

    //修改数据库中过期的验证码
    public function update_sms($phone,$smscode){
        $res = model('Sms')->where('phone',$phone)->update(['smscode'=>$smscode,'create_time'=>time()]);
        if($res == '1'){
            return true;
        }else{
            return false;
        }
    }

    //获取手机短信验证码，并检查是否有效，1小时内有效。
    public function getsms($phone){
        // $data = model('Sms')->field('smscode,create_time')->where('phone',$phone)->find();
        $sms = new Sms;
        $data = $sms->where('phone',$phone)->find();
        if(is_null($data)){
            return false;
        }else{
            return $data;
        }

    }

    //查询号码是否存在,表users字段phone
    public function check_phone($phone){
        $phone = model('Users')->where('phone',$phone)->find();
        if(is_null($phone)){
            return false;
        }else{
            return true;
        }

    }


}