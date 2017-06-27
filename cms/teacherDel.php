<?php
/**
 * Created by PhpStorm.
 * User: @van
 * Date: 2015/7/27
 * Time: 17:10
 */

if($_GET['id']){
    $result=delForm('teacher',$_GET['id']);

    if( $result ){
        echoOK();
    }else{
        echoError('操作失败');
    }
}else{

    echoError('操作失败');
}