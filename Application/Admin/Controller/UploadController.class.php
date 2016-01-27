<?php
namespace  Admin\Controller;
use Think\Controller;

/**
* 
*/
class UploadController extends AdminController
{
	
    /**
     * 文件上传
     */
    public function upload()
    {
        $re=$_GET['id'];

        $return = array('status' => 1, 'info' => '上传成功', 'data' => '');

        $file =D('Common/File');

        $info = $file->uploadData($_FILES,$re);

        if ($info)
        {
            $return['data'] = $info;
        }
        else
        {
            $return['status'] = 0;
            $return['info'] = $file->getError();
        }
        $this->ajaxReturn($return);
    }


    /**
     * 编辑器上传
     */
    public function editor()
    {
        //编辑器无法动态获取参数，使用默认配置
        $file =D('Common/File');
        $info = $file->editorData($_FILES);
        if ($info){
            $return = array(
                'error' => 0,
                'url' => $info['url'],
                'info' => $info,
                );
        }else{
            $return = array(
                'error' => 1,
                'message' => $file->getError(),
                );
        }
        $this->ajaxReturn($return);
    }

}