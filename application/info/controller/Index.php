<?php
/**
 * Created by PhpStorm.
 * User: zfj
 * Date: 2020/04/02/002
 * Time: 14:17
 */
namespace app\info\controller;
//use app\common\model\BaseModel;
use think\Controller;
use think\Model;
use think\Db;
//use think\Request;
//use app\lmsys\Model;


class Index extends Controller{

    public function index(){

        return view();
    }

    //获取手机指令
    public function getPhoneInfo(){

    }

    //设置手机指令
    public function setphoneinstruct(){
        $pid = input('post.pid');
        $field = input('post.field');
        $value = input('post.value');
        if($value == '1'){
            $code = model('app\lmsys\model\PhoneSet')->where('pid',$pid)->update([$field=>0]);
//            echo $code;
            if($code == '1'){
                $data = [
                    'code' => 200,
                    'msg' => '修改成功',
                    'value'=>0,
                    'field'=>$field
                ];
                return $data;
            }else{
                $data = [
                    'code' => 400,
                    'msg' => '修改失败'
                ];
                return $data;
            }
        }else{
            $code = model('app\lmsys\model\PhoneSet')->where('pid',$pid)->update([$field=>1]);
            if($code == '1'){
                $data = [
                    'code' => 200,
                    'msg' => '修改成功',
                    'value'=>1,
                    'field'=>$field
                ];
                return $data;
            }else{
                $data = [
                    'code' => 400,
                    'msg' => '修改失败'
                ];
                return $data;
            }
        }


    }

    //显示地图数据
    public function map(){
        $pid = '';
        $data = model('app\lmsys\model\Map')->get_map($pid);
        if(empty($data)){
            $list = '';
        }else{
            for($i=0;$i<count($data);$i++){
                $list[$i]['title'] = $i+1;
                $list[$i]['point'] = $data[$i]['longitude'].','.$data[$i]['latitude'];
                $list[$i]['name'] = $data[$i]['address'];
                $list[$i]['content'] = date('Y-m-d H:i:s',"".$data[$i]['time']);
            }
        }
        $list = \GuzzleHttp\json_encode($list);
//            dump($data);
            $this->assign('mapdata',$list);
            $this->assign('id','');
            $this->assign('gms_signal','');
            $this->assign('wifi_signal','');
            $this->assign('emei1','');
            $this->assign('emei2','');
            $this->assign('system_version','');
            $this->assign('hard_type','');
            $this->assign('rom_version','');
            $this->assign('em_info','');
            return view();
    }

    //搜索框自动提示
    public function tips(){
        $value = input('post.value');
        $data = model('app\lmsys\model\PhoneInfo')->field('imei')->where('imei','like',"$value%")->limit(20)->select();
        if(!empty($data)){
            $list[0] = [
                'code'=> 200,
                'msg' => '搜索成功'
            ];
            for($i = 1;$i<=count($data);$i++){
                $list[$i] = $data[$i-1]['imei'];
            }
            return $list;
//            return $data;
        }else{
            $list[0] = [
                'code'=> 400,
                'msg' => '搜索失败'
            ];
            return $list;
        }

    }


    //根据imei获取手机信息
    public function keyword(){
        $imei = input('post.imei');
//        $list = $this->get_phone_info($imei);
        $list = model('app\lmsys\model\Map')->get_map_info($imei);
        if(empty($list)){
            $data[0] = [
                'code'=>400,
                'msg' => '检查imei'
            ];
            return $data;
        }else{
            //根据imei获取地图信息
            for($i=1;$i<=count($list);$i++){
                if($i>1){
                    $dis = $this->distance($list[$i-2]['longitude'],$list[$i-1]['longitude'],$list[$i-2]['latitude'],$list[$i-1]['latitude']);
//                    echo $res.'----';
                    if(ceil($dis)<50){
                        continue;
                    }
                }
                $datas[$i]['title'] = $i;
                $datas[$i]['point'] = $list[$i-1]['longitude'].','.$list[$i-1]['latitude'];
                $datas[$i]['name'] = $list[$i-1]['address'];
                $datas[$i]['content'] = date('Y-m-d H:i:s',$list[$i-1]['time']);

            }
            $datas[0]= [
                'code' =>200,
                'msg' =>'ok',
                'id' => $list[0]['id'],
                'gms_signal' => $list[0]['gms_signal'],
                'wifi_signal' => $list[0]['wifi_signal'],
                'emei1' => $list[0]['emei1'],
                'emei2' => $list[0]['emei2'],
                'system_version' => $list[0]['system_version'],
                'hard_type' => $list[0]['hard_type'],
                'rom_version' => $list[0]['rom_version'],
                'em_info' => $list[0]['em_info'],
                'interval' => $list[0]['interval'],
                'url' => $list[0]['url'],
                'screen' => $list[0]['screen'],
                'conservation' => $list[0]['conservation'],
                'white_list' => $list[0]['white_list'],
                'list_info' => $list[0]['list_info'],
                'record' => $list[0]['record'],
                'restart' => $list[0]['restart'],
                'resume_factory' => $list[0]['resume_factory'],
                'diagnostic' => $list[0]['diagnostic'],
                'diagnostic_log' => $list[0]['diagnostic_log'],
                'wechat_back' => $list[0]['wechat_back'],
            ];
            return $datas;
        }
    }


    //根据经纬度计算两点之间的距离
    public function distance($lng1,$lng2,$lat1,$lat2){
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
        return $s;
    }

    //获取手机信息
    public function get_phone_info($imei){
//        $imei = '99001273093985';
        $data = model('app\lmsys\model\PhoneInfo')->get_phone_info($imei);
        if(!!$data){
            return $data;
//            dump($data);
//            $this->assign('data',$data);
//            return view('index/map');

        }else{
            return false;
        }
    }

}