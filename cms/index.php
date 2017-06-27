<?php

$breadcrumbs=array();


include 'head.php';
?>

<div class="well">
    <h1>欢迎您 , <?php echo $_SESSION['user']?:'普通用户' ?></h1>
</div>

<?php include 'foot.php';?>
