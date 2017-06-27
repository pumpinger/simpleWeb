<?php


if( $_POST['search'] ){
    $search=array_filter($_POST['search']);
    $where ='';
    foreach ( $search as $k=>$v) {
        $where.=$k.' like "%'.$v.'%" ';
    }
}


$data=tableHandler('exam',$where);

$breadcrumbs=array(
    '试卷下载'=>'downloadExam'
);
include 'head.php';

//补丁
if(file_exists('../nav.php')){
	include '../nav.php';
}else{
	include './nav.php';
}


?>
<style>
    .main-content .bar {display: none;}
    .main-content .breadcrumbs {display: none;}
    .nav_logo img{display: none;}
    .nav_logo{background: url('img/home_logo.png') no-repeat -75px ;width: 200px;height: 71px;padding: 12px 0 20px 0;margin-left: 20px;}
</style>
<div class="content_area">
    <div class="area_w">
        <div class="search_form_w">
            <form method="post" action="" class="form-horizontal search_form clearfix">
                <div class="row">
                    <span class="r_name" >
                        试卷名:
                    </span>
                    <input type="text" class="" name="search[name]" value="<?php echo $_POST['search']['name'];?>" placeholder=""/>
                </div>
                <div class="row r_sub_btn">
                    <button class="btn btn-info btn-sm" type="submit">
                        <i class="iconfont icon-search"></i>搜索
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>试卷名</th>
                <th>上传时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['list'] as $v):?>
                <tr>
                    <td><?php echo $v['id'];?></td>
                    <td><?php echo $v['name'];?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['time']);?></td>
                    <td>
                        <?php if( $v['file'] ):?>
                            <a data-href="<?php echo $v['file'];?>"
                                class="btn btn-xs btn-success download">
                                下载
                            </a>
                        <?php else:?>
                                未上传

                        <?php endif;?>

                    </td>
                </tr>

            <?php endforeach;?>

            </tbody>
        </table>

        <div class="pager clearfix">
            <div class="fl">
                <div class="summary">共 <?php echo $data['total']; ?>行</div>
            </div>
            <div class="fr">
                <ul class="pagination">
                    <?php foreach ($data['pagination'] as $k => $v):  ?>
                        <li class="page <?php echo $k==$data['page']?'active':'';?>"><a href="<?php echo $v;?>"> <?php echo $k;?></a></li>
                    <?php  endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    var phone;
    var username;
    $('.download').click(function(){
        var user=getCookie('user');
        if(user){
            window.open($(this).data('href'))
        }else{
            getName();
        }
    });


    function getName(){
        username = prompt('请输入您的名字：');
        if(username != null){
            if(username != ''){
                getPhone();
            }else{
                getName();
            }
        }
    }

    function getPhone(){
        phone = prompt('请输入您的联系手机号码：');
        if(phone != null){
            if(phone != ''){
                $.startLoad();
                $.ajax({
                    url: '<?php createUrl('downloadRecord');?>',
                    type: 'get',
                    data:{
                        'username':username,
                        'phone':phone
                    },
                    success: function (data) {
                        $.endLoad();
                        if (data == 'ok') {
                            setCookie('user',username);
                            Tip('感谢您的支持,您现在可以开始选择了');
                        }else{
                            Tip('信息录入失败,请重新录入!', 'error');
                        }
                    },
                    error:function(){
                        Tip('信息录入失败,请重新录入!', 'error');
                        $.endLoad();
                    }
                });
            }else{
                getPhone();
            }
        }
    }

</script>
<?php include 'foot.php';?>
