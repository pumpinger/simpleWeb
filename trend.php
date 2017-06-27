<?php include 'head.html'; ?>
<?php include 'nav.php' ?>
<?php include 'config.php' ?>
<?php include 'functions.php' ?>

<?php

$mysqli=connectDB();


$res=tableHandler('dynamic',false,3);
?>
<style>
    .trend {position: relative;margin-left: 200px;min-height: 620px;}
    .trend_bg {position: absolute;top:-134px;right:480px;}
    .trend_cont {padding-top:40px; }
    .trend_page a {border: 1px solid #1b1b1b;text-align: center;line-height:24px;display: inline-block;width: 20px;}
    .trend_page a:hover ,.trend_page .active {background: #ffee07;color: #FFFFFF;}

    .trend_list1,.trend_list2,.trend_list3 {margin-top: 125px;display: inline-block;width: 150px;vertical-align: top;margin-right: 80px;height: 310px;overflow: hidden;}
    .trend_list3 {margin-left: 260px;}
    .trend_name {font-weight: bold;font-size: 16px;white-space: nowrap;}
    .trend_name:hover {color: #ffee07;}
    .trend_num {font-size: 68px;margin: 20px 0 10px 0;font-family: Helvetica sans-serif;}
    .trend_intro {font-size: 12px;line-height: 24px;}
    .trend_page {margin-top: 50px;text-align: right;padding-right: 100px;}
</style>
<div class="trend">
    <div class="trend_bg">
        <img src="img/trends_pic.png">
    </div>
    <div class="trend_cont">
        <img src="img/trends_text.png"><br>
        <?php foreach($res['list'] as $k=>$v):?>
            <?php $num=($res['page']-1)*3+$k+1;?>
            <span class="trend_list<?php echo $k+1;?>"">
                <a href="trendDetail.php?id=<?php echo $v['id'];?>" class="trend_name"><?php echo $v['name'];?></a>
                <div class="trend_num"><?php echo $num < 10 ? '0'.$num:$num;?></div>
                <div class="trend_intro"><?php echo nl2br($v['intro']);?></div>
            </span>
        <?php endforeach;?>
    </div>
    <div class="trend_page">
        <?php foreach($res['pagination'] as $k=>$v):?>
            <a class="<?php echo $k==$res['page']?'active':'';?>" href="<?php echo $v;?>"><?php echo $k;?></a>
        <?php endforeach;?>
    </div>
</div>
<script>

</script>
<?php include 'foot.html' ?>
