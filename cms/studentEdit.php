<?php

if($_POST || $_FILES){
    $data=$_POST['student'];

    $form=array(
        'name'=>$data['name'],
    );

    $file=$_FILES['file'];
    if( $file['name']  !== ''){
        $data['pic']=uploadFile($file,'img');
        if( ! $data['pic'] ){
            renderError('文件上传失败');
        }else{
            $form['pic']=$data['pic'];
        }
    }



    if($_POST['student']['id']){
        $result=updateForm('student',$data['id'],$form);
    }else{
        $result=insertForm('student',array(
            'id'=>$_GET['id'],
            'name'=>$data['name'],
            'pic'=>$data['pic'],
        ));
    }

//    if( $result ){
//        echoOK();
//    }else{
//        echoError('操作失败');
//    }

    if( $result ){
        renderPage('studentList');
    }else{
        renderError('操作失败');
    }
}


$data=loadForm('student',$_GET['id']);

$breadcrumbs=array(
    '教师管理'=>'studentList',
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
        <input type='hidden' value="<?php echo $data['id'];?>" name="student[id]" >

        <div class="row-group clearfix">
            <label class="data-label">名字:</label>
            <div class="data-group">
                <input type='text' value="<?php echo $data['name'];?>" name="student[name]" >
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
            <span class="data-label">&nbsp;</span>
            <div class="data-group" >
                <input class="btn btn-primary" type="submit" value="确认">
            </div>
        </div>

    </form>
</div>





