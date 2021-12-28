<?php
//--------------------------------------
//include extern utility
//--------------------------------------	
	include("walk_function.inc");		
//--------------------------------------
//system variables declaration 
//--------------------------------------
//SET $l_type=TRUE	: Need to Connect DB
//SET $l_type=FALSE	: Do Not to Connect DB
//--------------------------------------
	$l_type=TRUE;	
//--------------------------------------
//connect database
//--------------------------------------
        $conn=ConnectMysql($l_type);
        
        if ($l_type && ! $conn)
        {
                exit();
        }       
//--------------------------------------
//initial CGI variables
//--------------------------------------	   
	$ck_user_no=(isset ($_COOKIE['ck_user_no'])) ? $_COOKIE['ck_user_no'] : "";
	$ck_group=(isset ($_COOKIE['ck_group'])) ? $_COOKIE['ck_group'] : "";
	$seed_no=(isset ($_POST['seed_no'])) ? $_POST['seed_no'] : "";
	$pic_no=(isset ($_POST['pic_no'])) ? $_POST['pic_no'] : "";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$sql_array1=array();
	$cmd_count=0;
	$cmd_count1=0;
//--------------------------------------
//processing
//--------------------------------------	
	$sql =" select path from pic_info";
	$sql.=" where 1<0";
	for ($i=0;$i<count($pic_no);$i++)
	{
		$sql.=" or pic_no='$pic_no[$i]'";
	}

	$result = $conn->query($sql);
	$data_arr=$result->fetch();
	$row_count= $result->rowCount();	

	for($i=0;$i<$row_count;$i++)
	{
		unlink("seed/".$data_arr[$i]);
	}
	//--------------------------------------
	$sql =" delete from pic_info";
	$sql.=" where 1<0";
	for ($i=0;$i<count($pic_no);$i++)
	{
		$sql.=" or pic_no='$pic_no[$i]'";
	}

	$sql_array[$cmd_count]=$sql;
	$cmd_count++;				
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result=DoTransaction($conn,$cmd_count,$sql_array);
	if ($result)
	{
		//$msg.="\n<br><font color='blue'>"."刪除相簿圖片(pic_info)-OK"."</font>";			
		$idx=1;
	}
	else
	{		
		//$msg.="\n<br><font color='red'>"."刪除相簿圖片(pic_info)-ERROR"."</font>";			
		$idx=2;
	}				
	//--------------------------------------
	$sql =" delete from seed_pic";
	$sql.=" where 1<0";
	for ($i=0;$i<count($pic_no);$i++)
	{
		$sql.=" or pic_no='$pic_no[$i]'";
	}
			
	$sql_array[$cmd_count]=$sql;
	$cmd_count++;				
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result=DoTransaction($conn,$cmd_count,$sql_array);
	if ($result)
	{
		//$msg.="\n<br><font color='blue'>"."刪除相簿圖片(seed_pic)-OK"."</font>";			
	}
	else
	{		
		$msg.="\n<br><font color='red'>"."刪除相簿圖片(seed_pic)-ERROR"."</font>";			
		$idx=3;
	}				
//--------------------------------------
//disconnect database
//--------------------------------------	
        DisconnectMysql($l_type,$conn);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<meta http-equiv="refresh" content="0;URL=seed_album_list.php?seed_no=<?php echo $seed_no ?>">--->
<title>活動管理-更新上傳圖片</title>
</head>

<body>
<form name="AP_CT" action="seed_album_list.php" method="GET" target="pic_body">
<input name="seed_no" type="hidden" value="<?php echo $seed_no ?>">
</form>
</body>

<!-----javascript code S----->
<script language="javascript" src="cbf_function.js"></script>
<script language="javascript">
<?php
if ($idx==1)
{
?>
	alert("刪除圖片-成功");
<?php
}
else
{
?>
	alert("刪除圖片-失敗");
<?php
}
?>

	document.AP_CT.submit();
</script>
<!-----javascript code E----->
</html>