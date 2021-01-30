<?php
namespace app\lmsys\controller;
use app\common\controller\BaseController;
use think\captcha\Captcha;
use think\Session;
use think\Image;
use app\common\controller\Sms;


class Login extends BaseController{
	public function index(){
//       $sms = new \alysms\api_demo\SmsDemo;
//        dump($sms->response);
//        exit;
		return view();
	}

	//接收登陆页面提交的数据
	public function login(){
		$phone = input('post.phone');
		$code = input('post.code');
        $ymz = input('post.yzm');
        if(captcha_check($ymz)){
            //通过父类方法验证，如果成功接收账号类型[system/admin/user]
            $user = $this->check_login($phone,$code);
//            dump($user);
//            exit;
            $com_id = session('com_id');
            $auth_url = session('auth_url');
            Session('auto_url',$auth_url[0]['url']);
            $no_login = model('Company')->no_login($com_id);
//            echo $user;
//            exit;
            if($user=='2' || $user=='3'){
                //是否允许登录
                if($no_login=='0'){
//                    dump($auth_url);
                    //用户登录默认跳转url
                    model('Users')->last_time(time());
                    $rdt_url = $auth_url[0]['url'];
//                    $this->redirect($rdt_url)->remember();
                    $data=[
                        'statu'=>200,
                        'info'=>'登录成功',
                        'url'=>$auth_url[0]['url']
                    ];
                    return $data;
                }else{
                    $data=[
                        'statu'=>400,
                        'info'=>'该公司账号禁止登陆'
                    ];
                    return $data;
//                    $this->error('公司账号禁止登陆');
                }
                return $data;
            }elseif($user=='1'){
                $auth_url = session('auth_url');
                //用户登录默认跳转url
                $rdt_url = $auth_url[0]['url'];
                model('Users')->last_time(time());
//                $this->redirect($rdt_url)->remember();
                $data=[
                    'statu'=>'200',
                    'info'=>'登录成功',
                    'url'=>$auth_url[0]['url']
                ];
                return $data;
            }elseif($user=='0'){
//                $this->error('用户名或密码错误');
                $data=[
                    'statu'=>'400',
                    'info'=>'该账号被禁用，请联系管理员'
                ];
                return $data;
            }else{
                $data=[
                    'statu'=>'400',
                    'info'=>'请输入1小时内的短信验证码,可重新获取验证码'
                ];
                return $data;
            }
        }else{
//            $this->error('验证码错误!');
            $data=[
                'statu'=>'400',
                'info'=>'验证码错误'
            ];
            return $data;
        }

	}



	public function logout(){
		$this->clear_login();
	}
}
