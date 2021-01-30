<?php
namespace app\lmsys\model;
use app\common\model\BaseModel;
use think\Collection;
use think\Db;
//use app\lmsys\Model;
class Appkey extends BaseModel {

    public function getCompanyEmpower($user_id){
        return model('Appkey')->all();
    }

    public function getApk($data){
//        dump($data);
//        $apk = new namespace\Appkey();
        $company = new namespace\Company();
        $list = $company->alias('c')
                ->field('c.id,c.com_name,c.no_login,a.appkey,a.create_time,a.username')
                ->join('appkey a','c.id=a.company','left')
//                ->join('empower e','c.id=e.com_id')
                ->where('c.id',$data['com_id'])
                ->find()->toArray();
        if($list){
            $list = Collection($list)->toArray();
            return $list;
        }
    }


    public function checkAppKey($appkey){
        $apk = new namespace\Appkey();
        $list = $apk->field('id,com_id,appkey,enable')->where('appkey',$appkey)->select();
        if(!is_null($list)){
            $list = Collection($list)->toArray();
            return $list;
        }else{
            return false;
        }
    }



    public function getEmpowerList($tonkey,$tpage=null,$cpage=null,$type,$version){

    }

    //获取授权状态值
    public function getEmpowerStatus($imei){
        $empower = new namespace\Empower();
        $result = $empower->field('licence,imei,hard_code,em_status,enable,time')
                ->where('imei',$imei)->select();
        if(!is_null($imei)){
            $result = collection($result)->toArray();
            return $result;
        }else{
            return null;//imei错误
        }

    }

}