<?php $file=pathinfo($_SERVER['SCRIPT_NAME'])['filename'];?>
<?php $file=='index'  ?: include 'head.html'; ?>
<?php include 'nav.php' ?>
<style>
    .home {position: relative;overflow: hidden;}
    .home_album {overflow: auto;width: 5000px;height: 650px;}
    .home_arrow_left {position: absolute;top: 300px;left: 40px;padding:10px;border-radius:4px;background: rgba(255,255,255,.3);cursor: pointer;z-index: 2;}
    .home_arrow_right {position: absolute;top: 300px;right: 40px;padding:10px;border-radius:4px;background: rgba(255,255,255,.3);cursor: pointer;z-index: 2;}
    .home_album img{width:1366px;display: inline;position: absolute;left:1366px;z-index: 0;}
    .home_album .active{left:0;}
    .left {display: none;}
</style>
<div class="home">
    <div class="home_album">
            <img class="active" src="img/home_pic_1.png" />
            <img src="img/home_pic_2.png" />
            <img src="img/home_pic_3.png" />
    </div>
    <div class="home_arrow_left">
        <img  src="img/homepage_button_left.png">
    </div>
    <div class="home_arrow_right">
        <img  src="img/homepage_button_right.png">
    </div>
</div>
<?php $file=='index'  ?: include 'foot.html' ?>
<script>
    var pageWidth=1366;
    var curPicIndex=999; //懒得判断负数
    var picNum=$('.home_album img').length;
    var isAnimate=true;
    $('.home_arrow_right').mousedown(function () {
        if(isAnimate){
            isAnimate=false;
            $('.home_album img:nth-child('+(curPicIndex%picNum+1)+')').animate({
                left:-pageWidth/2
            },700,function(){
                $(this).css({
                    left:-pageWidth
                });
            });
            curPicIndex++;
            $('.home_album img:nth-child('+(curPicIndex%picNum+1)+')').css({
                left:pageWidth,
                zIndex:'1'
            }).animate({
                left:'0'
            },700,function(){
                $(this).css({
                    zIndex:0
                });
                isAnimate=true;
            })
        }

    });

    $('.home_arrow_left').mousedown(function () {
        if(isAnimate){
            isAnimate=false;
            $('.home_album img:nth-child('+(curPicIndex%picNum+1)+')').animate({
                left:pageWidth/2
            },700,function(){
                $(this).css({
                    left:-pageWidth
                });
            });
            curPicIndex--;
            $('.home_album img:nth-child('+(curPicIndex%picNum+1)+')').css({
                left:-pageWidth,
                zIndex:'1'
            }).animate({
                left:'0'
            },700,function(){
                $(this).css({
                    zIndex:0
                });
                isAnimate=true;
            })
        }
    });
</script>
