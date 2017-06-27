<?php

if($_POST || $_FILES){
    $data=$_POST['teacher'];

    $form=array(
        'name'=>$data['name'],
    );

    $pic=$_FILES['file'];
    $info=$_FILES['file2'];
    if( $pic['name']  !== ''){
        $data['pic']=uploadFile($pic,'img');
        if( ! $data['pic'] ){
            renderError('文件上传失败');
        }else{
            $form['pic']=$data['pic'];
        }
    }
    if( $info['name']  !== ''){
        $data['info']=uploadFile($info,'img');
        if( ! $data['info'] ){
            renderError('文件上传失败');
        }else{
            $form['info']=$data['info'];
        }
    }


    if($_POST['teacher']['id']){
        $result=updateForm('teacher',$data['id'],$form);
    }else{
        $result=insertForm('teacher',array(
            'name'=>$data['name'],
            'pic'=>$data['pic'],
            'info'=>$data['info'],
        ));
    }

//    if( $result ){
//        echoOK();
//    }else{
//        echoError('操作失败');
//    }

    if( $result ){
        renderPage('teacherList');
    }else{
        renderError('操作失败');
    }
}


$data=loadForm('teacher',$_GET['id']);

$breadcrumbs=array(
    '教师管理'=>'teacherList',
    '编辑老师'=>'',
);

include 'head.php';


?>
<div class="body_box">
    <form class="part_form" method="post" action=""  enctype="multipart/form-data" >
<!--        <div class="row-group clearfix">-->
<!--            <div class="data-group">-->
<!--                <input type="hidden" value="--><?php //echo $referer_url; ?><!--" name="referer_url" id="referer_url">-->
<!--            </div>-->
<!--        </div>-->
        <input type='hidden' value="<?php echo $data['id'];?>" name="teacher[id]" >

        <div class="row-group clearfix">
            <label class="data-label">名字:</label>
            <div class="data-group">
                <input type='text' value="<?php echo $data['name'];?>" name="teacher[name]" >
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" >图片:</label>
            <div class="data-group">
                <input type="file" value="<?php echo $data['pic'];?>" name="file" />
            </div>
            <span class="data-tip">建议大小:180px*290px</span>

        </div>
        <div class="row-group clearfix">
            <label class="data-label" >详情大图:</label>
            <div class="data-group">
                <input type="file" value="<?php echo $data['info'];?>" name="file2" />
            </div>
            <span class="data-tip">建议大小:1340px*758px</span>

        </div>

        <div class="row-group clearfix">
            <span class="data-label">&nbsp;</span>
            <div class="data-group" >
                <input class="btn btn-primary" type="submit" value="确认">
            </div>
        </div>

    </form>
</div>





