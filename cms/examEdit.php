<?php

if($_POST || $_FILES){
    $data=$_POST['exam'];

    $form=array(
        'name'=>$data['name'],
    );

    $file=$_FILES['file'];
    if( $file['name']  !== ''){
        $data['file']=uploadFile($file,'exam');
        if( ! $data['file'] ){
            renderError('文件上传失败');
        }else{
            $form['file']=$data['file'];
        }
    }


    if($_POST['exam']['id']){
        $result=updateForm('exam',$data['id'],$form);
    }else{
        $result=insertForm('exam',array(
            'name'=>$data['name'],
            'file'=>$data['file'],
            'time'=>time(),
        ));
    }

    if( $result ){
        renderPage('examList');
    }else{
        renderError('操作失败');
    }
}


$data=loadForm('exam',$_GET['id']);


$breadcrumbs=array(
    '试卷管理'=>'examList',
    '编辑试卷'=>'',
);

include 'head.php';


?>
<div class="body_box">
    <form class="part_form" method="post" action="" enctype="multipart/form-data"   >
        <input type='hidden' value="<?php echo $data['id'];?>" name="exam[id]" >

        <div class="row-group clearfix">
            <label class="data-label">名字:</label>
            <div class="data-group">
                <input type='text' value="<?php echo $data['name'];?>" name="exam[name]" >
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" >文件:</label>
            <div class="data-group">
                <input type="file" name="file">
            </div>
            <div class="data-tip">不修改则无需重新上传</div>
        </div>

        <div class="row-group clearfix">
            <span class="data-label">&nbsp;</span>
            <div class="data-group" >
                <input class="btn btn-primary" type="submit" value="确认">
            </div>
        </div>

    </form>
</div>





