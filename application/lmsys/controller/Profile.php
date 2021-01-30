<?php
namespace app\lmsys\controller;


use app\common\controller\BaseController;
use think\Request;
class Profile extends BaseController {
    protected $beforeActionList = ['is_login','auth'];
    public function index(){
        $user_id=session('user_id');
        $data = model('Users')->getinfo($user_id);
//        dump($info);
        $request = Request::instance();
//        echo $request->module().'/'.$request->controller();
//        echo $request->path();
        $this->assign('data',$data);
//        dump($data);
        return view();
    }

    public function editinfo(){
        $list = input('post.');
        $code = model('Users')->where('id',$list['user_id'])->update(['username'=>$list['username'],'phone'=>$list['phone']]);
        if($code == 1){
            $data=[
                'statu'=>'200',
                'info'=>'修改成功'
            ];
        }else{
            $data=[
                'statu'=>'400',
                'info'=>'修改失败'
            ];
        }
        return $data;
    }








    public function _empty(){
        $this->error();
    }

}