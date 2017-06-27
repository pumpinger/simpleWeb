<?php


$data=tableHandler('teacher',false,false);

$breadcrumbs=array(
    '教师管理'=>'teacherList'
);
include 'head.php';


?>

<div class="content_area">
    <div class="area_w">

        <div class="clearfix quick_btn">
            <a href="<?php createUrl('teacherEdit')?>" data-original-title="add" class="btn btn-sm btn-primary">
<!--            <a data-href="--><?php //createUrl('teacherEdit')?><!--" data-original-title="add" class="btn btn-sm btn-primary edit_link">-->
                + 添加
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="center">ID</th>
                <th>教师名</th>
                <th>照片</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['list'] as $v):?>
                <tr>
                    <td class="center"><?php echo $v['id'];?></td>
                    <td><?php echo $v['name'];?></td>
                    <td><img src="<?php echo $v['pic'];?>" height="80px"></td>
                    <td>
<!--                        <a href="--><?php //createUrl('teacherEdit');?><!--&id=--><?php //echo $v['id'];?><!--"-->
<!--                            data-title="edit"-->
<!--                            class="btn btn-xs btn-info">-->
<!--                            编辑-->
<!--                        </a>-->
<!--                        <a data-href="--><?php //createUrl('teacherEdit');?><!--&id=--><?php //echo $v['id'];?><!--" data-title="编辑" class="btn btn-xs btn-info edit_link">-->
                        <a href="<?php createUrl('teacherEdit');?>&id=<?php echo $v['id'];?>" data-title="编辑" class="btn btn-xs btn-info">
                            编辑
                        </a>
                        <a data-href="<?php createUrl('teacherDel');?>&id=<?php echo $v['id'];?>"
                           class="btn btn-xs btn-info delete_link">
                            删除
                        </a>
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
