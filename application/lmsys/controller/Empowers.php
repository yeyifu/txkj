<?php


namespace app\lmsys\controller;


use app\common\controller\BaseController;
use app\lmsys\model\Empower;
use think\Request;
use think\Db;
use think\Session;

class Empowers extends BaseController {
    protected $autoWriteTimestamp = true;

    public function index(){

        $request = Request::instance();
        $url = '/'.$request->controller().'/'.$request->action();
//        $code = Hook::listen('action_begin',$url);
        $code = $this->is_auth($url);
        $page = input('get.pagelen');
        if($code){
            $data = model('EmLog')->EmLog($page);
            $this->assign('data',$data);
//            dump($data);
            return view();
        }else{

        }
    }

    //对授权列表进行授权
    public function giveEm(){
//        $data=[
//            'status' => '200',
//            'info' => '授权成功'
//        ];
//        return $data;
        $data = input('post.');
//        dump($data);
//        exit;
        $data['em_name'] = session('username');
        $data['com_id'] = session('com_id');
        $data['time'] = time();

//        dump($data);
        //判断授权数量是否足够
        $em_count = model('EmCount')->field('free_em')->where('com_id',$data['com_id'])->find()->toArray();

        if($em_count['free_em']>0){
            $code = model('Empower')->giveEm($data);
            if($code){
                //获取授权完的数据，返回前端
                $list = model('Empower')->field('licence,em_status,time,em_type,em_name,version')->where('id',$data['id'])->select();

                $info = "授权账号：".$data['imei'];
                action('logs/write',['com_id'=>session('com_id'),'action'=>'完成授权','info'=>$info,'company'=>session('company'),'action_name'=>session('username')]);
                $data=[
                    'status' => '200',
                    'info' => '授权成功',
                    'licence' => $list[0]['licence'],
                    'em_status' => $list[0]['em_status'],
                    'time' => $list[0]['time'],
                    'em_type' => $list[0]['em_type'],
                    'em_name' => $list[0]['em_name'],
                    'version' => $list[0]['version']
                ];
//                $this->success('授权成功');
            }else{
                $data=[
                    'status' => '400',
                    'info' => '授权失败'
                ];
//                $this->error('授权失败');
            }
            return $data;
        }else{
            $data=[
                'status' => '400',
                'info' => '授权数量不够，请联系管理员'
            ];
            return $data;
//            $this->error('授权数量不够，请联系管理员');
        }


    }

    //修改某条授权使用状态(禁用，启用) 接收ajax数据进行处理
    public function updateEnable(){
        $list = input('post.'); //id,imei
//        dump($list);
//        exit;

        if($list['enable'] == '启用'){
            $code1 = model('Empower')->get(['enable'=>'0','id'=>$list['id']])->where('id',$list['id'])->update(['enable'=>1]);
//            $code1 = model('Empower')->updateEnable($data,1);
            if($code1 == '1'){
                action('logs/write',['com_id'=>session('com_id'),'action'=>'启用','info'=>'授权账号:'.$list['imei'],'company'=>'','action_name'=>session('username')]);
                $data=[
                    'statu'=>200,
//                    'en'=>'禁用',
                    "info"=>'修改成功'
                ];
            }else{
                $data=[
                    'statu'=>400,
                    "info"=>'修改失败'
                ];
            }
            return $data;
        }else if($list['enable'] == '禁用'){
            $code2 = model('Empower')->where('id',$list['id'])->update(['enable'=>0]);
//            $code2 = model('Empower')->updateEnable($data,0);
            if($code2=='1'){
//                action('logs/write',['action'=>'禁用','info'=>'授权账号:'.$list['imei'],'company'=>'','action_name'=>session('username')]);
                action('logs/write',['com_id'=>session('com_id'),'action'=>'禁用','info'=>'授权账号:'.$list['imei'],'company'=>'','action_name'=>session('username')]);
                $data=[
                    'statu'=>200,
//                    'en'=>'启用',
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
            return $data;
        }


    }

    //授权列表关键词搜索
    public function emKeyword(){
        $keyword = input('post.keyword');
        $com_id = input('post.com_id');
//        echo $com_id;
//        exit;
        $data = model('Empower')->emKeyword($com_id,$keyword);
        if(!!$data){
//            dump($data);exit;
            return $data;
        }else{
            return 'null';
        }

    }

    //授权日志搜索
    public function keyword(){
        $keyword = input('post.keywords');
        echo $keyword;
        $data = model('EmLog')->keyword($keyword);
//        echo $data['time'];
//        $data['time'] = date('Y-m-d H:i:s',$data['time']);
        return $data;
    }


    public function uploadFile(){
        vendor('PHPExcel.Classes.PHPExcel');
        vendor('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
        $com_id = input('post.com_id/d');
        $file = request()->file('file');
//        echo $file;

        if($file != null){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $exclePath = ROOT_PATH."public\uploads\\".$info->getSaveName();  //获取文件名
                $exclePath = str_replace('\\', '/', $exclePath);
                $objReader =\PHPExcel_IOFactory::createReader("Excel2007");
                $obj_PHPExcel =$objReader->load($exclePath, $encode = 'utf-8');  //加载文件内容,编码utf-8
                $excel_array=$obj_PHPExcel->getSheet(0)->toArray();   //转换为数组格式
//                dump($excel_array);
//                exit;

                $empower = model('Empower');
//            $list = array();
                $apk_id = $empower->field('apk_id')->where('com_id',$com_id)->find();
                echo $apk_id['apk_id'];
//                exit;
                for($i=1;$i<count($excel_array);$i++){
                    $list = [
                        ['apk_id'=>$apk_id['apk_id'],'com_id' => $com_id,'hard_code' => $excel_array[$i][0],'imei' => $excel_array[$i][1]]
                    ];
                    //写入数据库
                    $code = $empower->insertAll($list);
                }
                if($code == 1){//导入成功，写入操作日志
                    action('logs/write',['com_id'=>session('com_id'),'action'=>'上传文件','info'=>'批量导入iemi码,硬件码','company'=>'','action_name'=>session('username')]);
                    $data = [
                        'status'=>200,
                        'info'=>'数据导入成功'
                    ];

                }else{
                    $data = [
                        'status'=>400,
                        'info'=>'数据导入失败'
                    ];
                }
                return $data;
            }
        }else{
            $data = [
                'status'=>400,
                'info'=>'请选择上传文件'
            ];
            return $data;
        }



    }


    public function test(){
        
    }

}