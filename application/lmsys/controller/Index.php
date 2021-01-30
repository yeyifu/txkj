<?php
namespace app\lmsys\controller;
use app\common\controller\BaseController;
use think\Hook;
use think\model\Company;
use think\Db;
use think\Request;
use think\Collection;
use think\Session;

class Index extends BaseController{

	public function _initialize(){
		// $this->is_login();
	}

	//前置操作执行is_login()方法，检查session是否过期
    protected $beforeActionList = ['is_login','auth'];




	//显示所有企业
	public function index(){
//        $data = action('SendSms/getsms','18229919139');
//        dump($data);
//        exit;
	    $request = Request::instance();
	    $url = '/'.$request->controller().'/'.$request->action();
        $code = $this->is_auth($url);
        if($code){
            $pagelen = input('get.pagelen/d');
            $data = model('Company')->get_companys($pagelen);
//            dump($data);
            $this->assign('data',$data);
            return $this->fetch();
        }else{
//            dump(Session::get());
//            exit;
//            $this->error('权限有误','login/index');
            if(session('user_type') == '1'){
                $this->redirect(session('auto_url'));
            }elseif(session('user_type') == '2'){
                $this->redirect(session('auto_url'));
            }elseif(session('user_type') == '3'){
                $this->redirect(session('auto_url'));
            }else{
                $this->redirect('login/index');
            }

//            switch (session(user_type)){
//                case 1:
//
//            }
        }
	}

    //系统管理 企业添加页面
    public function add(){
        return view();
    }

    //系统管理员-企业名称搜索
    public function keyword(){
        $kyeword = input('post.keywords');
        $data = model('Company')->keywords($kyeword);
        return $data;
    }

	//企业详情
    public function info(Request $request){
	    $com_id = input('get.id');

        $data = model("Company")->get_info($com_id);

        $company = array();
        foreach ($data as $item) {
            $company['id'] = $item['id'];
            $company['com_name'] = $item['com_name'];
            $company['email'] = $item['email'];
            $company['contact'] = $item['contact'];
            $company['cre_address'] = $item['cre_address'];
            $company['no_login'] = $item['no_login'];
            $company['no_auth'] = $item['no_auth'];
            $company['no_use'] = $item['no_use'];
        }
//        dump($company);

//        echo $company['com_name'];


        $this->assign('company',$company);
        return view();
    }
    //修改企业资料
    public function edit(){

    }

    //ajax删除数据
    public function ajax_del(){

        $id = input('post.id/d');
        $code = Db::execute("delete from company where id=$id");
        if($code){
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

    //编辑公司详情
    public function edits (Request $request){

	    return view();
    }

    //获取企业管理员列表
    public function admin_list(){
        $com_id = input('get.id/d');
        $data = model('Users')->get_com_admin($com_id);
        $this->assign('com_id',$com_id);
        $this->assign('data',$data);
	    return view();
    }


    public function _empty(){
	    $this->redirect('index/index');
    }
}