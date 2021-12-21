<?php
/*
	顯示以下輸入的內容，並且：
		1. 有兩行以上時需換行
		2. 禁止HTML語法
*/
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Disable HTML syntax</title>
</head>
<body>

<?php
	$comment = (isset($_POST["comment"]))?$_POST["comment"]:"";

	echo $comment;
?>

</body>
</html>
