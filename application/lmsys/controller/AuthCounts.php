<?php

namespace app\lmsys\controller;
use app\common\controller\BaseController;
use think\model\Company;
use think\Db;
use think\Request;
class AuthCounts extends BaseController {
    public function index(){
        $data = model("AuthCount")->get_all();
//        echo $data[0]['com_id'];
        dump($data);
        return view();
    }
}