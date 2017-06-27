<?php


if($_POST){
    $data=$_POST['chgPwd'];

    $msg='';

    if( $data['new_pwd']  != $data['confirm'] ){
        $msg='两次输入新密码不相同!';
    }else{
        $old_data=loadForm('admin',1);
        if( md5($data['old_pwd'])  != $old_data['pwd'] ){
            $msg='旧密码错误!';
        }
    }



    if( !$msg ){
        $result=updateForm('admin',1,array(
            'pwd'=>md5($data['new_pwd']),
        ));

        if( $result ){
            renderPage('index');
        }else{
            renderError('操作失败');
        }
    }
}


$breadcrumbs=array(
    '修改密码'=>'chgPwd',
);

include 'head.php';

?>
<div class="body_box">
    <form class="part_form" method="post" action="">
        <input type='hidden' value="<?php echo $data['id'];?>" name="chgPwd[id]" >

        <div class="row-group clearfix">
            <label class="data-label">旧密码:</label>
            <div class="data-group">
                <input type='password' value="<?php echo $data['old_pwd'];?>" name="chgPwd[old_pwd]" >
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" >新密码:</label>
            <div class="data-group">
                <input type='password' value="<?php echo $data['new_pwd'];?>" name="chgPwd[new_pwd]" >
            </div>
        </div>

        <div class="row-group clearfix">
            <label class="data-label" >确认新密码:</label>
            <div class="data-group">
                <input type='password' value="<?php echo $data['confirm'];?>" name="chgPwd[confirm]" >
            </div>
        </div>


        <div class="error">
            <div class="row-group clearfix">
                <span class="data-label">&nbsp;</span>
                <span class="data-group"><?php echo $msg;?></span>
            </div>
        </div>


        <div class="row-group clearfix">
            <span class="data-label">&nbsp;</span>
            <div class="data-group" >
                <input class="btn btn-primary" type="submit" value="确认">
            </div>
        </div>

    </form>
</div>





