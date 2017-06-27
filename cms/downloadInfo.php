<?php


if( $_POST['search'] ){
    $search=array_filter($_POST['search']);
    $where ='';
    foreach ( $search as $k=>$v) {
        $where.=$k.' like "%'.$v.'%" ';
    }
}


$data=tableHandler('user',$where);

$breadcrumbs=array(
    '下载信息'=>'downloadInfo'
);
include 'head.php';


?>

<div class="content_area">
    <div class="area_w">
        <div class="search_form_w">
            <form method="post" action="" class="form-horizontal search_form clearfix">
                <div class="row">
                    <span class="r_name" >
                        名字:
                    </span>
                    <input type="text" class="" name="search[user]" value="<?php echo $_POST['search']['user'];?>" placeholder=""/>
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
                <th>名字</th>
                <th>手机</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['list'] as $v):?>
                <tr>
                    <td><?php echo $v['user'];?></td>
                    <td><?php echo $v['phone'];?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['time']);?></td>
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

<?php include 'foot.php';?>
