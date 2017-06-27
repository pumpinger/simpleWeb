<?php include 'head.html' ?>
<style>
    .first {background: #ffffff;width: 100%;}
    .first_cont {text-align: center;margin-top: -10px;}
    .first_cont_img2 {margin-top: 80px;}
    .first_cont_img3 {margin-top: 80px;padding-bottom: 100px;}
    .home {display: none;}
    .nav {display: none;}
    .first .nav {display: block;}
    .first .nav_item .active {color: inherit;}
    .first .nav_logo {display: none;}
    .left {display: none;}
</style>
<div class="first">
    <?php include 'nav.php' ?>
    <img src="img/home_triangle.png" />
    <div class="first_cont">
        <img src="img/home_logo_big.png" /><br>
        <img src="img/home_text.png" class="first_cont_img2"/><br>
        <img src="img/home_logo_bottom.png" class="first_cont_img3"/>
    </div>
</div>
<?php include 'home.php'; ?>
<script>
    (function(){
        $('.first').mousedown(function (){
            $('.home').show();
            $('.nav').show();
            $(this).fadeOut(500);
        });
        $('.first .nav').mousedown(function (e){
            e.stopPropagation();
        });
    })()
</script>
<?php include 'foot.html' ?>


