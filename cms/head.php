<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>英桥国际内容管理</title>
    <script type="text/javascript" src="<?php echo APP_ROOT;?>js/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="<?php echo APP_ROOT;?>cms/css/cms.css"/>
    <link rel="stylesheet" href="<?php echo APP_ROOT;?>plug/icon/iconfont.css"/>
</head>
<body>
<div class="cms">
    <div class="sidebar">
        <div class="banner" >
<!--            <span class="name">英桥国际</span>-->
            <img src="img/home_logo_bottom.png">
        </div>
        <ul class="left_nav">
            <?php if( $_SESSION['user'] ):?>
                <li class="<?php echo in_array('teacherList',$breadcrumbs)?'active':'';?>">
                    <a href="<?php createUrl('teacherList');?>">
                    <span class="menu-text">
                        教师管理
                    </span>
                    </a>
                </li>
                <li class="<?php echo in_array('studentList',$breadcrumbs)?'active':'';?>">
                    <a href="<?php createUrl('studentList');?>">
                    <span class="menu-text">
                        学生管理
                    </span>
                    </a>
                </li>
                <li class="<?php echo in_array('dynamicList',$breadcrumbs)?'active':'';?>">
                    <a href="<?php createUrl('dynamicList');?>">
                    <span class="menu-text">
                        动态管理
                    </span>
                    </a>
                </li>
                <li class="<?php echo in_array('examList',$breadcrumbs)?'active':'';?>">
                    <a href="<?php createUrl('examList');?>">
                    <span class="menu-text">
                        试卷管理
                    </span>
                    </a>
                </li>
                <li class="<?php echo in_array('downloadInfo',$breadcrumbs)?'active':'';?>">
                    <a href="<?php createUrl('downloadInfo');?>">
                    <span class="menu-text">
                        下载信息
                    </span>
                    </a>
                </li>
                <li class="<?php echo in_array('chgPwd',$breadcrumbs)?'active':'';?>">
                    <a href="<?php createUrl('chgPwd');?>">
                    <span class="menu-text">
                        修改密码
                    </span>
                    </a>
                </li>
            <?php endif;?>
            <li class="<?php echo in_array('downloadExam',$breadcrumbs)?'active':'';?>">
                <a href="<?php createUrl('downloadExam');?>">
                    <span class="menu-text">
                        试卷领取
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="bar">
            <div class="bar-header">
                <span class="top_txt">联系方式：***** </span>
                <?php if( $_SESSION['user'] ):?>
                    <a href="<?php createUrl('logout');?>">
                        <i class="icon-off"></i>
                        退出
                    </a>
                <?php else:?>
                    <a href="<?php createUrl('index');?>">
                        <i class="icon-off"></i>
                        登录
                    </a>
                <?php endif;?>
            </div>
        </div>


        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php createUrl('index');?>">首页</a>
                </li>
                <?php if(isset($breadcrumbs)):?>
                    <?php foreach ($breadcrumbs as $k=> $v):?>
                        <li>
                            <a href="<?php createUrl($v);?>"><?php echo $k?></a>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
<!--                <li>-->
<!--                    <a class="active"  href="">home</a>-->
<!--                </li>-->
            </ul>
        </div>

        <div class="content">


