<?php
require("config.php");
session_start();
//取得現在訂購的會員
echo $_SESSION["userName"];
//取得要新增的品項和數量
$product = $_POST["product"];
$num = $_POST["item"];
//算陣列裡面有幾個內容，用來算總共勾了幾個選項
// $count = count($product);
//組合品項根數量
//完整inster 語法INSERT INTO `order_detail` (`od_id`, `ol_id`, `pl_id`, `od_num`) VALUES (NULL, '', '10', '') 
$insert_od = "insert into order_detail (`od_id`, `ol_id`, `pl_id`, `od_num`)VALUES ";
$val = "";
for ($i=0;$i<4;$i++)
{
    $val .= "(null,3,".($i+1).",".$num[$i]."),"; 
}
//去掉$VAL最後一個字，也就是 ，
$val = substr_replace($val,'',-1);
$insert_od = $insert_od .$val;
echo $insert_od;
//連接資料庫
$insert = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$insert->exec("set names utf8");


?>
