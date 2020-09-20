<?php
    session_start();
    require_once "connect.php";
    $stmt1=$dbh -> prepare('select min(price) from product where name = ?');
    $stmt2=$dbh -> prepare('select max(price) from product where name = ?');
    $stmt3=$dbh -> prepare('select level from product where name = ?');
    $stmt4=$dbh -> prepare('select id, price from product where name = ? and level=?');
    $stmt5=$dbh -> prepare('select imgsrc,imgname from picture where type = ? and typename = ?');
    $stmt6=$dbh -> prepare('select imgsrc,imgname from picture where type = ? and name = ?');
    $stmt8=$dbh -> prepare('select * from cart where userid = ? and productid = ?');
    $stmt1 -> execute(array($_GET["name"]));
    $stmt2 -> execute(array($_GET["name"]));
    $stmt3 -> execute(array($_GET["name"]));
    if(isset($_POST["joincart"])&&$_SESSION["price"]>0){
        if($_SESSION["isLogin"] = 1)
        {
            $stmt8 -> execute(array($_SESSION["uid"],$_SESSION["levelid"]));
            list($uid,$productid,$sum)=$stmt8->fetch(PDO::FETCH_NUM);
            if($stmt8->rowCount() == 0){
                $query1='INSERT INTO cart(userid, productid, sum) VALUES ('.$_SESSION["uid"].','.$_SESSION["levelid"].','.$_POST["count"].')';
                $dbh->exec($query1);
                if($_POST["joincart"]=="立即购买"){
                    header("location:shopcart.php");
                }
            }else{
                $sum1=$_POST["count"]+$sum;
                echo $sum1;
                $query2='UPDATE cart SET sum='.$sum1.' where userid='.$_SESSION["uid"].' and productid='.$_SESSION["levelid"];
                $dbh->exec($query2);
                if($_POST["joincart"]=="立即购买"){
                    header("location:shopcart.php");
                }
            }
        }else{
            echo '<script>alert("请先登录!")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_GET["name"]; ?></title>
    <link type="text/css" rel="stylesheet" href="css/showproduct.css">
    <script src="js/count.js" type="text/javascript"></script>
    <script src="js/show.js" type="text/javascript"></script>
    <script>
        window.onload=function(){
            count();
            slider();
        }
    </script>
    <style>
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
    <div id="left"><a href=""><img src="img/ad1.jpg"></a></div>
    <div id="right"><a href=""><img src="img/ad2.jpg"></a></div>
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
    <div id="main">
           <div class="left">
               <div id="photo">
                <nav id="slider">
                <ul id="index">
                   <?php
                    $_SESSION['zhonglei']="商品图";
                    $count=0;
                    $stmt6 -> execute(array($_SESSION['zhonglei'],$_GET["name"]));
                        foreach($stmt6 as $row){
                            $str=$row["imgsrc"].$row["imgname"];
                            if($count==0)
                            {
                                echo '<li class="on"><img src="'.$str.'" alt=""></li>';
                            }
                            else{
                                echo '<li><img src="'.$str.'" alt=""></li>';
                            }
                            $count++;
                        }
                    ?>
                </ul>
                <ul id="img">
                   <?php
                    $stmt6 -> execute(array($_SESSION['zhonglei'],$_GET["name"]));
                        foreach($stmt6 as $row){
                            $str=$row["imgsrc"].$row["imgname"];
                            echo '<li><img src="'.$str.'" alt=""></li>';
                        }
                    ?>
                </ul>
                </nav>
               </div>   
           </div>
           <div class="right">
            <?php 
               echo '<h2 id="w1">精品  '.$_GET["name"].'</h2>';
               if(isset($_POST["btn"])){
                   $_SESSION["level"]=$_POST["btn"];  
               }
               if(!isset($_POST["btn"])&&!isset($_POST["joincart"])){
                   list($min)=$stmt1->fetch(PDO::FETCH_NUM);
                   list($max)=$stmt2->fetch(PDO::FETCH_NUM);
                   if($min!=$max)
                   {
                       echo '<div id="box1"><h3 id="w2">价格<h3 id="w3">¥'.$min.' - ¥'.$max.'</h3></h3></div>';
                   }else
                   {
                       echo '<div id="box1"><h3 id="w2">价格<h3 id="w3">¥'.$min.'</h3></h3></div>';
                   }
               }else{
                   $stmt4 -> execute(array($_GET["name"],$_SESSION["level"]));
                   list($id,$value)=$stmt4->fetch(PDO::FETCH_NUM);
                   echo '<div id="box1"><h3 id="w2">价格<h3 id="w3">¥'.$value.'</h3></h3></div>';
                   $_SESSION["levelid"]=$id;
                   $_SESSION["price"]=$value;
               }
               
               echo '<form action="" method="post"><h4 id="w4">配送 <a class="a">三亚</a> 至 <input name="" type="text" size="7" class="input"value="北京"><p id="w5">包邮&nbsp;&nbsp;24小时内发货</p></h4><h4 id="w4">等级</h4>
               <div id="box2">';
               foreach($stmt3 as $row){
                    echo '<input name="btn" type="submit"  value="'.$row['level'].'" class="btn">';
                }
               echo '</div><br/>
               <h4 id="w4">数量
               <input id="num-jian" name="but1" type="button" class="btn1" value="-">
               <input id="input-num" name="count" type="text" class="t1" size="5" value="1">
               <input id="num-jia" name="but2" type="button" class="btn1" value="+">
               </h4>
              <input name="joincart" type="submit" class="btn3" value="立即购买">
              <input name="joincart" type="submit" class="btn4" value="★加入购物车"></form>';
           ?>
        </div>
    </div>
    <div id="pic">
          <?php
            $_SESSION["jianjie"]="简介";
            $stmt5 -> execute(array($_SESSION["jianjie"],$_GET["name"]));
            list($src,$imgname)=$stmt5->fetch(PDO::FETCH_NUM);
               $str=$src.$imgname;
            echo '<img src="'.$str.'">';
            ?>
    </div>
    <div id="bottom">
       <img src="img/10.png">
        <div>
           <p>Copyright 2018 minchafang.cn All Rights Reservrd.琼22222222-1号</p>
           <p>名茶坊有限公司 版权所有 并保留所有权利禁止非法复制</p>
        </div>
       </div>
    </div>
</body>
</html>
