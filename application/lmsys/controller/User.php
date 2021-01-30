<?php


namespace app\lmsys\controller;
use think\Request;
//use think\Loader;
use app\common\controller\BaseController;

class User extends BaseController {
    protected $beforeActionList = ['is_login','auth'];
    //用户列表首页显示
    public function index(){
        $request = Request::instance();
        $url = '/'.$request->controller().'/'.$request->action();
        //权限验证
        $code = $this->is_auth($url);
        if($code){
            //获取企业信息
            $data = model('Users')->getall(session('user_id'));
            // dump($data);
            // exit;
            if($code){
                $this->assign('data',$data);
            }else{
                echo '企业信息为空';
            }
            return view();
        }else{
            $this->error('权限有误');
        }

    }



    //企业管理员信息列表
    public function info(){
        $request = Request::instance();
        $url = '/'.$request->controller().'/'.$request->action();
//        $code = Hook::listen('action_begin',$url);
        $code = $this->is_auth($url);
        if($code){
            $com_id = session('com_id');

//            $data = model('Users')->userinfo($com_id);
            $data = model('Users')->get_com_admin($com_id);
            $com_id = $data[0]['id'];
//             dump($data);
//             exit;
            $this->assign('com_id',$com_id);
            $this->assign('data',$data);
//            $this->assign('login_flag',$login_flag);
            return view();

        }else{
            $this->error('权限错误');
        }
    }


    //企业用户授权列表
    public function empower(){

        return view();
//        echo '企业用户授权列表';
    }


    //管理员-普通用户列表
    public function lists(){
        $data = model('Users')->get_com_user(session('com_id'));
        if($data){
            $this->assign('data',$data);
            return view();
        }else{
            echo "用户列表为空！";
        }
    }

    //企业管理员和普通用户添加页面
    public function add(){
//        echo session('com_id');
        return view();
    }

    //企业管理员和普通用户添加数据处理
    public function insert(){
        $data = input('post.');
        $data['code'] = '666666';
        $data['last_time'] = '';
        $data['create_time'] = time();
//        dump($data);
//        exit;
        model('Users')->inserts($data);


    }

    //企业管理员和普通用户修改页面
    public function edit(){
        $user_id = input('get.id/d');
        $data = model('Users')->getinfo($user_id);
        if($data){
            $this->assign('data',$data);
            return view();
        }else{
            $this->error('用户修改页面错误');
        }
    }

    //企业管理员和普通用户修改数据处理
    public function updates(){
        $list = input('post.');
        //根据id判断用户是否存在
        $oldinfo = model('Users')->field('username,phone,login_flag')->where('id',$list['user_id'])->select()->toArray();
//        dump($oldinfo);
//        exit;
        if(empty($oldinfo)){
           $data=[
               'status' => '400',
               'info'   => '账号不存在'
           ];
           return $data;
        }else{
            $code = model('Users')->updates($list);//修改管理员或用户资料
            if(!!$code){
//                $user_type = model('Users')->where('id',$list['user_id'])->value('user_type');
                if($list['user_type']=='2'){
                    $action = '修改管理员资料';
                }elseif($list['user_type']=='3'){
                    $action = '修改用户资料';
                }else{
                    $action = '';
                }
                if($oldinfo[0]['login_flag'] == 0){
                    $oldinfo[0]['login_flag'] = '是';
                }elseif($oldinfo[0]['login_flag'] == 1){
                    $oldinfo[0]['login_flag'] = '否';
                }else{
                    $oldinfo[0]['login_flag'] = '';
                }

                if($list['login_flag'] == '0'){
                    $list['login_flag'] = '是';
                }elseif($list['login_flag'] == '1'){
                    $list['login_flag'] = '否';
                }else{
                    $list['login_flag'] = '';
                }

//                $list['login_flag']='0'?'是':'否';
                $info = '名称:['.$oldinfo[0]['username'].'=>'.$list['username'].']，账号:['.$oldinfo[0]['phone'].'=>'.$list['phone'].']，允许登录:['.$oldinfo[0]['login_flag'].'=>'.$list['login_flag'].']';
                //写入操作日志
//                $res = action('logs/write',['user_id'=>$list['user_id'],'com_id'=>$list['com_id'],'action'=>$action,'info'=>$info,'company'=>'','action_name'=>session('username')]);
                $res = action('logs/write',['action'=>$action,'info'=>$info,'company'=>'','action_name'=>session('username')]);
                if(!!$res){
//                    return '日志写入成功';
                    $data = [
                        'status'=>'200',
                        'info'=>'修改成功，并写入日志',
                        'id'=>$list['user_id'],
                        'username'=>$list['username'],
                        'phone'=>$list['phone'],
                        'login_flag'=>$list['login_flag']
                    ];
                }else{
//                    return '日志写入失败';
                    $data = [
                        'status'=>'400',
                        'info'=>'日志写入失败'
                    ];
                }
                return $data;
            }else{
//                return '修改失败';
                $data = [
                    'status'=>'400',
                    'info'=>'修改失败'
                ];
                return $data;
            }
        }

//        $com_name = model('Company')->get_company_name($list['com_id']);
//        if(!is_null($com_name)){//根据id判断公司是否存在，取出公司名称。

//        }else{
////            return false;
//            $data = [
//                'status'=>'400',
//                'info'=>'公司名不存在'
//            ];
//            return $data;
//        }


    }

