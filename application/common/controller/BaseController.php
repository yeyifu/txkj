<?php
namespace app\common\controller;

use think\Controller;
use app\lmsys\model\Users;
use think\Session;

class BaseController extends Controller{

    //验证登录信息
	public function check_login($phone,$code){
	    //接收登录控制器传入的登录信息，查询数据库；查询正确后返回账号类型
		$user = model('Users')->get_login($phone,$code);
//		dump($user);
//		exit;
		$user['com_name'] = model('Company')->where('id',$user['id'])->value('com_name');
//		dump($user);
//		exit;
        //判断验证码是否正确
		if(!is_null($user)){
		    //判断验证码是否超过1小时
            $difftime = floor((time()-$user['screate_time'])/3600);
            if($difftime < 720) {
                if ($user['login_flag'] == '0') {

                    switch ($user['user_type']) {
                        case '1':
                            Session::set('user_type', '1');
                            Session::set('number_type', '系统账号');
                            Session::set('phone', $phone);
                            Session::set('username', $user['username']);
                            Session::set('user_id', $user['id']);
                            Session::set('com_id', $user['com_id']);
                            Session::set('company', $user['com_name']);
                            $auth_url = $this->auth();
                            Session::set('auth_url', $auth_url);
                            Session::set('login_time', date('y-m-d h:i:s'));
                            return 1;
                            break;
                        case '2':
                            Session::set('user_type', '2');
                            Session::set('number_type', '管理账号');
                            Session::set('phone', $phone);
                            Session::set('username', $user['username']);
                            Session::set('user_id', $user['id']);
                            Session::set('com_id', $user['com_id']);
                            Session::set('company', $user['com_name']);
                            $auth_url = $this->auth();
                            Session::set('auth_url', $auth_url);
                            Session::set('login_time', date('y-m-d h:i:s'));
                            return 2;
                            break;
                        case '3':
                            Session::set('user_type', '3');
                            Session::set('number_type', '用户账号');
                            Session::set('phone', $phone);
                            Session::set('username', $user['username']);
                            Session::set('user_id', $user['id']);
                            Session::set('com_id', $user['com_id']);
                            Session::set('company', $user['com_name']);
                            $auth_url = $this->auth();
                            Session::set('auth_url', $auth_url);
                            Session::set('login_time', date('y-m-d h:i:s'));
                            return 3;
                            break;
                        default:
                            return null;
                            break;
                    }
                } else {
//				$this->success('账号被禁用','','',1);
                    $data = [
                        'statu' => '400',
                        'info' => '改公司的账号被禁用'
                    ];
//                return $data;
                    return 0;
                }
            }else{
                return 5;
            }
		}else{
//			$this->error('账号或手机验证码错误');
            $data=[
                'statu'=>'400',
                'info'=>'检查手机号码或短信验证码'
            ];
            return $data;
		}
	}

    //根据用户类型查找可操作菜单，url
    public function auth(){
        //根据用户类型查找可操作菜单，url
        $data = model('Menu')->get_menu(session('user_type'));

//        exit;
        $url = array();
        if(!empty($data)){
            foreach ($data as $item) {
                $url[] = $item['url'];
            }
            session('auth_url',$url);


//        session('auth_url',$url);

            $pre_menu = $data[0]['pre_menu'];
//        echo $pre_menu;
//        session('pre_menu',$pre_menu);
            //子菜单
            $this->assign('menu',$data);
            //主菜单
//
            $this->assign('pre_menu',$pre_menu);

            $this->fetch('public/left');
//            return view('public/left');
            return $data;
        }else{
            $this->error('请重新登录','login/index');
        }

    }

	//检查登录信息是否过期，已经登录后操作过程是否被禁用
	public function is_login(){
//	    echo session('username');
//	    exit;
        $user_id = session('user_id');
        //查看公司下所有账号是否允许被登录
        $data = model('Users')->get_logininfo($user_id);
		if(empty(session('username')) || $data['no_login']=='1' ){

                $this->redirect('login/index');



		}
	}

    //判断当前url是否符合账号类操作的url权限
    public function is_auth($url){
	    //获取可执行的url
	    $this->auth();
//        $request = Request::instance();
//        $url = '/'.$request->controller().'/'.$request->action();
        $auth_url = session('auth_url');
//        dump($auth_url);

//        $auth_url = array_push($auth_url,"/Login/index");

        if(in_array($url,$auth_url)){
            return true;
        }else{
            return false;
        }
    }

	//根据登录用户id查出公司id
	public function com_id($user_id){
		
	}

    //退出登录
	public function clear_login(){
	    //记录账号最后活动时间

		Session::clear();
		$this->redirect('login/index');
	}

	// public function _empty(){
	//  $this->redirect('index/index');
	// }








}


 ?>