<?php include 'head.html'; ?>
<?php include 'nav.php' ?>
<style>
    .about {position: relative;}
    .about_cont {width: 1000px;margin-left: 100px;position: relative;}
    .about_pic {position: absolute;right: 0;top: -134px;z-index: 0;}

    .about_title {margin-left: 180px;}
    .about_text1 {margin:80px 0 100px 280px;width: 400px;letter-spacing: 1px;line-height: 22px;height: 240px;}
    .about_text1 h2{margin-bottom: 10px;}
    .about_text2 {margin:40px 0 100px 240px;width: 440px;line-height: 20px;display: none;height: 280px;font-size: 12px;}
    .about_text2 h4{margin-bottom: 2px;margin-top: 20px;}

    .about_nav div{display: inline-block;vertical-align: bottom;margin-right: 2px;background: #f8f8f8;cursor: pointer;}
    .about_nav div p{vertical-align: bottom;font-size: 20px;text-align: center;padding-top: 20px;}
    .about_nav .block1 {width: 214px;height: 88px;}
    .about_nav .block2 {width: 194px;height: 88px;}
    .about_nav .block3 {width: 194px;height: 88px;}
    .about_nav .block4 {width: 234px;height: 88px;}
    .about_nav .active {background: url("img/aboutpage_yellow.png");width: 224px;height: 102px;}
    .about_nav .active p{padding-top: 35px;}

</style>
<div class="about">
    <div class="about_pic">
        <img src="img/about_pic.png">
    </div>
    <div class="about_cont">
        <div class="about_title">
            <img src="img/about_text.png">
        </div>
        <div class="about_text1">
            <h2>英桥文化</h2>
            <p>英桥，沟通世界的桥梁
英桥国际教育（EnQ International Education）是一家拥有海外教育背景的留学语言培训机构，由澳大利亚Rosswell Asia Consultancy注资，成都英启教育咨询有限公司创办，位于蓉城繁华之地春熙路银石广场写字楼，自建立以来专注于TOEFL、IELTS和SAT的优质教学，并与国际接轨，为个人量身定做商务英语课程，为企业提供集体英语指导。师资教龄平均5年以上，熟谙官方考试动向，专注学术研发的同时，关注学生个性发展，以培养优秀人才为导向，拒绝批量生产机器人，因此拥有业内领先的教学成绩，学员通过率也高于行业平均水平，更有10%高分率。同时，我们还将提供留学配套的国际素养课程，注重实用性，使学生能够快速适应国外生活、融入当地主流文化，为留学铺平道路。 </p>
        </div>
        <div class="about_text2">
            <h4>一站式个性化服务</h4>
            <p>英桥为每位学员提供从留学咨询、培训规划到出国文书编写一站式服务，实施定制化教学模式，最大程度匹配学员吸收能力，为您节省时间成本。</p>
            <h4>资深名师授课</h4>
            <p>托福、雅思、SAT一线教师授课，平均5年以上教龄，保证授课质量。</p>
            <h4>专业的顾问团队</h4>
            <p>至少3年从业经验的精英咨询院队，紧抓考试流程与动向，是您最可靠的智囊团。</p>
            <h4>课后实时答疑辅导</h4>
            <p>专业助教，课后及时抽查学习情况，助您查漏补缺，提高学习效率，保证学习质量。</p>
            <h4>配套国际素养课程</h4>
            <p>由多名资深海外留学顾问打造的国际素养课程，从批判思维、创造力、领导力、社交礼仪等多方面助力学子海外留学生活。</p>
            </p>
        </div>
        <div class="about_nav">
            <div class="block1"></div>
            <div class="block2">
                <p>英桥优势<br>Advantages</p>
            </div>
            <div class="block3 active">
                <p>英桥文化<br>Culture</p>
            </div>
            <div class="block4"></div>
        </div>
    </div>
</div>
<?php include 'foot.html' ?>
<script>
    $('.about_nav .block2').mouseenter(function () {
        if(!$(this).hasClass('active')){
            $('.about_text1').hide();
            $('.about_text2').show();
            $('.about_nav div').removeClass('active');
            $(this).addClass('active');
        }

    });
    $('.about_nav .block3').mouseenter(function () {
        if(!$(this).hasClass('active')){
            $('.about_text2').hide();
            $('.about_text1').show();
            $('.about_nav div').removeClass('active');
            $(this).addClass('active');
        }

    });


</script>
