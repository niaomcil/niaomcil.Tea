<?php
    session_start();
    require "connect.php";
    $url = "login.html"; 
    if(isset($_POST["sub"])){
        if(!empty($_POST["registname"])&&!empty($_POST["registpassword"])){
            $YONGHUMING=$_POST["registname"];
            $MIMA=md5($_POST["registpassword"]);
            $stmt = $dbh -> prepare("select username from user where username=?");
            $stmt -> execute(array($YONGHUMING));
            if($stmt->rowCount() == 0){
                $dbh->exec("INSERT INTO user(username, password) VALUES ('$YONGHUMING','$MIMA')");
                echo '<script>alert("注册成功!")</script>';
            }else{
                    echo '<script>alert("该用户已存在!")</script>';
                }
        }
    }
    session_destroy();
?>
<html>   
<head>   
<meta http-equiv="refresh" content="0;  
url=<?php echo $url; ?>">   
</head>   
<body>
</body> 
</html>  