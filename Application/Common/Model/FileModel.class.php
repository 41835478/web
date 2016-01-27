<?php
namespace Common\Model;
use Think\Model;
/**
* 
*/
class FileModel extends Model
{

    //完成
    Protected $autoCheckFields = false;
	
    /**
     * 上传数据
     * @param array $files 上传$_FILES信息
     * @param array $config 上传配置信息可选
     * @return array 文件信息
     */
    public function uploadData($files,$re)
    {

		$upload = new \Think\Upload();
        //上传
        $upload->maxsize = 2*1024*1024;
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub=true;
        $upload->subType=date;
        $info = $upload->upload();

       if($info){ 
            // 记录文件信息
            $rootPath=$upload->rootPath;
            $fileDir = $info['file']['savepath'];
            $rootPath=ltrim($rootPath,'.');
            $file = $rootPath.$fileDir.$info['file']['savename'];
            $infos['title'] = $info['file']['name'];
            $infos['ext'] = $info['file']['ext'];
            $infos['size'] = $info['file']['size'];
            $infos['key']=$info['file']['key'];
            //$infos['original'] = $file;
            $infos['type'] = strtolower($info['file']['type']);
            //处理图片数据
            //$infos['url'] = $info['file']['savename'];
            $infos['url'] = $file;

            if($re=='water'){
                //给图片添加水印
                $image = new \Think\Image();
                $image->open('.'.$file);
                $image->water('./Uploads/water.png')->save('.'.$file);
            }

            return $infos;
        } else {
            $this->error = $upload->getError();
            return false;
        }
    }

        /**
     * 上传数据
     * @param array $files 上传$_FILES信息
     * @param array $config 上传配置信息可选
     * @return array 文件信息
     */
    public function editorData($files)
    {

        $upload = new \Think\Upload();
        //上传
        $upload->maxsize = 2*1024*1024;
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub=true;
        $upload->subType=date;
        $info = $upload->upload();

       if($info){
            // 记录文件信息
            $rootPath=$upload->rootPath;
            $fileDir = $info['imgFile']['savepath'];
            $rootPath=ltrim($rootPath,'.');
            $file = $rootPath.$fileDir.$info['imgFile']['savename'];
            $infos['title'] = $info['imgFile']['name'];
            $infos['ext'] = $info['imgFile']['ext'];
            $infos['key']=$info['imgFile']['key'];
            //$infos['original'] = $file;
            $infos['type'] = strtolower($info['imgFile']['type']);
            //处理图片数据
            //$infos['url'] = $info['file']['savename'];
            $infos['url'] = $file;
            return $infos;
        } else {
            $this->error = $upload->getError();
            return false;
        }
    }


}
