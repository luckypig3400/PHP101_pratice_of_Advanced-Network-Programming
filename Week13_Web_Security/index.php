<?php
/*
	題目說明：
	  請修改01.php與02.php，然後完成老師指定之工作。

	注意事項：
	  1. 02.php需先將MySQL資料匯入資料庫中。
*/
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SQL injection</title>
</head>
<body>
顯示以下輸入的內容，並且：<br />
 1. 有兩行以上時需換行<br />
 2. 禁止HTML語法<br />
	<form action="01.php" method="post">
		<textarea name="comment"></textarea>
		<input type="submit" value="顯示" />
	</form><br /><br /><br />

解決SQL漏洞：<br />
	<form action="02.php" method="post">
		帳號 ：<input type="text" name="username" /><br />
		密碼 ：<input type="password" name="password" /><br />
		<input type="submit" value="登入" />
	</form>
</body>
</html>
