<?php $file=pathinfo($_SERVER['SCRIPT_NAME'])['filename'];?>
<style>
    .nav {position: relative;}
    .nav_logo {padding: 20px 0 40px 20px;}
    .nav_cont {position: absolute;top: 40px;right: 40px;z-index: 10;}
    .nav_item {float: left;margin:0 8px;width: 96px;text-align: center;}
    .nav_menu {display: none;}
    .nav_a {font-size: 16px;}
    .nav_item .active {color: #ffee07;}
    .nav_a:hover,.nav_menu_a:hover {cursor: pointer;color: #ffee07;}
    .nav_menu_a {display: block;background: #dddddd;width: 70px;margin: 0 auto;padding: 3px 0;color: #3d3d3d;}
    <?php if(  'about' == $file ):?>
        .nav_cont {color: #ffffff;}
        .nav_menu_a {color: #ffffff;background:#999390;}
    <?php endif;?>

</style>

<div class="nav">
    <div class="nav_logo">
        <img src="img/home_logo.png">
    </div>

    <div class="nav_cont">
        <div class="nav_item">
            <a href="home.php" class="nav_a <?php echo in_array($file,array('index','home','about','teacher','student'))?'active':'';?>"><b>首页Home</b></a>
            <div class="nav_menu">
                <a class="nav_menu_a <?php echo 'about'==$file?'active':'';?>" href="about.php">关于英桥</a>
                <a class="nav_menu_a <?php echo 'teacher'==$file?'active':'';?>" href="teacher.php">师资介绍</a>
                <a class="nav_menu_a <?php echo 'student'==$file?'active':'';?>" href="student.php">优秀学员</a>
            </div>
        </div>
        <div class="nav_item">
            <a href="ielts.php" class="nav_a <?php echo in_array($file,array('course','ielts','toefl','sat'))?'active':'';?>"><b>课程Course</b></a>
            <div class="nav_menu">
                <a href="ielts.php" class="nav_menu_a <?php echo 'ielts'==$file?'active':'';?>">雅思课程</a>
                <a href="toefl.php" class="nav_menu_a <?php echo 'toefl'==$file?'active':'';?>">托福课程</a>
                <a href="sat.php" class="nav_menu_a <?php echo 'sat'==$file?'active':'';?>">SAT课程</a>
            </div>
        </div>
        <div class="nav_item">
            <a href="trend.php" class="nav_a <?php echo 'trend'==$file?'active':'';?>"><b>动态Trend</b></a>
        </div>
        <div class="nav_item">
            <a href="contact.php" class="nav_a <?php echo 'contact'==$file?'active':'';?>"><b>联系Contact</b></a>
        </div>
    </div>
</div>



<script>
    $('.nav_item').mouseenter(function(){
        $(this).find('.nav_menu').show();
    });
    $('.nav_item').mouseleave(function(){
        $(this).find('.nav_menu').hide();
    });
</script>