<?php


namespace app\lmsys\controller;


use app\common\controller\BaseController;
use think\Request;
use think\Session;


class Logs extends BaseController {

    protected $beforeActionList = ['is_login','auth'];

    //显示系统管理员操作日志
    public function system(){
        session('log_url','/Logs/system');
        $pagelen = input('get.pagelen');
//        $pagelen = input('post.pagelen');
        $request = Request::instance();
        $url = '/'.$request->controller().'/'.$request->action();
        $code = $this->is_auth($url);
        if($code){
            $data = $this->read(session('username'),1,$pagelen);
//            $this->assign('pagelen',$pagelen);
            $this->assign('user_type',1);
            $this->assign('data',$data);
            return view('/public/log');
        }else{
            $this->error();
        }
    }

    //显示企业管理员操作日志
    public function admin(){
        session('log_url','/Logs/admin');
        $request = Request::instance();
        $page = input('get.pagelen');
        $url = '/'.$request->controller().'/'.$request->action();
        $code = $this->is_auth($url);
        if($code){
            $data = $this->read(session('username'),2,$page);
            $this->assign('user_type',2);
            $this->assign('data',$data);
            return view('/public/log');
        }else{
            $this->error();
        }
    }

    //显示企业管理员操作日志
    public function user(){
        session('log_url','/Logs/user');
        $request = Request::instance();
        $page = input('get.pagelen');
        $url = '/'.$request->controller().'/'.$request->action();
        $code = $this->is_auth($url);
        if($code){
            $data = $this->read(session('username'),3,$page);
            $this->assign('user_type',3);
            $this->assign('data',$data);
            return view('/public/log');
        }else{
            $this->error();
        }
    }


    //写日志
    public function write($com_id,$action='',$info='',$company='',$action_name=''){
        $data = [
            'com_id'=>$com_id,
            'action'=>$action,
            'info'=>$info,
            'company'=>$company,
            'action_name'=>$action_name
        ];
//        exit;
        $code = model('Log')->write($data);
        if($code){
//            dump('日志写入成功');
            return true;
        }else{
//            dump('日志写入失败');
            return false;
        }

    }

    //读日志
    public function read($action_name,$user_type,$page){
//        $user_type = session('user_type');
        $data = model('Log')->read($action_name,$user_type,$page);

        if($data){
            return $data;
        }else{
            return false;
        }
    }

    //关键词搜索日志
    public function keyword(){
        $keyword = input('post.keywords');

        $data = model('Log')->keywords($keyword);
        $this->assign('data',$data);
//            $this->fetch('/public/log','data',$data);
//        return view('/public/log');

//        dump(count($data));
//        return \GuzzleHttp\json_encode($data);

        return $data;
    }


    //导出excel格式 系统操作日志
    public function excel(){

        $user_id = 1;
        $data = model('Log')->where('user_id',$user_id)->select();
        $data = collection($data)->toArray();
        $path = dirname(__FILE__);//找到当前脚本所在路径
        vendor('PHPExcel.Classes.PHPExcel');
        vendor('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
        $PHPExcel = new \PHPExcel();//实例化
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("demo");//给当前活动sheet设置名称
//        $PHPSheet->setCellValue("A1","时间")->setCellValue("B1","操作");//表格数据
        $PHPSheet->setCellValue("A1","序号")
            ->setCellValue("B1","时间")
            ->setCellValue("C1","操作")
            ->setCellValue("D1","内容")
            ->setCellValue("E1","操作人");//表格数据
        $datalength = count($data);
        for($i=0;$i<$datalength;$i++){
            $time = date("Y-m-d H:i:s",$data[$i]['time']);
            $action = $data[$i]['action'];
            $info = $data[$i]['info'];
            $action_name = $data[$i]['action_name'];
            $j = $i+2;
            $sep = $i+1;
            $PHPSheet->setCellValue("A".$j,"$sep")
                ->setCellValue("B".$j,"$time")
                ->setCellValue("C".$j,"$action")
                ->setCellValue("D".$j,"$info")
                ->setCellValue("E".$j,"$action_name");//表格数据
        }

        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");//创建生成的格式
        ob_end_clean();
        header('Content-Disposition: attachment;filename="企业操作日志.xlsx"');//下载下来的表格名
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output");//表示在$path路径下面生成demo.xlsx文件

    }

    public function _empty(){
        $this->error();
    }

}