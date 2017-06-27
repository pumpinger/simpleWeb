<?php include 'head.html'; ?>
<?php include 'nav.php' ?>
<style>
    .sat {}
    .sat_left {margin: 50px 0 0 280px;display: inline-block;vertical-align: top;width: 420px;}
    .sat_left p,.sat_left ul{line-height: 26px;margin-top: 20px;}
    .sat_left_title {margin-bottom: 40px;}
    .sat_right {display: inline-block;vertical-align: top;margin-left: 200px;margin-top: 20px;position: relative;}
    .sat_right_line {width: 3px;margin-top:60px;height: 340px;background: #6a6a6a;position: absolute;z-index: -1;}
    .sat_right_point  {margin-left: -23px;}
    .sat_right_point p {padding-left: 70px;line-height:40px;margin:30px 0;background: url('img/course_button1.png') no-repeat 14px center;cursor: pointer;}
    .sat_right_point .active{background: url('img/course_button2.png') no-repeat 0 center;}

    .sat_left_2,.sat_left_3,.sat_left_4,.sat_left_5,.sat_left_6 {display: none;}
    .sat_left_point {font-size: 30px;color: #ffee07;vertical-align: top;margin-right: 6px;}

</style>
<div class="sat">
    <span class="sat_left">
        <div class="sat_left_1">
            <img class="sat_left_title" src="img/coursepage_SAT_text1.png">
            <img src="img/coursepage_SAT_pic1.png">
            <ul>
                <li><span class="sat_left_point">·</span>词汇：词汇的选择及形近，意近词汇的辨析，掌握高频词汇</li>
                <li><span class="sat_left_point">·</span>语法：长难句分析、句子改错及段落改进题技巧点拨</li>
                <li><span class="sat_left_point">·</span>填空：词汇的选择及形近，意近词汇的辨析，掌握高频词汇</li>
                <li><span class="sat_left_point">·</span>阅读：阅读技巧的运用、练习及相关篇章的背景知识介绍</li>
                <li><span class="sat_left_point">·</span>写作：例证，思路的拓展等写作技巧讲解及练习</li>
                <li><span class="sat_left_point">·</span>数学：专业词汇补充及题目练习</li>
            </ul>
        </div>
    </span>
    <span class="sat_right">
        <div class="sat_right_line"></div>
        <div class="sat_right_point">
            <p class="active"><img src="img/coursepage_SAT_text2.png"></p>
            <p><img src="img/coursepage_SAT_text3.png"></p>
            <p><img src="img/coursepage_SAT_text4.png"></p>
            <p><img src="img/coursepage_SAT_text5.png"></p>
            <p><img src="img/coursepage_SAT_text6.png"></p>
            <p><img src="img/coursepage_SAT_text7.png"></p>
        </div>
    </span>
</div>
<script>
    $('.sat_right_point p').mouseenter(function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var i=$(this).index()+1;
        $('.sat_left_1 ul li').css('color','inherit');
        $('.sat_left_1 ul li:nth-child('+i+')').css('color','#ffee07');
    });
</script>
<?php include 'foot.html' ?>
