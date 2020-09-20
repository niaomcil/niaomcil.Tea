<?php
    session_start();
    require_once "connect.php";
    $_SESSION["name"]="游客";
    $stmt1=$dbh -> prepare('select id from user where username = ?');
    if(isset($_SESSION["isLogin"])&&$_SESSION["isLogin"] = 1)
    {
        $_SESSION["name"]=$_SESSION["username"];
        $stmt1 -> execute(array($_SESSION["name"]));
        list($_SESSION["uid"])=$stmt1->fetch(PDO::FETCH_NUM);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
    <title>首页</title>
    <link type="text/css" rel="stylesheet" href="css/index.css">
    <script src="js/jquery1.42.min.js" type="text/javascript"></script>
    <script src="js/jquery.SuperSlide.2.1.js" type="text/javascript"></script>
    <script src="js/slider.js" type="text/javascript"></script>
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
               <a href="#"><li class="dark"><p>首页</p></li></a>
               <a href="login.html"><li class="dark"><p>登录注册</p></li></a>
               <a href="help.html"><li class="dark"><p>服务中心</p></li></a>
               <a href="aboutus.html"><li class="dark"><p>关于我们</p></li></a>
           </ul>
       </div>
    </div>
    <div id="headphoto">
        <nav id="slider">
            <ul id="index">
                <li class="on"></li>
                <li></li>
                <li></li>
            </ul>
            <ul id="img">
                <li><img src="img/index/syxct1.jpg" alt=""></li>
                <li><img src="img/index/syxct2.jpg" alt=""></li>
                <li><img src="img/index/syxct3.jpg" alt=""></li>
            </ul>
        </nav>
   </div>
    <div id="intro">
       <div class="border1">
           <div class="border2">
           <p>　 “名茶坊”以与著名原产地的厂商达成直接合作的模式理念，在线销售“中国十大名茶”，让顾客通过最方便快捷的途径尝到名茶的香醇、感受到名茶的魅力。</p>
           </div>
       </div>
   </div>
    <div id="ten">
      <img class="title" src="img/index/4.1mingcha.png">
       <ul class="pic1">
           <li><a href="showproduct.php?name=碧螺春" class="pic1-1"></a></li>
           <li><a href="showproduct.php?name=黄山毛峰" class="pic1-2"></a></li>
           <li><a href="showproduct.php?name=君山银针" class="pic1-3"></a></li>
           <li><a href="showproduct.php?name=六安瓜片" class="pic1-4"></a></li>
           <li><a href="showproduct.php?name=庐山云雾茶" class="pic1-5"></a></li>
       </ul>
       <ul class="pic2">
           <li><a href="showproduct.php?name=祁门红茶" class="pic2-1"></a></li>
           <li><a href="showproduct.php?name=铁观音" class="pic2-2"></a></li>
           <li><a href="showproduct.php?name=武夷岩茶" class="pic2-3"></a></li>
           <li><a href="showproduct.php?name=西湖龙井" class="pic2-4"></a></li>
           <li><a href="showproduct.php?name=信阳毛尖" class="pic2-5"></a></li>
       </ul>
   </div>
    <div id="chandi">
       <img class="title" src="img/index/4.2chandi.png">
       <div class="neirong">
          <?php
           $_SESSION["chandi"]="产地";
           $query="select * from tealocation order by rand() limit 4";
           $stmt1=$dbh -> prepare('select imgsrc,imgname from picture where type = ? and typename = ? and name = ?');
           $stmt=$dbh->query($query);
           $count=0;
           foreach($stmt as $row){
               $count+=1;
               $stmt1 -> execute(array($_SESSION["chandi"],$row["location"],$row["teatype"]));
               list($src,$imgname)=$stmt1->fetch(PDO::FETCH_NUM);
               $str=$src.$imgname;
               if($count==1)
               {
                   echo '<div class="left"><div><img src="'.$str.'">
                   <p class="guapian">'.$row["teatype"].'：'.$row["title"].'</p>
                   <p>　　'.$row["intro"].'<a href="showproduct.php?name='.$row["teatype"].'#pic">>>更多</a></p></div></div>';
               }
               if($count==2){echo '<div class="right">';}
               if($count>1){
                   echo '<div>
                   <img src="'.$str.'"><p class="lefttop">'.$row["title"].'</p>
                   <p class="leftbottom">——'.$row["teatype"].'<a href="showproduct.php?name='.$row["teatype"].'#pic">>>详细</a></p></div>';
               }
               if($count==4){echo '</div>';}
           }
            ?> 
       </div>
   </div>
    <div id="chaju">
       <img class="title" src="img/index/4.3chaju_03.png">
       <div class="neirong">
           <div class="box">
              <a href="cj.php#zsh">
               <img src="img/teapot/8zsh.png">
               <p class="biaoti">紫砂壶</p>
               <p class="zhengwen">栗色暗暗，如古今铁，孰旁周正。</p>
               <p class="a">>>详细</p>
               </a>
           </div>
           <div class="box">
              <a href="cj.php#cz">
               <img src="img/teapot/8cz.png">
               <p class="biaoti">瓷盏</p>
               <p class="zhengwen">瓯越州上，口唇不卷，底卷而浅，受半升而已。</p>
               <p class="a">>>详细</p>
               </a>
           </div>
           <div class="box">
              <a href="cj.php#cs">
               <img src="img/teapot/8cc.png">
               <p class="biaoti">茶匙</p>
               <p class="zhengwen">“茶道六君子”之首</p>
               <p class="a">>>详细</p>
            </a>
           </div>
           <a href="cj.php?type=茶具"><img class="more" src="img/index/9.png"></a>
       </div>
   </div>
    <div id="bottom">
       <img src="img/10.png">
        <div>
           <p>Copyright 2018 minchafang.cn All Rights Reserved.琼22222222-1号</p>
           <p>名茶坊有限公司 版权所有 并保留所有权利禁止非法复制</p>
        </div>
   </div>
   </div>
</body>
</html>