<?php 
namespace app\lmsys\model;
use app\common\model\BaseModel;
use think\Collection;
use think\Model;
use think\Db;


class Users extends BaseModel{
    protected $resultSetType = 'collection';

    public function getLastTimeAttr($value){
        if($value == 0){
            return null;
        }else{
            return date('Y-m-d H:i:s',$value);
        }


    }

    //根据用户名和验证码查找登陆数据
	public function get_login($phone,$code){
//        $data = model('Users')
//                ->alias('u')
//                ->field('u.id,u.user_type,u.com_id,u.username,u.phone,u.login_flag,u.create_time,u.last_time,s.smscode,c.com_name')
//                ->join('sms s','u.phone=s.phone','left')
//                ->where('u.phone',$phone)
//                ->where('s.smscode',$code)
//                ->join('company c','u.com_id=c.id')
//                ->find();
                $data = model('Users')
                ->alias('u')
                ->field('u.id,u.user_type,u.com_id,u.username,u.phone,u.login_flag,u.create_time,u.last_time,s.smscode,s.create_time screate_time')
                ->join('sms s','u.phone=s.phone','left')
                ->where('u.phone',$phone)
                ->where('s.smscode',$code)
                ->find();

//        dump($data);
        return $data;
	}

	//查看登陆用户权限
    public function  get_auth($phone){
        return model("Users")->alias('u')->field('a.id,a.auth')->join('auth a','u.user_type=a.id')->where('phone',$phone)->find();
    }

	//登陆用户个人信息
	public function getinfo($id){
	    $data = model("Users")->where('id',$id)->find();
	    if(!is_null($data)){
            return $data->toArray();
        }else{
	        echo false;
        }
    }
	
    //企业用户-首页显示数据
    public function getall($id){
//	    $list = Users::all();
//        $list = model('Users')->field('id,user_type,com_id,username,phone,create_time,last_time')->select();
        $list = model('Users')->alias('u')->field('*')
            ->join('company c','u.com_id=c.id','left')
            ->join('em_count e','c.id=e.com_id','left')
            ->where('u.id',$id)->select();
        if(!$list->isEmpty()){
            return $list;
        }else{
            return false;
        }

    }

    //系统管理员-根据公司id查找企业管理员
    public function get_com_admin($com_id){
	    $list = model("Users")->field('id,com_id,username,phone,login_flag,create_time,last_time')->where('user_type',2)->where('com_id',$com_id)->where('is_del',0)->select();
	    if($list){
	        $list = collection($list)->toArray();
            return $list;
        }else{
	        return false;
        }
    }

    //系统管理员-根据公司id查找企业普通用户
    public function get_com_user($com_id){
        $list = model("Users")->field('id,com_id,username,phone,login_flag,create_time,last_time')
                ->where('user_type',3)
                ->where('is_del',0)
                ->where('com_id',$com_id)
                ->select();
        if($list){
            $list = collection($list)->toArray();
            return $list;
        }else{
            return false;
        }
    }

    //企业管理员列表信息
    public function userinfo($user_id,$user_type){
        if($user_type=='1'){
            $list = model('Users')->query("SELECT id,username,phone,create_time,last_time from users WHERE com_id in (SELECT `com_id` FROM `users` WHERE  `id` = 2) and `user_type`=2;");
            if($list){
                $list = collection($list)->toArray();
                return $list;
            }else{
                return false;
            }
        }else{
            $list = model('Users')->query("SELECT id,username,phone,create_time,last_time from users WHERE com_id in (SELECT `com_id` FROM `users` WHERE  `id` = 2) and `user_type`=2 ");
            if($list){
                $list = collection($list)->toArray();
                return $list;
            }else{
                return false;
            }
        }
    }

    //添加企业管理员和普通用户
    public function inserts($arr){
       $users = model('Users');
       $users->data([
            'user_type' =>  $arr['user_type'],
            'com_id' =>  $arr['com_id'],
            'username' =>  $arr['username'],
            'code' =>  $arr['code'],
            'phone' =>  $arr['phone'],
            'login_flag' =>  $arr['login_flag'],
            'create_time' =>  $arr['create_time'],
            'last_time' =>  $arr['last_time'],
       ]);
       $code = $users->save();
        if($code == 1){
            return true;
        }else{
            return false;
        }
    }


    //根据用户id查询该用户是否被禁用，及公司所有账号被禁用
    public function get_logininfo($user_id){
        $data = model('Users')->alias('u')
                ->field('c.id cid,c.no_login')
                ->join('company c','u.com_id=c.id','left')
                ->where('u.id',$user_id)
                ->find();
        return $data;
    }

    //修改企业管理员和普通用户信息
    public function updates($data){
//        dump($data);
//        exit;
//	    $users = new Users();
//        $code = $users->allowField(true)->save($data,['id'=>$data['user_id']]);
        $code = model('Users')
                ->where('id',$data['user_id'])
                ->update(['username'=>$data['username'],'phone'=>$data['phone'],'login_flag'=>$data['login_flag']]);
        if($code == '1'){
            return true;
        }else{
            return false;
        }
    }

    //系统管理员为公司添加管理员
    public function addadmin($data){
        $data=[
            'user_type'=>$data['user_type'],
            'com_id'=>$data['com_id'],
            'username'=>$data['username'],
            'phone'=>$data['phone'],
            'login_flag'=>$data['login_flag'],
            'create_time'=>time()
        ];
        if($data['user_type'] == 2){
            //先查询该公司管理员个数
            $admincount = model('Users')->where('com_id',$data['com_id'])->where('user_type',2)->where('is_del',0)->count();
            // echo $admincount;
            // exit;
            if($admincount<5){
                $lastid = model('Users')->insertGetId($data);
                if(!!$lastid){
                    return $lastid;
                }else{
                    return false;
                }
            }else{
                return "超额";
            }
        }elseif($data['user_type'] == 3){
            $lastid = model('Users')->insertGetId($data);
            if(!!$lastid){
                return $lastid;
            }else{
                return false;
            }
        }else{
            return false;
        }


        
    }

    //根据id删除user表记录，字段is_del值改为1
    public function deluser($user_id,$user_type,$com_id){
            if($user_type == 2){
                //先查询该公司管理员个数
                $admincount = model('Users')->where('com_id',$com_id)->where('user_type',2)->where('is_del',0)->count();
                // echo $admincount;
                // exit;
                if($admincount > 1){
                    $code = model('Users')->where('id',$user_id)->update(['is_del'=>'1']);
                    if($code == '0'){
                        return false;
                    }else{
                        return "ok";
                    }
                }else{
                    return "lastone";
                }
            }else{
                $code = model('Users')->where('id',$user_id)->update(['is_del'=>'1']);
                if($code == '0'){
                    return false;
                }else{
                    return "ok";
                }

            }




        
    }

    //记录账号最后登陆时间
    public function last_time($time){
        model('Users')->where('id',session('user_id'))->setField('last_time',$time);
    }



}


 ?>