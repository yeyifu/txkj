<?php
namespace app\api\controller;
use app\common\model\BaseModel;
use think\Controller;
//use think\Model;
use think\Db;
use think\Request;
use app\lmsys\Model;


class Index extends Controller{

    //接口，写入手机信息，单条
    public function setPhoneInfo(){
        if (Request::instance()->isPost()){
            $data = input('post.');
//            if($data['imei'] == null || $data['licence'] == null){
            if(empty($data['imei']) || empty($data['licence'])){
                $result['code']='2002';
                $result['msg']='参数错误';
                return \GuzzleHttp\json_encode($result);
            }else{
                $code = model('app\lmsys\model\PhoneInfo')->set_phone_info($data);
                if(!!$code){
                    $result = [
                        'code' => '2000',
                        'msg' => '手机信息写入成功'
                    ];
                    return \GuzzleHttp\json_encode($result);
                }else{
                    $result = [
                        'code' => '2001',
                        'msg' => '手机信息写入失败'
                    ];
                    return \GuzzleHttp\json_encode($result);
                }
            }
        }else{
            $result = [
                'code' => '2003',
                'msg' => '请用post方式请求'
            ];
            return \GuzzleHttp\json_encode($result);
        }


    }

    //接口，获取手机指令
    public function getPhoneInstruct(){
        if (Request::instance()->isPost()){
            $imei = input('post.imei');
            $licence = input('post.licence');
//            if($imei == null || $licence == null){
            if(empty($imei) || empty($licence)){
                $result['code']='2002';
                $result['msg']='参数错误';
                return \GuzzleHttp\json_encode($result);
            }else{
                $data = model('app\lmsys\model\PhoneInfo')->get_phone_instruct($imei,$licence);
                if(!!$data){
                    $result = [
                        'code'=>'2000',
                        'msg'=>'成功获取指令',
                        'imei'=>$data[0]['imei'],
                        'licence'=>$data[0]['licence'],
                        'interval'=>$data[0]['interval'],
                        'url'=>$data[0]['url'],
                        'screen'=>$data[0]['screen'],
                        'conservation'=>$data[0]['conservation'],
                        'white_list'=>$data[0]['white_list'],
                        'list_info'=>$data[0]['list_info'],
                        'record'=>$data[0]['record'],
                        'restart'=>$data[0]['restart'],
                        'resume_factory'=>$data[0]['resume_factory'],
                        'diagnostic'=>$data[0]['diagnostic'],
                        'diagnostic_log'=>$data[0]['diagnostic_log'],
                        'wechat_back'=>$data[0]['wechat_back'],
                        'update_time'=>$data[0]['update_time'],
                    ];
                    return \GuzzleHttp\json_encode($result);
                }else{
                    $result = [
                        'code' => '2001',
                        'msg' => '指令获取失败，imei或licence错误'
                    ];
                    return \GuzzleHttp\json_encode($result);
                }
            }
        }else{
            $result = [
                'code' => '2003',
                'msg' => '请用post方式请求'
            ];
            return \GuzzleHttp\json_encode($result);
        }

    }

    //设置手机指令
    public function set_phone_instruct(){

    }