    //ajax添加管理员
    public function addadmin(){
        $res = input('post.');
//        dump($res);
//        exit;
        $list = model('Users')->addadmin($res);
        if(!!$list){
            if($list == '超额'){
                $data=[
                    'statu' => 400,
                    'info' => '管理员最多为5个'
                ];
            }else{
                //添加成功，写入操作日志
                if($res['user_type'] == '2'){
                    $action = "添加管理员";
                }elseif($res['user_type'] == '3'){
                    $action = "添加用户";
                }else{
                    $action = '';
                }
                $info = "名称:".$res['username']."，账号:".$res['phone'];
                action('logs/write',['action'=>$action,'info'=>$info,'company'=>'','action_name'=>session('username')]);
                //根据id从数据库获取数据返回
                $result = model('Users')->getinfo($list);
                if($result['last_time']==null){
                    $result['last_time'] = '';
                }
                if($result['login_flag'] == '0'){
                    $result['login_flag'] = '是';
                }else{
                    $result['login_flag'] = '否';
                }
                $data=[
                    'statu' => 200,
                    'info' => '添加成功',
                    'id'=>$list,
                    'username' => $result['username'],
                    'phone' => $result['phone'],
                    'com_id' => $result['com_id'],
                    'login_flag'=>$result['login_flag'],
                    'create_time' => $result['create_time'],
                    'last_time' => $result['last_time']
                ];
            }
        }else{
            $data=[
                'statu' => 400,
                'info' => '添加失败'
            ];
        }
        return $data;
    }

    //ajax删除管理员
    public function deladmin(){
//        dump(input('post.'));
//        exit;
        $user_id = input('post.user_id/d');
        $com_id = input('post.com_id/d');
        $user_type = input('post.user_type/d');
        $user_name = input('post.username');
        $phone = input('post.phone/d');
//        dump(input('post.'));
//        exit;
//        echo $user_id.$user_type.$com_id;
        $code = model('Users')->deluser($user_id,$user_type,$com_id);
        // echo $user_id;
        if(!!$code){
            if($code == 'lastone'){
                $data=[
                    'statu' => 400,
                    'info' => '至少保留一名管理员'
                ];
            }else{
                //删除成功，写入操作日志
                $info = "名称:".$user_name."，账号:".$phone;
                if($user_type == '2'){
                    $action = '删除管理员';
                }else{
                    $action = '删除用户';
                }
                action('logs/write',['com_id'=>session('com_id'),'action'=>$action,'info'=>$info,'company'=>'','action_name'=>session('username')]);
                $data=[
                    'statu' => 200,
                    'info' => '删除成功',
                    'user_id' => $user_id
                ];
            }
            
        }else{
            $data=[
                'statu' => 400,
                'info' => '删除失败'
            ];
        }
        // dump($data);
        return $data;
    }

    public function _empty(){
        $this->error();
    }


}