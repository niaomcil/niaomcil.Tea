<?php
    session_start();
    require_once "connect.php";
    $url = "login.html"; 
    if(isset($_POST['sub'])) {
     $stmt = $dbh->prepare("select id, username from user where username=? and password=?");
     $stmt ->execute(array($_POST["username"], md5($_POST["password"])));
     if($stmt->rowCount() > 0) {
         $_SESSION = $stmt -> fetch(PDO::FETCH_ASSOC);
         $_SESSION["username"]=$_POST["username"];
         $_SESSION["isLogin"] = 1;
         header("Location:index.php");
     } else{
         echo '<script>alert("用户名或密码错误!")</script>';
     }
 }
?>
<html>   
<head>   
<meta http-equiv="refresh" content="0;  
url=<?php echo $url; ?>">   
</head>   
<body>
</body> 
</html>  