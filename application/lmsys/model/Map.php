<?php


namespace app\lmsys\model;


use app\common\model\BaseModel;
//use think\Session;
use think\Db;
use think\Request;
class Map extends BaseModel {

    //写入地图信息
    public function set_map_info($data){
        if(empty($data)){
            return false;
        }else{
            $data['create_time'] = time();
            $map = new Map($data);
            $code = $map->allowField(true)->save();
            if($code == '1'){
                return true;
            }else{
                return false;
            }
        }
    }

    //获取手机信息和指令
    public function get_map_info($imei){
        if(empty($imei)){
            return false;
        }else{
            $data = model('app\lmsys\model\PhoneInfo')->alias('i')
                ->field('i.id,i.imei,i.licence,i.gms_signal,i.wifi_signal,i.emei1,i.emei2,i.system_version,i.hard_type,i.rom_version,i.em_info,s.interval,s.url,s.screen,s.conservation,s.white_list,s.list_info,s.record,s.restart,s.resume_factory,s.diagnostic,s.diagnostic_log,s.wechat_back,m.longitude,m.latitude,m.address,m.time')
                ->where('imei',$imei)
                ->join('map m','i.id=m.pid','left')
                ->join('phone_set s','i.id=s.pid','left')
                ->select();
            if(empty($data)){
                return false;
            }else{
                $data = collection($data)->toArray();
                return $data;
            }

//            return $data;
        }

    }


    //获取地图信息
    public function get_map($pid){
        if(empty($pid)){
            return false;
        }else{
            $data = model('app\lmsys\model\Map')
                    ->field('longitude,latitude,address,time')
                    ->order('time asc')
                    ->where('pid',$pid)->select();
            if(empty($data)){
                return false;
            }else{
                $data = collection($data)->toArray();
                return $data;
            }
        }
    }



}

