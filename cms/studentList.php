<?php


$data=tableHandler('student',false,false);

$breadcrumbs=array(
    '教师管理'=>'studentList'
);
include 'head.php';

$tempList=$data['list'];
unset($data['list']);
foreach ($tempList as  $v) {
    $data['list'][$v['id']]=$v;
}

?>

<div class="content_area">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>学生名</th>
                <th>照片</th>
                <th>照片规格</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=1;$i<6;$i++):?>
                <tr>
                    <td><?php echo $data['list'][$i]['name']?:'无';?></td>
                    <td><img src="<?php echo $data['list'][$i]['pic'];?>" height="80px"></td>
                    <td>
                        <?php
                            if( 1 == $i ){
                                echo '405px*201px';
                            }elseif( 2 == $i){
                                echo '268px*132px';
                            }elseif( 3 == $i){
                                echo '241px*147px';
                            }elseif( 4 == $i){
                                echo '287px*129px';
                            }elseif( 5 == $i){
                                echo '288px*130px';
                            }

                        ?>
                    </td>
                    <td>
                        <a href="<?php createUrl('studentEdit');?>&id=<?php echo $i;?>" data-title="编辑" class="btn btn-xs btn-info">
                            编辑
                        </a>
                    </td>
                </tr>

            <?php endfor;?>

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
