<?php
    session_start();
    require_once "connect.php";
    $_SESSION["heji"]=0;
    if(isset($_SESSION["isLogin"])&&$_SESSION["isLogin"] = 1)
    {
        $_SESSION["name"]=$_SESSION["username"];
    }else{
        header("Location:login.html");
    }
    $stmt1=$dbh -> prepare('DELETE from cart where userid = ? and productid = ?');
    $stmt2=$dbh -> prepare('select productid, sum from cart where userid = ?');
    $stmt3=$dbh -> prepare('select name, level, price from product where id = ?');
    $stmt4=$dbh -> prepare('select imgsrc, imgname from picture where name = ? and type="商品图" limit 1');
    $stmt5=$dbh -> prepare('select * from cart where userid = ? and productid = ?');
    if(isset($_POST["btn1"]))
    {
        $stmt5 -> execute(array($_SESSION["uid"],$_POST["value"]));
            list($uid,$productid,$sum)=$stmt5->fetch(PDO::FETCH_NUM);
            if($stmt5->rowCount() == 0){
                $query1='INSERT INTO cart(userid, productid, sum) VALUES ('.$_SESSION["uid"].','.$_POST["value"].',1)';
                $dbh->exec($query1);
            }
    }
    if(isset($_POST["Submit"])){
        $arr = array();
        $arr = $_POST["checked"];
        foreach ($arr as $k=>$v){
            $stmt1 -> execute(array($_SESSION["uid"],$v));
        } 
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
    <title>购物车</title>
    <link type="text/css" rel="stylesheet" href="css/shopcart.css">
    <script src="js/shopcart.js" type="text/javascript"></script>
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
        <div id="box1"> 
            <form action="" method="post">
            <table id="cartTable">
             <thead>
                 <tr>
                     <th>商品id</th>
                     <th>商品</th>
                     <th>单价</th>
                     <th>数量</th>
                     <th>小计</th>
                     <th>删除</th>
                 </tr>
             </thead>
             <tbody>
                <?php
                    $stmt2 -> execute(array($_SESSION["uid"]));
                    foreach($stmt2 as $row)
                    {
                        $stmt3 -> execute(array($row["productid"]));
                        list($name,$level,$danjia)=$stmt3->fetch(PDO::FETCH_NUM);
                        $stmt4 -> execute(array($name));
                        list($imgsrc,$imgname)=$stmt4->fetch(PDO::FETCH_NUM);
                        $str=$imgsrc.$imgname;
                        $plus=$row["sum"]*$danjia;
                        $_SESSION["heji"] +=$plus;
                        echo '<tr><td class="operation"><span class="delete">'.$row["productid"].'</span></td>
                     <td class="goods"><img src="'.$str.'" alt="" /><span>'.$name.'——'.$level.'</span></td>
                     <td class="price">'.$danjia.'</td>
                     <td class="count">'.$row["sum"].'</td>
                     <td class="subtotal">'.number_format($plus, 2).'</td>
                     <td class="checkbox"><input class="check-one check" name="checked[]" type="checkbox" value="'.$row["productid"].'" /></td>';
                    }
                 ?>
             </tbody>
            </table>
            <div class="foot" id="foot">
             <label class=" fl select-all"><input type="checkbox" class="check-all check" /> 全选</label>
             <label class=" fl select-all"><input type="submit" class="delete" name="Submit" value="确认删除"> </label>
             <div class="fr closing">结 算</div>
             <div class="fr total">合计：￥<span id="priceTotal"><?php echo number_format($_SESSION["heji"],2); ?></span></div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>
