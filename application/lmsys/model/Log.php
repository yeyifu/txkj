<?php


namespace app\lmsys\model;


use app\common\model\BaseModel;
use think\Collection;
use think\Db;
use think\Request;

class Log extends BaseModel {



    //记录操作日志
    public function write($data){
//        dump($data);
//        exit;
        $log = new Log;
        $log->data([
            'com_id'=>$data['com_id'],
            'time'=>time(),
            'action'=>$data['action'],
            'info'=>$data['info'],
            'company'=>$data['company'],
            'action_name'=>$data['action_name'],
        ]);
        $code = $log->allowField(true)->save();
        if($code == '1'){
            return true;
        }else{
            return false;
        }
    }

    //读取操作日志,arg1:用户名称
    public function read($action_name,$user_type,$page='15'){
        if($user_type == '1'){
            $data = model('Log')->field('time,action,info,company,action_name')
//                ->where('action_name',$action_name)
                ->order('time','desc')
                ->paginate($page,false,['query'=>Request::instance()->param()]);
            if($data){
                return $data;
            }else{
                return false;
            }
        }else{
            $data = model('Log')->field('time,action,info,company,action_name')
                ->where('action_name',$action_name)
                ->order('time','desc')
                ->paginate($page,false,['query'=>Request::instance()->param()]);
            if($data){
                return $data;
            }else{
                return false;
            }
        }
    }

    //系统管理员-获取单个企业操作日志
    public function getComLog($com_id,$page=15){
        $data = model('Log')->field('*')
                ->where('com_id',$com_id)
                ->order('time','desc')
//                ->select();
                ->paginate($page,false,['query'=>Request::instance()->param()]);
//        $data = collection($data)->toArray();
        return $data;
    }


    //关键词搜索日志记录
    public function keywords($keyword){
        $list = model('Log')->field('time,action,info,company,action_name')
            ->where('company|action_name','like',"%$keyword%")
            ->order('time','desc')
            ->select();
//        echo model('Log')->getLastSql();
//            ->paginate($page,false,['query'=>Request::instance()->param()]);
        if($list){
            $list = Collection($list)->toArray();
            return $list;
        }else{
            return false;
        }
        dump($list);
        return $list;
    }

    //记录授权日志
    public function writeemlog(){

    }



}