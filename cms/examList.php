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
    '试卷管理'=>'examList'
);
include 'head.php';


?>

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
        <div class="clearfix quick_btn">
            <a href="<?php createUrl('examEdit')?>" data-original-title="add" class="btn btn-sm btn-primary">
                + 添加
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>试卷名</th>
                <th>上传时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['list'] as $v):?>
                <tr>
                    <td><a href="<?php echo $v['file'];?>"><?php echo $v['name'];?></a></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['time']);?></td>
                    <td>
<!--                        <a href="--><?php //createUrl('examEdit');?><!--&id=--><?php //echo $v['id'];?><!--"-->
<!--                            data-title="edit"-->
<!--                            class="btn btn-xs btn-info">-->
<!--                            编辑-->
<!--                        </a>-->
                        <a href="<?php createUrl('examEdit');?>&id=<?php echo $v['id'];?>"
                           data-title="编辑"
                           class="btn btn-xs btn-info">
                            编辑
                        </a>
                        <a data-href="<?php createUrl('examDel');?>&id=<?php echo $v['id'];?>"
                           class="btn btn-xs btn-info delete_link">
                            删除
                        </a>
                        <?php if( $v['file'] ):?>
                            <a target="_blank" href="<?php echo $v['file'];?>"
                               class="btn btn-xs btn-success">
                                下载
                            </a>
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

<?php include 'foot.php';?>
