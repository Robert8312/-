<?php
//引入user_login.php處理有關登入的事情
require("user_login.php");
?>


<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Lab - Login</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 登入</font>
        </td>
      </tr>
      <tr>
        <td width="80" align="center" valign="baseline">帳號</td>
        <!-- 帳號輸入的欄位name=txtUserAccount -->
        <td valign="baseline"><input type="text" name="txtUserAccount" id="txtUserAccount" /></td>
      </tr>
      <tr>

        <td width="80" align="center" valign="baseline">密碼</td>
        <!-- 密碼輸入的欄位name=txtPassword -->
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      <tr>
        <p><?= $note?></p>
      </tr>
      <tr>
        <!-- 登入的按鈕name="btnOK" -->
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
          <!-- 重新設定按鈕 -->
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <!-- 回首頁按鈕 -->
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
        </td>
      </tr>
    </table>
  </form>
</body>

</html>