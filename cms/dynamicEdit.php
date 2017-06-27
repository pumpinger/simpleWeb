<?php

if($_POST){
    $data=$_POST['dynamic'];
    if($_POST['dynamic']['id']){
        $result=updateForm('dynamic',$data['id'],array(
            'name'=>$data['name'],
            'intro'=>$data['intro'],
            'content'=>$data['content'],
        ));
    }else{
        $result=insertForm('dynamic',array(
            'name'=>$data['name'],
            'intro'=>$data['intro'],
            'content'=>$data['content'],
            'time'=>time(),
        ));
    }


    if( $result ){
        renderPage('dynamicList');
    }else{
        renderError('操作失败');
    }
}


$data=loadForm('dynamic',$_GET['id']);


$breadcrumbs=array(
    '动态管理'=>'dynamicList',
    '编辑动态'=>'',
);

include 'head.php';



?>
<link rel="stylesheet" href="<?php echo APP_ROOT;?>plug/uedit/themes/default/css/umeditor.css">
<script type="text/javascript" src="<?php echo APP_ROOT;?>plug/uedit/umeditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo APP_ROOT;?>plug/uedit/umeditor.min.js"></script>
<!-- 语言包文件 -->
<script type="text/javascript" src="<?php echo APP_ROOT;?>plug/uedit/lang/zh-cn/zh-cn.js"></script>
<!-- 实例化编辑器代码 -->


<div class="body_box">
    <form class="part_form" method="post" action="" >
<!--        <div class="row-group clearfix">-->
<!--            <div class="data-group">-->
<!--                <input type="hidden" value="--><?php //echo $referer_url; ?><!--" name="referer_url" id="referer_url">-->
<!--            </div>-->
<!--        </div>-->
        <input type='hidden' value="<?php echo $data['id'];?>" name="dynamic[id]" >

        <div class="row-group clearfix">
            <label class="data-label">名字:</label>
            <div class="data-group">
                <input type='text' value="<?php echo $data['name'];?>" name="dynamic[name]" >
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" >简介:</label>
            <div class="data-group">
                <textarea name="dynamic[intro]" style="width: 200px;" rows="8"><?php echo $data['intro'];?></textarea>
            </div>
        </div>

        <div class="row-group clearfix">
            <label class="data-label" >内容:</label>
            <div class="data-group">
<!--                <textarea name="dynamic[content]"></textarea>-->
                <script id="container" name="dynamic[content]" type="text/plain" style="width:600px;height:200px;"></script>
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
<script type="text/javascript">
    $(function(){
        window.UMEDITOR_HOME_URL = "123";


        window.um = UM.getEditor('container', {
            /* 传入配置参数,可配参数列表看umeditor.config.js */
            toolbar:[
                'source | undo redo | bold italic underline strikethrough | superscript subscript | forecolor backcolor | removeformat |',
                'insertorderedlist insertunorderedlist | selectall cleardoc paragraph | fontfamily fontsize' ,
                '| justifyleft justifycenter justifyright justifyjustify |',
                'link unlink | emotion image | ',
                '| horizontal  fullscreen'
            ]

        });
        um.setContent('<?php echo htmlspecialchars_decode($data['content']);?>');

    });

</script>





