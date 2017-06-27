<?php include 'head.html'; ?>
<?php include 'nav.php' ?>
<?php include 'config.php' ?>
<?php include 'functions.php' ?>

<?php

$mysqli=connectDB();


$res=loadForm('dynamic',$_GET['id']);
?>
<style>
    .trendDetail {margin-left: 250px;margin-right: 250px;min-height: 500px;overflow: auto;}
    .trendDetail_title{text-align: center;letter-spacing: 20px;font-size: 32px;font-weight: bold;}
</style>
<div class="trendDetail">
    <div class="trendDetail_title"><?php echo $res['name'];?></div>
    <?php echo htmlspecialchars_decode($res['content']);?>
</div>
<script>
</script>
<?php include 'foot.html' ?>