    //写入地图信息
    public function setMapInfo(){
        if (Request::instance()->isPost()){
            $data = input('post.');
//        dump($data);
//        exit;
//        if($data['imei'] == null || $data['licence'] == null || $data['longitude'] == null || $data['latitude'] == null || $data['time'] == null){
            if(empty($data['imei']) || empty($data['licence']) || empty($data['longitude']) || empty($data['latitude']) || empty($data['time'])){
                $result['request_code']='2003';
                $result['request_info']='参数错误';
                return \GuzzleHttp\json_encode($result);
            }else{
                //验证imei,licence，返回pid
                $licence = model('app\lmsys\model\PhoneInfo')->get_phone_licence($data['imei'],$data['licence']);
                if($licence){
                    $data['pid'] = $licence[0]['id'];
                    $code = model('app\lmsys\model\Map')->set_map_info($data);
                    if(!!$code){
                        $result = [
                            'code' => '2000',
                            'msg'  => '地图数据写入成功'
                        ];
                        return \GuzzleHttp\json_encode($result);
                    }else{
                        $result = [
                            'code' => '2001',
                            'msg' => '地图数据写入失败'
                        ];
                        return \GuzzleHttp\json_encode($result);
                    }
                }else{
                    $result = [
                        'code' => '2002',
                        'msg' => 'imei或者licence错误'
                    ];
//                return \GuzzleHttp\json_decode(\GuzzleHttp\json_encode($result));
                    return \GuzzleHttp\json_encode($result);
                }

            }
        }else{
            $result = [
                'code' => '2004',
                'msg'  => '请用post方式请求'
            ];
            return \GuzzleHttp\json_encode($result);
        }

    }



