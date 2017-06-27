<?php include 'head.html'; ?>
<?php include 'nav.php' ?>
<?php include 'config.php' ?>
<?php include 'functions.php' ?>

<?php

$mysqli=connectDB();

$res=tableHandler('teacher',false,false);


?>
<style>
    .teacher {margin-left: 250px;}
    .teacher_cont {position: relative;margin-top: 50px;width: 890px;}
    .teacher_cont_left {position: absolute;top: 90px;left: -74px;padding:10px;border-radius:4px;background: rgba(0,0,0,.3);cursor: pointer;z-index: 2;user-select: none;}
    .teacher_items {white-space: nowrap;width: 820px;overflow: hidden;}
    .teacher_items img{margin-right: 30px;vertical-align: top;margin-top: 10px;cursor: pointer;}
    .teacher_cont_right {position: absolute;top: 90px;right: 0;padding:10px;border-radius:4px;background: rgba(0,0,0,.3);cursor: pointer;z-index: 2;user-select: none;}
    .teacher_album {position: absolute;top:0;left: 0;right:0;z-index: 99;background: rgba(0,0,0,0.4);text-align: center;display: none;}
    .teacher_album_x{position: absolute;top: 55px;right: 5%;cursor: pointer;}
    .teacher_album_pic{padding: 20px 0;}


</style>
<div class="teacher">
    <img class="teacher_title" src="img/teacher_text.png">
    <div class="teacher_cont">
        <div class="teacher_cont_left">
            <img  src="img/homepage_button_left.png">
        </div>
        <div class="teacher_items">
            <?php foreach($res['list'] as $k=>$v):?><img class="<?php echo $k==0?'teacher_first':'';?>" src="<?php echo $v['pic'];?>" width="180px" height="290px" data-info="<?php echo $v['info'];?>"><?php endforeach;?>
        </div>
        <div class="teacher_cont_right">
            <img  src="img/homepage_button_right.png">
        </div>
    </div>
    <div class="teacher_album">
        <img class="teacher_album_x" src="img/teacher_x.png">
        <img class="teacher_album_pic" src="img/teacherpage_pic_big1.png">
    </div>
<!--    <img src="img/teacherpage_pic1.png">-->
<!--    <img src="img/teacherpage_pic_big1.png">-->
</div>
<script>
    var left=0;
    var min=<?php echo $res['total']?>*-210;
    $('.teacher_cont_right').click(function () {
        if(left-210 > min){
            left-=210;

            $('.teacher_first').animate({
                'margin-left':left
            });
        }

    });
    $('.teacher_cont_left').click(function () {
        if(left+210 <= 0){
            left+=210;

            $('.teacher_first').animate({
                'margin-left':left
            });
        }

    });
    $('.teacher_items img').mouseenter(function () {
        $(this).stop(true,true);
        $(this).animate({
            'margin-top':0
        });
    });
    $('.teacher_items img').mouseleave(function () {
        $(this).animate({
            'margin-top':10
        });
    });
    $('.teacher_items img').click(function () {
        $('.teacher_album').show();
        $('.teacher_album_pic').prop('src',$(this).data('info'));
    });
    $('.teacher_album_x').click(function () {
        $('.teacher_album').hide();
    });

</script>
<?php include 'foot.html' ?>
