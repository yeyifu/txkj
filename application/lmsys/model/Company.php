<?php
namespace app\lmsys\model;
use app\common\model\BaseModel;
use think\Model;
use think\DB;
use think\Request;

class Company extends BaseModel{


    protected $resultSetType = 'collection';
//    protected $insert = [];
//    protected $autoWriteTimestamp = 'datetime';
//    protected $updateTime = false;

    function __construct($data = [])
    {
        parent::__construct($data);
        $this->Emcount = Db::name('Em_count');
    }

    public function getIsUseAttr($value){
        $status = [0=>'启用',1=>'禁用'];
        return $status[$value];
    }

    //系统管理员-企业列表
    public function get_companys($page='5'){
//        return model("Company")->field('id,com_name,email,contact,cre_address')->select();

//        $list = Company::field('id,com_name,email,contact,cre_address,is_del')
//                ->where('is_del','0')
//                ->paginate($page,false,['query'=>Request::instance()->param()]);
        $list = model('Company')->alias('c')
                ->field('c.id com_id,c.com_name,c.number,c.email,c.contact,c.cre_address,c.no_login,c.no_em,c.is_use,e.all_em,e.free_em,e.used_em,e.exe_em')
                ->join('em_count e','c.id=e.com_id','left')
                ->paginate($page,false,['query'=>Request::instance()->param()]);
        return $list;
//        if($list){
//            $list = collection($list)->toArray();
//            return $list;
//        }
    }

    public function keywords($keyword){
        $list = model('company')->alias('c')
            ->field('c.id com_id,c.com_name,c.number,c.email,c.contact,c.cre_address,c.no_login,c.no_em,e.all_em,e.free_em,e.used_em,e.exe_em')
            ->join('em_count e','c.id=e.com_id','left')
            ->where('c.com_name','like',"%$keyword%")
            ->select()->toArray();
//        dump($list);
        return $list;
    }



    //系统管理员-企业详情
    public function get_info($com_id){
        $data = model('Company')->alias('c')
            ->field('c.id cid,c.com_name,c.number,c.email,c.contact,c.cre_address,c.no_em,c.no_login,c.is_use,e.id eid,e.all_em,u.id uid,u.username,u.phone')
            ->join('em_count e','c.id=e.com_id','left')
            ->join('users u','u.com_id=c.id','left')
            ->where('c.id',$com_id)->find();
        
        if($data){
        //    $data = collection($data)->toArray();
            return $data;
        }else{
            return false;
        }
    }

    //企业管理员-企业详情
    public function admin_com_info($user_id){
//        $data = model('Company')->alias('c')->field('c.com_name,c.number,e.all_em,e.used_em')
//                ->join('em_count e','c.id=e.com_id','left')
//                ->find();

        $data = model('Users')->alias('u')->field('c.com_name,c.number,e.all_em,e.used_em')
                ->join('company c','u.com_id=c.id','left')
                ->join('em_count e','c.id=e.com_id','left')
                ->where('u.id',$user_id)->find();
        if($data){
            return $data;
        }else{
            return false;
        }

    }




    //添加一条企业信息
    public function addcominfo($arr){
        Db::startTrans();
        try {
            $data = [
                'com_name' => $arr['com_name'],
                'email' => $arr['email'],
                'number' => $arr['number'],
                'contact' => $arr['contact'],
                'cre_address' => $arr['cre_address'],
                'no_login'  => $arr['no_login'],
                'no_em'  => $arr['no_em'],
                'is_use'  => $arr['is_use'],
            ];
            Db::name('company')->insert($data);
            $data['all_em'] = $arr['all_em'];
            $data['free_em'] = $arr['all_em'];
            $data['count'] = $arr['all_em'];
            $data['username'] = session('username');
            $data['com_id'] = Db::name('company')->getLastInsID();
            $em_count = new EmCount($data);
            $em_count->allowField('com_id,all_em,free_em')->save();
            Db::table('em_log')->data(['com_id'=>$data['com_id'],'company'=>$data['com_name'],'action'=>'开启授权','type'=>'公司','count'=>$data['all_em'],'username'=>$data['username'],'time'=>time(),'remarks'=>''])->insert();
            Db::commit();
            return true;
        }catch(\Exception $e){
            Db::rollback();
            dump($e);
            return false;
        }
    }



    //修改企业编辑资料数据
    public function updates($data){
//        dump($data);
//        exit;
        $em_info = model('EmCount')->field('id,com_id,all_em,free_em,used_em,exe_em')->where('com_id',$data['com_id'])->find()->toArray();
        $free_em = $data['all_em']-$em_info['used_em'];
        if($data['all_em'] != $em_info['all_em']){
            if($data['all_em'] > $em_info['all_em']){
                $diff = $data['all_em'] - $em_info['all_em'];
                $insertdata=[
                    'com_id'=>$data['com_id'],
                    'company'=>$data['com_name'],
                    'action'=>'增加授权数',
                    'type'=>'公司',
                    'count'=>$diff,
                    'username'=>$data['action_name'],
                    'time'=>time(),
                ];
                model('EmLog')->writeEmLog($insertdata);
            }else{
                $diff = $em_info['all_em'] - $data['all_em'];
                $insertdata=[
                    'com_id'=>$data['com_id'],
                    'company'=>$data['com_name'],
                    'action'=>'减少授权数',
                    'type'=>'公司',
                    'count'=>$diff,
                    'username'=>$data['action_name'],
                    'time'=>time(),
                ];
                model('EmLog')->writeEmLog($insertdata);
            }

            $list = Db::table('company')->alias('c')
                // ->field('c.id,c.com_name,c.email,c.contact,c.cre_address,c.no_auth,c.no_login,c.no_use,e.all_em,u.username,u.phone')
                ->join('em_count e','c.id=e.com_id','left')
                ->where('c.id',$data['com_id'])
                ->update(['c.id'=>$data['com_id'],'c.com_name'=>$data['com_name'],'c.cre_address'=>$data['cre_address'],'c.no_login'=>$data['no_login'],'c.no_em'=>$data['no_em'],'c.number'=>$data['number'],'e.all_em'=>$data['all_em'],'e.free_em'=>$free_em]);
//        echo Db::table('company')->getLastSql();

            if($list == '1'|$list == '2'){
                return true;
            }else {
                return false;
            }
        }else{
//            $free_em = $data['all_em']-$em_info['used_em'];
            $list = Db::table('company')->alias('c')
                // ->field('c.id,c.com_name,c.email,c.contact,c.cre_address,c.no_auth,c.no_login,c.no_use,e.all_em,u.username,u.phone')
                ->join('em_count e','c.id=e.com_id','left')
                ->where('c.id',$data['com_id'])
                ->update(['c.id'=>$data['com_id'],'c.com_name'=>$data['com_name'],'c.cre_address'=>$data['cre_address'],'c.no_login'=>$data['no_login'],'c.no_em'=>$data['no_em'],'c.number'=>$data['number'],'e.all_em'=>$data['all_em'],'e.free_em'=>$free_em]);
//        echo Db::table('company')->getLastSql();

            if($list == '1'|$list == '2'){
                return true;
            }else {
                return false;
            }
        }

    }

    //公司id查找公司名称
    public function get_company_name($id){
        $code = model('Company')->where('id',$id)->value('com_name');
        if(empty($code)){
            return null;
        }else{
            return $code;
        }
    }

    //获取登录用户是否禁止登录
    public function no_login($com_id){
        return model('Company')->where('id',$com_id)->value('no_login');
    }

    //根据公司id删除一条信息。
    public function deletecominfo($com_id){
        db('company')->delete($com_id);
    }

}