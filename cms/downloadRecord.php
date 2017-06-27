<?php
/**
 * Created by PhpStorm.
 * User: @van
 * Date: 2015/7/27
 * Time: 17:10
 */

if($_GET['username'] and $_GET['phone']){
    $result=insertForm('user',array(
        'user'=>$_GET['username'],
        'phone'=>$_GET['phone'],
        'time'=>time(),
    ));
    if( $result ){
        echoOK();
    }else{
        echoError('操作失败');
    }
}else{
    echoError('操作失败');
}