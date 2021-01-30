<?php
namespace app\lmsys\controller;
use app\common\controller\BaseController;
use think\Request;
use think\Db;
use think\Session;
//use think\Hook;
class Company extends BaseController{
    protected $beforeActionList = ['is_login','auth'];

    //系统管理 显示所有企业列表
    public function index(){
        $request = Request::instance();
        $url = '/'.$request->controller().'/'.$request->action();

        $code = $this->is_auth($url);
        if($code){
            $user_id = session('user_id');
            $user = model('Users')->getinfo($user_id);
            $data = model("Company")->get_companys();

            $this->assign('data',$data);
            return $this->fetch();
        }else{
            echo 'url错误 ';
            $this->redirect('index/index');
        }
    }




    //系统管理-单条记录企业详情
    public function com_info(Request $request){
        $com_id = input('get.id/d');

        $data = model("Company")->get_info($com_id);
        if($data){
            $this->assign('company',$data);
            return view();
        }else{
            $this->error('无法获取企业信息');
        }
    }

    //企业管理员-企业详情
    public function info(){
        $user_id = session('user_id');
        $data = model('Company')->admin_com_info($user_id);
        
        if(!!$data){
            $this->assign('company',$data);
            return view();
        }else{
            $this->error('企业详情错误');
        }
    }

    //系统管理 企业添加页面
    public function add(){
        return view();
    }

    //系统管理 企业数据添加
    public function insert(){
        $data = input('post.');
//        dump($data);
//        exit;
        $code = model('Company')->addcominfo($data);
        if($code){
            $this->redirect('index/index');
        }else{
            $this->error('信息添加失败');
        }
    }

    //系统管理 编辑企业资料页面
    public function edit(){
        $data = model('Company')->get_info(input('get.id/d'));
        $this->assign('data',$data);
        return view();
    }

    //系统管理 处理修改企业资料数据
    public function update(){
        $data = input('post.');
        $data['action_name'] = session('username');
        $code = model('Company')->updates($data);
        if($code){
            //记录操作日志
            action('logs/write',['com_id'=>session('com_id'),'action'=>'修改','info'=>'企业资料','company'=>input('post.com_name'),'action_name'=>session('username')]);
            $this->redirect('index/index');
        }else{
            $this->error('修改失败');
        }
    }

    //禁用,启用企业
    public function updateuse(){
        $com_id = input('post.com_id/d');
        $is_use = input('post.is_use/s');

        if($is_use == '禁用'){
            $code = Db::execute("update company set is_use=0 where id=$com_id");
            if($code){
                $data=[
                    'statu'=>200,
                    "info"=>'修改成功'
                ];
            }else{
                $data=[
                    'statu'=>400,
                    "info"=>'修改失败'
                ];
            }
            return $data;
        }else if ($is_use == '启用'){
            $code = Db::execute("update company set is_use=1 where id=$com_id");
            if($code){
                $data=[
                    'statu'=>200,
                    "info"=>'修改成功'
                ];
            }else{
                $data=[
                    'statu'=>400,
                    "info"=>'修改失败'
                ];
            }
            return $data;
        }else{
            $data=[
                'statu'=>400,
                "info"=>'修改失败'
            ];
        }

    }

    //系统管理 ajax删除数据
    public function ajax_del(){
        $id = input('post.id/d');
//        $code = Db::execute("delete from company where id=$id");
        $code = Db::execute("update company set is_del=1 where id=$id");
        if($code){
            action('logs/write',['action'=>'删除','info'=>'企业资料','company'=>input('post.com_name'),'action_name'=>session('username')]);
            $data=[
                'statu'=>200,
                "info"=>'删除成功'
            ];
        }else{
            $data=[
                'statu'=>400,
                "info"=>'删除失败'
            ];
        }
        return $data;
    }

    //企业授权列表,显示页面
    public function empower(){
        $pagelen = input('get.pagelen/d');
        $data = model('Empower')->get_empower(session('com_id'),$pagelen);
//        dump($data);
        $this->assign('data',$data);
        return view();
    }

    //企业操作日志
    public function log(){
        $com_id = input('get.id/d');
        $page = input('get.pagelen/d');

//        echo $com_id;
//        echo $page;
//        exit;
//        exit;
        $data = model('Log')->getComLog($com_id,$page);
//        dump($data);
        $this->assign('id',$com_id);
        $this->assign('data',$data);
        return view();
    }

    public function _empty(){
        $this->error('访问地址错误');
    }





}