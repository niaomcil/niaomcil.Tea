<?php
    try{
        $dbh=new PDO('mysql:dbname=TEA;host:localhost','root','');
         $dbh->exec('SET NAMES utf8');
    }catch(PODException $e){
        echo '数据库连接失败：'.$e->getMessage();
        exit;
    }
?>