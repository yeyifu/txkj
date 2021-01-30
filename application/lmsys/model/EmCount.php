<?php

namespace app\lmsys\model;
use think\Db;
use app\common\model\BaseModel;
use think\Request;

class EmCount extends BaseModel {
//    protected $EmCount = new EmCount();
    //获取企业权限数量
    public function get_all($page='15'){
//        $data = model("AuthCount")->alias('a')->join("Company c","a.com_id=c.id")->select();
        $data = Db::table("em_count")->alias('e')->field("c.id com_id,c.com_name com_name,e.all_em,e.free_em,e.used_em,e.exe_em")
                ->join("company c","c.id=e.com_id","right")
                ->where('c.is_del','0')
//                ->select();
                ->paginate($page,false,['query'=>Request::instance()->param()]);


//        foreach ($data as $key=>$value) {
//            $auth[$key] = $value;
//        }
        return $data;
    }

    //添加企业授权数量
    public function add_count($data){

        $code = model('EmCount')->allowField('com_id,all_em')->save($data);
        if($code){
            return true;
        }else{
            return false;
        }
    }



}