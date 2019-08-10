<?php
require("config.php");
session_start();
if(!isset($_SESSION["userAccount"]))
{
//當沒有userAccount 的時候，網址後方加上? 
  // header("Location:login.php");
  header("Location:login.php?backTo=show");
  exit();
}
// echo $user;
// exit();
// echo ($_SESSION['userAccount']);
// exit();
$show = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$show->exec("set names utf8");
//設定$select要執行的SQL語法
//找出我們要的產品
// SELECT ud.ud_name as '購買人' ,
// 		pl.pl_name as '產品名稱',
//         od.od_num as '購買數量'
// FROM order_detail as od 
// LEFT JOIN order_list as ol ON od.ol_id = ol.ol_id
// LEFT JOIN user_data as ud on ol.ud_id = ud.ud_id
// LEFT JOIN product_list as pl on od.pl_id = pl.pl_id
// WHERE ol.ud_id = 2
$select = " SELECT ud.ud_name ,
pl.pl_name  ,
od.od_num 
FROM order_detail as od 
LEFT JOIN order_list as ol ON od.ol_id = ol.ol_id
LEFT JOIN user_data as ud on ol.ud_id = ud.ud_id
LEFT JOIN product_list as pl on od.pl_id = pl.pl_id 
where ud.ud_account = '$_SESSION[userAccount]'";
// echo $select;
// exit();
//執行語法
$show = $show->query($select);
// $result = $show->fetch();
// print_r($result) ;

while($result = $show->fetch()){

echo "購買人: " .$result["ud_name"]."<br>";
echo "購買產品: " .$result["pl_name"]."<br>";
echo "購買數量: " .$result["od_num"]."<br>";
echo "<hr>";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="index.php">回到首頁</a>
</body>
</html>
