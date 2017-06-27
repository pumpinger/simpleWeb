<?php include 'head.html'; ?>
<?php include 'nav.php' ?>
<?php include 'config.php' ?>
<?php include 'functions.php' ?>

<?php

$mysqli=connectDB();

$res=tableHandler('student',false,false);
foreach ($res['list'] as  $v) {
    $data['list'][$v['id']]=$v;
}

?>
<style>
    .student {margin-left: 240px;min-height: 520px;}
    .student_cont {position: relative;}
    .student_1 {position: absolute;top:80px;left: 0;width: 405px;height: 201px;}
    .student_2 {position: absolute;top:280px;left: 190px;width: 268px;height: 132px;}
    .student_3 {position: absolute;top:20px;left: 650px;width: 241px;height: 147px;}
    .student_yellow {position: absolute;top:120px;left: 550px;}
    .student_4 {position: absolute;top:192px;left: 650px;width: 287px;height: 129px;}
    .student_5 {position: absolute;top:325px;left: 550px;width: 288px;height: 130px;}
</style>
<div class="student">
    <img src="img/student_text.png">
    <div class="student_cont">
        <?php for($i=1;$i<=5;$i++):?>
            <img class="student_<?php echo $i?>" src="<?php echo $data['list'][$i]['pic'];?>">
        <?php endfor;?>
        <img class="student_yellow" src="img/student_pic6.png">

    </div>


</div>
<?php include 'foot.html' ?>
