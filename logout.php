<?php
    session_start();
    $username=$_SESSION["username"];
    $url = "index.php"; 
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-4200,'/');
    }
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="1;url=<?php echo $url; ?>">   
    <title>退出</title>
</head>
<body>
</body>
</html>
