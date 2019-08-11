<?php
require("config.php");
session_start();
//取得要新增的品項和數量
$product = $_POST["product"];
$num = $_POST["item"];
//算陣列裡面有幾個內容，用來算總共勾了幾個選項
// $count = count($product);
//組合品項根數量
//完整inster 語法INSERT INTO `order_detail` (`od_id`, `ol_id`, `pl_id`, `od_num`) VALUES (NULL, '', '10', '') 
$insert_od = "insert into order_detail (`od_id`, `ol_id`, `pl_id`, `od_num`)VALUES ";
$val_od = "";
for ($i=0;$i<4;$i++)
{
    $val_od .= "(null,3,".($i+1).",".$num[$i]."),"; 
}
//去掉$VAL最後一個字，也就是 "，"
$val_od = substr_replace($val_od,'',-1);
$insert_od = $insert_od .$val_od;
$insert_ol = "insert into order_list (`ol_id`, `ud_id`, `ol_price`)VALUES";
$val_ol="(3,$_SESSION[id],0)";
$insert_ol = $insert_ol.$val_ol;
//組合2句語法，同時寫入detail和list
$insert_all = $insert_od.";".$insert_ol;
echo $insert_all;
//連接資料庫 
$insert = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$insert->exec("set names utf8");
// 新增到資料表
$insert = $insert->query($insert_all);
header("Location:show_item.php");




?>
