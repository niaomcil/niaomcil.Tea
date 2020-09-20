<?php
    session_start();
    require_once "connect.php";
    if(isset($_SESSION["isLogin"])&&$_SESSION["isLogin"] = 1)
    {
        $_SESSION["name"]=$_SESSION["username"];
    }
    $_SESSION["title"]="";
    $stmt1=$dbh -> prepare('select * from product where type = ?');
    $stmt2=$dbh -> prepare('select typename,imgsrc,imgname from picture where  name = ?');
    $stmt3=$dbh -> prepare('select id from product where name = ?');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
<title>茶具</title>
<link type="text/css" rel="stylesheet" href="css/cj.css">
<style type="text/css">

</style>
</head>
<body>
    <div id="head">
        <p>欢迎 <?php echo $_SESSION["name"];
        if(isset($_SESSION["isLogin"])&&$_SESSION["isLogin"] = 1)
    {
        echo '<a href="logout.php">退出</a> <a href="shopcart.php">我的购物车</a>';
    }
        ?>
        </p>
    </div>
   <div id="body">
    <div id="header">
        <div class="left">
       		<a href="index.php"><img class="logo1" src="img/logo2.jpg"></a>
       		<a href="index.php"><img class="logo2" src="img/1.png"></a>
       </div>
       <div class="right">
           <ul class="headnav">
               <a href="index.php"><li class="dark"><p>首页</p></li></a>
               <a href="login.html"><li class="dark"><p>登录注册</p></li></a>
               <a href="help.html"><li class="dark"><p>服务中心</p></li></a>
               <a href="aboutus.html"><li class="dark"><p>关于我们</p></li></a>
           </ul>
       </div>
    </div>
<div id="zsh">
    <img src="img/teapot/zsh_03.png">
        <div id="box1">
        <?php
            $_SESSION["title"]="紫砂壶";
            $stmt1 -> execute(array($_SESSION["title"]));
            foreach($stmt1 as $row){
                $stmt2 -> execute(array($row["name"]));
                list($type,$src,$imgname)=$stmt2->fetch(PDO::FETCH_NUM);
                $str=$src.$imgname;
                $stmt3 -> execute(array($row["name"]));
                list($pid)=$stmt3->fetch(PDO::FETCH_NUM);
                echo '<form action="shopcart.php" method="post"><div class="box2">
               <img src="'.$str.'">
               <h2>精品'.$type.'·'.$row["name"].'</h2>
               <h3>'.$row["intro"].'</h3>
               <h1>￥'.$row["price"].'</h1><input name="value" class="value" value="'.$pid.'"/><input name="btn1" class="btn1" type="submit" value="立即购买"/>
            </div></form>'; 
            }
        ?>
    </div>
</div>
<div id="cz">
    <img src="img/teapot/cz_03.png">
        <div id="box2">
         <?php
            $_SESSION["title"]="瓷盏";
            $stmt1 -> execute(array($_SESSION["title"]));
            foreach($stmt1 as $row){
                $stmt2 -> execute(array($row["name"]));
                list($type,$src,$imgname)=$stmt2->fetch(PDO::FETCH_NUM);
                $str=$src.$imgname;
                $stmt3 -> execute(array($row["name"]));
                list($pid)=$stmt3->fetch(PDO::FETCH_NUM);
                echo '<form action="shopcart.php" method="post"><div class="box2">
               <img src="'.$str.'">
               <h2>精品'.$type.'·'.$row["name"].'</h2>
               <h3>'.$row["intro"].'</h3>
               <h1>￥'.$row["price"].'</h1><input name="value" class="value" value="'.$pid.'"/><input name="btn1" class="btn1" type="submit" value="立即购买"/>
            </div></form>'; 
            }
        ?>
    </div>
</div>
<div id="cs">
    <img src="img/teapot/cs_03.png">
        <div id="box3">
         <?php
            $_SESSION["title"]="茶匙";
            $stmt1 -> execute(array($_SESSION["title"]));
            foreach($stmt1 as $row){
                $stmt2 -> execute(array($row["name"]));
                list($type,$src,$imgname)=$stmt2->fetch(PDO::FETCH_NUM);
                $str=$src.$imgname;
                $stmt3 -> execute(array($row["name"]));
                list($pid)=$stmt3->fetch(PDO::FETCH_NUM);
                echo '<form action="shopcart.php" method="post"><div class="box2">
               <img src="'.$str.'">
               <h2>精品'.$type.'·'.$row["name"].'</h2>
               <h3>'.$row["intro"].'</h3>
               <h1>￥'.$row["price"].'</h1><input name="value" class="value" value="'.$pid.'"/><input name="btn1" class="btn1" type="submit" value="立即购买"/>
            </div></form>'; 
            }
        ?>
    </div>
</div>
<div id="bottom">
        <div>
           <p>Copyright 2018 minchafang.cn All Rights Reservrd.琼22222222-1号</p>
           <p>名茶坊有限公司 版权所有 并保留所有权利禁止非法复制</p>
        </div>
   </div>
</div>
</body>
</html>
