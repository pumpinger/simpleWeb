<?php
$msg='';
if($_POST){

    $query='select * from t_admin';
    $result=$mysqli->query($query);
    if ($result && $result->num_rows>0) {
            while($row =$result->fetch_array() ){
                if($_POST['user'] == $row['user'] && md5($_POST['pwd']) == $row['pwd']){
                    $_SESSION['user']= $row['user'];
                    renderPage('index');
                    exit;
                }
            }
        $msg='用户名或密码错误';
    }
    $msg='数据库错误';

    $result->free();

};



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>登陆</title>
    <style>
        body, dl, dd, h1, h2, h3, h4, h5, h6, p, form{margin:0;}
        ol,li,ul{margin:0; padding:0;list-style: outside none none;}
        p,div {word-wrap:break-word;}
        a{text-decoration:none;color: inherit;}
        img{border: 0;}
        table{border-collapse:collapse;border-spacing:0;}
        label {cursor:pointer;}
        input, button, textarea, select {font-size: inherit;width: auto;padding:0;}

        body {
            background: #f3f3f4;
            font-family: "\5FAE\8F6F\96C5\9ED1", sans-serif;
        }

        .main_c {
            width: 300px;
            margin: auto;
        }

        .login_tit {
            font-size: 20px;
            margin-top: 200px;
            text-align: center;
            margin-bottom: 20px;
        }

        .the-padding-left {
            box-sizing: border-box;
            background-color: #FFFFFF;
            background-image: none;
            border: 1px solid #e5e6e7;
            border-radius: 1px;
            color: inherit;
            display: block;
            padding: 6px 12px;
            transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            width: 300px;
            margin-bottom: 10px;
            border-radius: 2px;;
            font-size: 14px
        }

        .btn {
            width: 100%;
            display: block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            background: #18a689;
            color: #FFFFFF;
        }

        .copyright {
            margin-top: 10px;
            text-align: center;
        }

        .errorMessage {
            margin-bottom: 10px;
            color: red;
        }
    </style>

</head>
<body>
    <div class="main-content">
        <div class="main_c">
            <div class="form_w ">
                <form action="" class="form_act" method="post">
                    <div class="login_tit">
                        后台管理
                    </div>
                    <span class="block input-icon  ">
                        <input class="form-control the-padding-left" placeholder="account" type="text" value="" name="user">
                    </span>
                    <span class="block input-icon ">
                        <input class="form-control the-padding-left" placeholder="password" type="password" value="" name="pwd" >
                    </span>

                    <div class="errorMessage"><span class="error"><?php echo $msg;?></span></div>

                    <div>
                        <button type="submit" class="btn btn-danger btn-block">登 录</button>
                    </div>
                </form>
            </div>
            <div class="copyright">
                &copy; <?php echo date('Y') ?>
            </div>
        </div>
    </div>

</body>
</html>
