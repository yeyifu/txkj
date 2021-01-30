<?php


namespace app\lmsys\model;


use app\common\model\BaseModel;

class EmLog extends BaseModel {
    protected $autoWriteTimestamp = true;

    public function getTimeAttr($value){

        return date('Y-m-d H:i:s',$value);
    }

    //获取系统管理员授权日志
    public function EmLog($page=15){
        $data = model('EmLog')->alias('e')
            ->field('c.com_name,e.action,e.company,e.type,e.count,e.username,e.time,e.remarks')
            ->join('company c','c.id=e.com_id','left')->order('time','desc')->paginate($page);
        if($data){
//            $data = collection($data)->toArray();
            return $data;
//            dump($data);
        }else{
            return false;
        }
    }

    //记录授权日志
    public function writeEmLog($data){

        $code = model('EmLog')->allowField(true)->insert($data);
        if($code == 1){
            return true;
        }else{
            return false;
        }
    }

    //关键词搜索授权日志记录
    public function keyword($keyword){

        $data = model('EmLog')->field('company,action,type,count,username,time')
                ->where('company','like',"%$keyword%")
                ->order('time','desc')->select();
        return $data;
//        if(!empty($data)){
////            $data = collection($data)->toArray();
//            return $data;
////            dump($data);
//        }else{
//            return false;
//        }
    }
}