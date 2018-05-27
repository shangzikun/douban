<?php

function uploadFile($pic,$type='ad') {
	$upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Public/'; // 设置附件上传根目录
    $upload->savePath  =     'upload/'.$type.'/'; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    $pic_url = $info[$pic]['savepath'].$info[$pic]['savename'];
    return $pic_url;

}