<?php
/**
 * Created by PhpStorm.
 * User: @van
 * Date: 2015/7/27
 * Time: 14:24
 */


function connectDB(){
    global $db_host,$db_user,$db_pwd,$db_name;
    $mysqli=new mysqli($db_host,$db_user,$db_pwd,$db_name);     //实例化mysqli
    $mysqli->query('set names "utf8"');
    if ( $mysqli -> connect_errno ) {
        renderError('数据库连接失败');
    }
    return $mysqli;
}

function renderError($msg='未知错误'){
    include APP_PATH . '/error.php';
    exit;
}

function echoError($msg='未知错误'){
    echo $msg;
    exit;
}

function echoOK(){
    echo 'ok';
    exit;
}

function createUrl($action='index')
{
    if( '' == $action ){
        echo '';
    }else{
        echo 'cms.php?a='.$action;

    }
}


function renderPage($action)
{
    $action=explode('?',$action)[0] ?: 'index';

    global $mysqli;
    $file="./cms/$action.php";

    if(is_file($file)){
        include $file;
    }else{
        renderError('没有找到该页面');
    }
    exit;
}

function redirectUrl($action='index')
{
    header("Location:cms.php?a=".$action);
    exit();
}


function makePagination($page,$allPage){
    //简易分页  不考虑当前页

    $page=array();
    for($i=1;$i<=$allPage;$i++){
        $page[$i]=replaceUrlParam('page',$i);
    }

    return $page;
}

//列表查询 通用方法
function tableHandler($table,$where=false,$size=10){
    global $mysqli;

    $data['page']=$_GET['page']?:1;


    $query='select * from t_'.$table.' ';


    if( $where ){
        $query .='where '.$where.' ';
    }

    $query .=' order by id desc ';

    if( $size ) {
        $query .= 'limit ' . (($data['page'] - 1) * $size) . ',' . $size;
    }

    $result=$mysqli->query($query);
    if ($result) {
        $data['list']=array();
        while($row =$result->fetch_array() ){
            $data['list'][]=$row;
        }
        $query='select count(*) as total from t_'.$table.' ' ;
        if( $where ){
            $query .='where '.$where.' ';
        }
        $result=$mysqli->query($query);
        $data['total']=0;
        if ($result) {
            $data['total']=$result->fetch_array()['total'];
        }else{
            renderError('数据库错误');
        }
        $result->free();
    }else{
        renderError('数据库错误');
    }


    $data['pagination']=array();
    if( $size ){
        $data['pagination']=makePagination($data['page'],ceil($data['total']/$size));
    }

    return $data;
}

function updateForm($table,$id,$data){
    global $mysqli;


    $set='';
    foreach ($data as $k=>$v) {
        $set.=$k.'="'.htmlspecialchars($v).'",';
    }
    $set=rtrim($set,',');

    $query='update t_'.$table.' set '.$set.' where id= '.$id;
    $result= $mysqli->query($query);
    return $result;
}


function insertForm($table,$data){
    global $mysqli;

    $data=array_filter($data);
    $value='"'.implode('","',array_map('htmlspecialchars', array_values($data))).'"';
    $key=implode(',',array_keys($data));

    $query='insert into t_'.$table.' ( '.$key.') values ('.$value.')';
    $result=$mysqli->query($query);
    echo $mysqli->error;
    return $result;

}

function delForm($table,$id){

    global $mysqli;


    $query='delete from  t_'.$table.'  where id= '.$id;
    $result=$mysqli->query($query);

    return $result;
}


function loadForm($table,$id){
    global $mysqli;

    $data=array();
    $query='select * from t_'.$table.' where id ='.$id;
    $result=$mysqli->query($query);
    if ($result && $result->num_rows>0) {
        while($row =$result->fetch_array() ){
            $data=$row;
        }
        $result->free();
    }


    return $data;
}


function replaceUrlParam($key,$value){
    $str='?';

    $_GET[$key]=$value;
    foreach ($_GET as $k =>$v) {
        $str.=$k.'='.$v.'&';
    }
    $str=rtrim($str,'&');


    return $_SERVER['SCRIPT_NAME'].$str;

}

function mkdirs($dir)
{
    if(!is_dir($dir))
    {
        if(!mkdirs(dirname($dir))){
            return false;
        }
        if(!mkdir($dir)){
            return false;
        }
    }
    return true;
}


/**
 * 单文件上传 保留原文件名
 * @param $file
 * @param $type
 * @return bool|string
 */
function uploadFile($file,$type){
    if( is_file($file['tmp_name']) ){
        $uploadDir='./upload/'.$type.'/'.date('Ymd').'/';
        if( !is_dir($uploadDir) ){
            mkdirs($uploadDir);
        }

        $name_array=explode(".",$file['name']);
        if( in_array($name_array[count($name_array)-1],array('php') ) ){
            return false;
        }
        array_splice($name_array,-1,0,time());
        $uploadFile=$uploadDir.implode(".",$name_array);

        //temp
        for($i=1;file_exists($uploadFile);$i++){
            $name_array=explode(".",$file['name']);
            array_splice($name_array,-1,0,array(time(),$i));
            $uploadFile=$uploadDir.implode(".",$name_array);
        }

        if( move_uploaded_file($file['tmp_name'],$uploadFile) ){
            return $uploadFile;
        }
    }

    return false;
}




