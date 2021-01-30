<?php

namespace app\lmsys\model;


use app\common\model\BaseModel;

class Menu extends BaseModel {
    public function get_menu($auth_id){
//        return model('Menu')->alias('m')->field('pre_menu,menu,url')->join('auth a','m.auth=a.id','left')->where('m.menu',$auth_id)->select();
        $list = model('Menu')->alias('m')->field('m.pre_menu,m.menu,m.url')->where('m.auth',$auth_id)->where('hidden',0)->join('auth a','m.auth=a.id','left')->select();
        if($list){
            $list = collection($list)->toArray();
        }
        return $list;
    }
}