<?php
    session_start();
    require_once "connect.php";
    $stmt1=$dbh -> prepare('select * from product');
    $stmt2=$dbh -> prepare('select * from picture');
    $stmt3=$dbh -> prepare('select * from tealocation');
    $stmt1 -> execute();
    $stmt2 -> execute();
    $stmt3 -> execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<link type="text/css" rel="stylesheet" href="css/entrance.css">
	<script type="text/javascript">
function show1(x){
	document.getElementById('pro').style.display="none";
	document.getElementById('pic').style.display="none";
	document.getElementById('loc').style.display="none";
	var second=x.getAttribute('subbox');
	document.getElementById(second).style.display="block";
}	
</script>
</head>

<body>
<h1 class="title">信息后台管理</h1>
<div class="box">
	<ul id="nav">
        <li id="product" >
        	<a subbox="pro" onclick="show1(this)" href="#">产品</a>
        	<div class="one" id="pro">
				<h1>产品</h1><br>
				<form action="" method="post">
                    <table id="Table">
                        <tr>
                            <th>产品种类</th>
                            <th>产品名称</th>
                            <th>产品等级</th>
                            <th>产品单价</th>
                            <th>产品简介</th>
                         </tr>
                        <?php
                            foreach($stmt1 as $row)
                            {
                                echo '<tr><td>'.$row["type"].'</td><td>'.$row["name"].'</td><td>'.$row["level"].'</td><td>'.$row["price"].'</td><td>'.$row["intro"].'</td></tr>';
                            }
                        ?>
                    </table>
                </form>
       </div>
      </li>
        <li id="picture">
        	<a subbox="pic" onclick="show1(this)" href="#">图片</a>
        	<div class="one" id="pic">
				<h1>图片</h1><br>
				<p>学习</p>
                <p>睡觉</p>
				<p>做作业</p>
       </div>
        </li>
        <li id="location">
        	<a subbox="loc" onclick="show1(this)" href="#">产地</a>
        	<div class="one" id="loc">
                <h1>产地</h1><br>
				<p>学习</p>
                <p>睡觉</p>
				<p>做作业</p>
          </div>
        </li>
        <li>
        	<a href="index.php">返回首页</a>
        </li>
	</ul>
</div>
</body>
</html>
