<?php
require("config.php");
session_start();
$note = "";
//判斷logout按下後，從網址看有沒有"signout"這字串，有的話，清空$_SESSION["userName"]
//並回到主畫面
if (isset($_GET["signout"])) {
    unset($_SESSION["userName"]);
    unset($_SESSION["userAccount"]);
    unset($_SESSION["userPwd"]);
    header("Location:index.php");
    exit();
}

//回首頁
if (isset($_POST["btnHome"])) {
    header("Location:index.php");
}

//當按鈕btnOK按下的時候
if (isset($_POST["btnOK"])) {
    if ($_POST["txtUserAccount"] != "") {
        //取得使用者輸入的帳號
        $_SESSION["userAccount"] = $_POST["txtUserAccount"];
        //取得使用者輸入的密碼
        $_SESSION["userPwd"] = $_POST["txtPassword"];
        //確認抓到使用者帳號密碼
        // echo "session是".$_SESSION["userAccount"];
        // echo "密碼是".$_SESSION["userPwd"];
        // exit();
        $user = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $user->exec("set names utf8");
        //設定$select要執行的SQL語法
        //按照使用者輸入的帳號找出對應的帳號和密碼
        $select = "select ud_id,ud_name,ud_account,ud_pwd from user_data where ud_account='$_SESSION[userAccount]'";
        // echo $select;
        // exit();
        //執行語法
        $user = $user->query($select);
        $result = $user->fetch();
        //用seesion傳遞使用者姓名
        $_SESSION["userName"] = $result["ud_name"];
        $_SESSION["id"]= $result["ud_id"];
        // echo $_SESSION["id"];
        // exit();
        //用seesion傳遞帳號密碼
        // echo "帳號是".$result["ud_account"]."<br>";
        // echo "密碼是".$result["ud_pwd"]."<br>";
        // echo "使用者是".$result["ud_name"]."<br>";
        // exit();
        // 判斷密碼是否正確
        //如果正確
        if ($_SESSION["userPwd"] == $result["ud_pwd"]) {
            //判斷網址如果裡面backTO=的質來判斷上一個網頁，
            if (isset($_GET["backTo"])) {
                switch ($_GET["backTo"]) {
                    case "show":
                        header("Location:show_item.php");
                        break;
                    case "secret":
                        header("Location:secret.php");
                        break;
                    case "add":
                        header("Location:add.php");
                        break;
                    // 沒有就回index.php
                    default:
                        header("Location:index.php");
                        break;
                }
            }
        }
        //如果失敗
        else {
            $note = "密碼錯誤";
        }
    }
    //如果沒有輸入帳號
    else {
        $note = "請輸入帳號名";
    }
}
