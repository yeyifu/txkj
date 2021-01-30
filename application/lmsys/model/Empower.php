<?php


namespace app\lmsys\model;


use app\common\model\BaseModel;
//use think\Session;
use think\Db;
use think\Request;

class Empower extends BaseModel {

    //获取数据的字段值后对状态值进行转换
    public function getEmStatusAttr($value){
        $status = [0=>'未授权',1=>'已授权'];
        return $status[$value];
    }
    public function getEmTypeAttr($value){
        $status = [0=>'',1=>'正式',2=>'测试'];
        return $status[$value];
    }

    //数据库：0表示禁用，1表示启用
    public function getEnableAttr($value){
        $status = [0=>'启用',1=>'禁用'];
        return $status[$value];
    }

    //数据库：时间格式化
    public function getTimeAttr($value){
        if($value == null){
            return '';
        }else{
            return(date('Y-m-d H:i:s',$value));
        }

//        return $status[$value];
    }


    //授权列表
    public function get_empower($com_id,$page=15){
        $list = model('Empower')
                ->where('com_id',$com_id)
                ->order('time','desc')
                ->paginate($page,false,['query'=>Request::instance()->param()]);

//        return $list;
//                ->select();
        if($list){
//            $list = collection($list)->toArray();
            return $list;
        }else{
            return false;
        }
    }

    //修改授权码使用状态(0:禁用，1:启用)
    public function updateEnable($data,$enable){
//        $data['info'] = "$data"."$enable";
        $data['action'] = '修改';
        model('Log')->write($data);
        $code = model('Empower')->where('id',$data['id'])->update(['enable'=>$enable]);

        if($code){
            return true;
        }else{
            return false;
        }
    }

    //写入授权接口提交的信息
    public function writeimei($data){
//        dump($data);
        $em = new Empower($data);
        $code = $em->allowField(true)->save();
        if($code == '1'){
            return true;
        }else{
            return false;
        }
//        model('Empower')->insert('');
    }

    //授权操作并修改授权数量
    public function giveEm($data){
        $licence = model('Empower')->field('hard_code,imei')->where('id',$data['id'])->select();
        if(empty($licence)){
            return false;
        }else{
            $licence = collection($licence)->toArray();
            $licence = md5($licence[0]['hard_code'].$licence[0]['imei'].time());
            Db::startTrans();
            try {
                //empower表，进行授权
//                $licence = model('Empower')->where('id',$data['id'])->value('licence');
                $code = model('Empower')
                        ->where('id',$data['id'])
                        ->update(['licence'=>$licence,'em_status'=>1,'time'=>$data['time'],'em_type'=>$data['em_type'],'em_name'=>$data['em_name'],'version'=>'20200520']);
                if($code == '1'){
                    //授权成功，修改em_count表的授权数
                    model('EmCount')->where('com_id',$data['com_id'])->setInc('used_em');
                    model('EmCount')->where('com_id',$data['com_id'])->setDec('free_em');
//                    $list = model('Empower')->field('imei,licence,em_status,time,em_type,em_name,version')->wherer('id',$data['id'])->select();
                    Db::commit();
                    return true;
                }else{
                    return false;
                }
            }catch (\Exception $e){
                Db::rollback();
                dump($e);
                exit;
                return falase;
            }
        }
    }


    //授权记录关键词搜索
    public function emKeyword($com_id,$keyword){
//        dump($com_id);
//        exit;

        $data = model('Empower')->field('id,imei,licence,time,enable,em_type,em_status,em_name,version')
                ->where('com_id',$com_id)
                ->where('em_status','1')
                ->where('licence|imei|em_name','like',"%$keyword%")->select();


//        $data = model('Empower')->field('id,imei,licence,time,enable,em_type,em_status,em_name,version')
//                ->where('com_id',$com_id)
//                ->whereor('imei','like',$keyword)
//                ->whereor('licence','like',$keyword)
//                ->whereor('em_name','like',$keyword)
//                ->select();

//        $data = model("Empower")->where(function($query){
//            $query->where('com_id',$com_id)->whereor('imei','like',$keyword);
//        })->select();

//        dump($data);
//        exit;

//        $data = Db::query("select * from empower where com_id=$com_id and em_status=1 and concat(licence,imei,em_name) like '%$keyword%';");
//        dump($data);
//        exit;
        if(is_null($data)){
            return false;
        }else{
            $data = collection($data)->toArray();
            return $data;
        }

    }

    //接口数据，根据appkey的id验证imei,hard_code
    public function checkImeiHardcode($apk_id,$imei,$hard_code){
        $data = model('app\lmsys\model\Empower')
                ->field('licence,enable,em_status,em_type')
                ->where('apk_id',$apk_id)
                ->where('imei',$imei)
                ->where('hard_code',$hard_code)
                ->select();
        if(is_null($data)){
            return false;
        }else{
            $data = collection($data)->toArray();
            return $data;
        }
    }

    //客户端接口,写入imei&&hard_code单条数据
    public function writeImeiHardcode($apk_id,$com_id,$imei,$hard_code){
//        echo $apk_id.'--';
//        echo $com_id.'--';
//        echo $imei.'--';
//        echo $hard_code;
        $em = new namespace\Empower();
        $em->data(['apk_id'=>$apk_id,'com_id'=>$com_id,'imei'=>$imei,'hard_code'=>$hard_code]);
        $code = $em->save();
        if($code==1){
            return true;
        }else{
            return false;
        }
    }




    //验证授权
    public function checkEm(){
        echo '666';
    }

}

