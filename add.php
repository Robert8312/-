<?php
require("config.php");
session_start();
if (!isset($_SESSION["userAccount"])) {
    //當沒有userAccount 的時候，網址後方加上? 
    // header("Location:login.php");
    header("Location:login.php?backTo=add");
    exit();
}
//顯示產品清單
$show = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$show->exec("set names utf8");
$select = "select pl_id,pl_name,pl_price from product_list";
$show = $show->query($select);
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
    <form action="add_item.php" method="post">
        <table border="2" width="50%">
            <tr>
                <td></td>
                <td>品名</td>
                <td>價錢</td>
                <td>數量</td>
            </tr>
            <?php
            $i = 1;
            while ($result = $show->fetch()) { ?>
                <tr>
                <td><input type="checkbox" name="product[]" value="<?= $result["pl_id"] ?>"></td>
                    <td><?= $result["pl_name"] ?></td>
                    <td><?= $result["pl_price"] ?></td>
                    <td><input type="text" name="item[]" value="0"></td>
                </tr>
                <?php
                $i += 1;
            } ?>
        </table>
        <input type="submit" value="確認下訂">
    </form>
</body>

</html>