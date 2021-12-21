<?php
/*
	解決SQL漏洞
*/

$hostname = "localhost";	/* MySQL的主機名稱 */
$username = "root";			/* MySQL的使用者名稱 */
$password = "";				/* MySQL的使用者密碼 */
$database = "w13";			/*資料庫名稱*/
?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SQL injection</title>
</head>

<body>

	<?php
	if ((isset($_POST["username"])) && (isset($_POST["password"])))	// 用isset()檢查變數是否有值(非NULL)
	{
		// 接收使用者所傳送之帳號與密碼
		$user = $_POST["username"];
		$pwd  = $_POST["password"];

		// 建立與MySQL資料庫的連線
		$link = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);

		// 用SQL語法呼叫mysql_query()
		$query = "SELECT * FROM `fperson` WHERE `user`='" . $user . "' AND `pwd`='" . $pwd . "'";
		$result = $link->query($query);

		// 找到符合的資料
		$rows = $result->fetchAll();
		$rowCount = count($rows);
		if ($rowCount > 0) {
			echo "Login Success.<br />\n";
			foreach ($rows as $row) {
				// 在此例中，$row中有$row["Time"]與$row["Description"]兩欄位的值。
				echo $row["user"] . "\t" . $row["pwd"] . "<br />\n";
			}
		} else {
			echo "Login Failure.";
		}
	} else {
		echo "Error (Empty)";
	}
	?>

</body>

</html>