    public function index(){
//        exit;
//        $data = model('app\lmsys\model\PhoneInfo')->get_phone_instruct('99001273093985','9d9bf805950ee3a5ab859a4a80c429d1');
//        dump($data);
        $url = 'http://127.0.0.1/api.php/index/setMapInfo?';
        $post_data = [
            'imei'=>'99001273093985',
            'licence'=>'9d9bf805950ee3a5ab859a4a80c429d1',
            'longitude'=>'113.958363',
            'latitude'=>'22.538476',
            'time'=>'1586318389'
        ];
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $o = "";
        foreach ( $post_data as $k => $v )
        {
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;

    }






    //企业授权查询
    /**
     * @param int $tonkey
     * @param int $tpage
     */
    public function getCompanyEmpower($tonkey,$tpage=null,$cpage=null,$type,$version){
        model('app\lmsys\model\Appkey')->getEmpowerList($tonkey,$tpage=null,$cpage=null,$type,$version);
    }

    public function virtualphone(){

        return view();
    }

    //获取授权状态值
    /*
     * $phone IMEI码
     * $licence 授权码
     */
    public function checkEmpowerStatus(){
//        $appkey = input('get.appkey');
//        $imei = input('get.imei');
//        $hard_code = input('get.hard_code');
        if (Request::instance()->isPost()){
            $appkey = input('post.appkey');
            $imei = input('post.imei');
            $hard_code = input('post.hard_code');
            //检查appkey是否存在,返回id,com_id,appkey,enable
            $check_appkey = model('app\lmsys\model\Appkey')->checkAppKey($appkey);
            if(!!$check_appkey){//appkey存在
                //判断appkey是否可用,返回id,com_id,appkey,enable
                if($check_appkey[0]['enable']==1){
                    //验证imei,hard_code,返回licence,enable,em_status,em_type
                    $check_imei_hardcode = model('app\lmsys\model\Empower')->checkImeiHardcode($check_appkey[0]["id"],$imei,$hard_code);
                    if(!!$check_imei_hardcode){//imei&&hard_code是否都存在
                        if($check_imei_hardcode[0]['enable']=='启用'){
                            $check_imei_hardcode[0]['enable']=0;
                        }else{
                            $check_imei_hardcode[0]['enable']=1;
                        }

                        if($check_imei_hardcode[0]['em_status']=='已授权'){
                            $check_imei_hardcode[0]['em_status']=1;
                        }else{
                            $check_imei_hardcode[0]['em_status']=0;
                        }

                        if($check_imei_hardcode[0]['em_type']=='正式'){
                            $check_imei_hardcode[0]['em_type']='1';
                        }else{
                            $check_imei_hardcode[0]['em_type']='2';
                        }
                        //判断是否已授权
                        if($check_imei_hardcode[0]['em_status']==1){
                            $result['code'] = '2000';
                            $result['msg'] = '已授权';
                            $result['enable'] = $check_imei_hardcode[0]['enable'];
                            $result['em_status'] = $check_imei_hardcode[0]['em_status'];
                            $result['em_type'] = $check_imei_hardcode[0]['em_type'];
                            $result['licence'] = $check_imei_hardcode[0]['licence'];
                            return \GuzzleHttp\json_encode($result);
                        }elseif($check_imei_hardcode[0]['em_status']==0){
                            $result['code'] = '2001';
                            $result['msg'] = '等待授权';
                            $result['em_status'] = 0;
                            $result['licence'] = $check_imei_hardcode[0]['licence'];
                            return \GuzzleHttp\json_encode($result);
                        }elseif($check_imei_hardcode[0]['em_status']==2){
                            $result['code'] = '2002';
                            $result['msg'] = '该授权禁用';
                            $result['enable'] = $check_imei_hardcode[0]['enable'];
                            $result['em_status'] = $check_imei_hardcode[0]['em_status'];
                            $result['em_type'] = $check_imei_hardcode[0]['em_type'];
                            $result['licence'] = $check_imei_hardcode[0]['licence'];
                            return \GuzzleHttp\json_encode($result);
                        }

                    }else{//imei&&hard_code写入数据库,等待后台授权
                        $res = model('app\lmsys\model\Empower')->writeImeiHardcode($check_appkey[0]['id'],$check_appkey[0]['com_id'],$imei,$hard_code);
                        if(!!$res){
                            $result['request_code']='2001';
                            $result['request_info']='授权码错误';
                            return \GuzzleHttp\json_encode($result);
                        }else{
                            $result['code'] = '2005';
                            $result['msg'] = '服务器内部错误';
                            return \GuzzleHttp\json_encode($result);
                        }
                    }
                }else{
                    $result['code'] = '2003';
                    $result['msg'] = '该appkey被禁用';
                    $result['appkey'] = $check_appkey[0]['appkey'];
                    return \GuzzleHttp\json_encode($result);
                }
            }else{
                $result['code'] = '2004';
                $result['msg'] = 'appkey不存在';
                $result['appkey'] = $check_appkey[0]['appkey'];
                return \GuzzleHttp\json_encode($result);
            }
        }else{
            $result['code'] = '2006';
            $result['msg'] = '参数错误,两个参数都不能为空且为post方式请求';
            return \GuzzleHttp\json_encode($result);
        }

    }
//    public function getEmpowerStatus(){
//        $imei = input('post.imei');
//        $licence = input('post.licence');
//        if($imei == null || $licence == null){
//            $result['request_code']='2005';
//            $result['request_info']='参数错误';
//            return \GuzzleHttp\json_encode($result);
//        }else{
//            $data = model('app\lmsys\model\Appkey')->getEmpowerStatus($imei);
//            if(!empty($data)){
//                if($data[0]['em_status'] == '已授权'){
//                    if($data[0]['licence'] == $licence){
//                        $result['imei'] = $data[0]['imei'];
//                        $result['licence'] = $data[0]['licence'];
//                        if($data[0]['enable'] == '禁用'){
//                            $result['enable'] = '1';
//                        }else{
//                            $result['enable'] = '0';
//                        }
//                        if($data[0]['em_status'] == '已授权'){
//                            $result['em_status'] = '1';
//                        }else{
//                            $result['em_status'] = '0';
//                        }
////                    $result['em_status'] = '1';
//                        $result['time'] = $data[0]['time'];
//                        $result['request_code']='2000';
//                        $result['request_info']='授权成功';
//                        return \GuzzleHttp\json_encode($result);
//                    }else{
////                    return '授权码错误';
//                        $result['request_code']='2001';
//                        $result['request_info']='授权码错误';
//                        return \GuzzleHttp\json_encode($result);
//                    }
//                }else{
////                return '未授权';
//                    $result['request_code']='2002';
//                    $result['request_info']='未授权';
//                    return \GuzzleHttp\json_encode($result);
//                }
//
//            }else{
//                $result['request_code']='2003';
//                $result['request_info']='imei错误';
//                return \GuzzleHttp\json_encode($result);
//            }
//        }
//
//    }
}