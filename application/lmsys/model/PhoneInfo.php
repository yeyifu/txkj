<?php

namespace app\lmsys\model;
use app\common\model\BaseModel;

class PhoneInfo extends BaseModel {

    //写入手机信息，单条写入
    public function set_phone_info($data){
        if(empty($data)){
            return false;
        }else{
            $data['time'] = time();
            $map = new PhoneInfo($data);
            $code = $map->allowField(true)->save();
            if($code == '1'){
                return true;
            }else{
                return false;
            }
        }
    }

    //获取手机指令
    public  function get_phone_instruct($imei,$licence){
        if(empty($imei) || empty($licence)){
            return false;
        }else{
            $data = model('app\lmsys\model\PhoneInfo')->alias('i')
                    ->field('i.imei,i.licence,s.interval,s.url,s.screen,s.conservation,s.white_list,s.list_info,s.record,s.restart,s.resume_factory,s.diagnostic,s.diagnostic_log,s.wechat_back,s.update_time')
                    ->join('phone_set s','i.id=s.pid','left')
//                    ->field('')
                    ->where('i.imei',$imei)
                    ->where('i.licence',$licence)
                    ->select();
            if(empty($data)){
                return false;
            }else{
                $data = collection($data)->toArray();
                return $data;
            }
        }
    }

    //验证imei和licence,返回pid
    public function get_phone_licence($imei,$licence){
//        echo $imei.$licence;
//        exit;
        $data = model('app\lmsys\model\PhoneInfo')
                ->field('id')
                ->where('imei',$imei)
                ->where('licence',$licence)
                ->select();
//        dump($data);
//        exit;
        if(empty($data)){
            return false;
        }else{
            $data = collection($data)->toArray();
            return $data;
        }

    }

    //获取手机信息
    public function get_phone_info($imei){
        $data = model('app\lmsys\model\PhoneInfo')
            ->field('id,imei,licence,gms_signal,wifi_signal,emei1,emei2,system_version,hard_type,rom_version,em_info')
            ->where('imei',$imei)
            ->select();
        if(empty($data)){
            return false;
        }else{
            $data = collection($data)->toArray();
            return $data;
//            dump($data);
        }

    }
}