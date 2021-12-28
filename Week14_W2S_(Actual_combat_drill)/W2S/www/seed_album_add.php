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
	$title=(isset ($_POST['title'])) ? $_POST['title'] : "";
	$seed_no=(isset ($_POST['seed_no'])) ? $_POST['seed_no'] : "";
	
	$join_date=date("Y-m-d H:i:s");
	$pic_no=0;

	if(is_uploaded_file($_FILES['show_upload']['tmp_name']))
	{		
		$show_upload=(isset ($_FILES['show_upload']['name'])) ? $_FILES['show_upload']['name'] : "";
		$pic1=$show_upload;
		$pic1_tmp=(isset ($_FILES['show_upload']['tmp_name'])) ? $_FILES['show_upload']['tmp_name'] : "";					

		$pic1_arr=split("\.",$pic1);
		$pic1_tmp_arr=split('[/\]',$pic1_tmp);
		$pic1_tmp_name=split("\.",$pic1_tmp_arr[(count($pic1_tmp_arr)-1)]);		
		$show_pic= $pic1_tmp_name[0].".".$pic1_arr[1];
		$path = $show_pic;				
	}			
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
	$sql =" insert into pic_info values(";
	$sql.=" $pic_no,";
	$sql.=" '$title',";
	$sql.=" '$path',";
	$sql.=" '$join_date')";	
	
	$sql_array[$cmd_count]=$sql;
	$cmd_count++;				
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result=DoTransaction($conn,$cmd_count,$sql_array);
	if ($result)
	{
		$sql =" select LAST_INSERT_ID()";
		$result = $conn->query($sql);
		$data_arr=$result->fetch();
		$pic_no=$data_arr[0];
		//--------------------------------------
		$sql =" select pic_no,path";
		$sql.=" from pic_info a";
		$sql.=" where pic_no='$pic_no'";
		$result = $conn->query($sql);
		$data_arr=$result->fetch();
		//--------------------------------------
		move_uploaded_file($pic1_tmp, "seed/".$show_pic);
		//--------------------------------------
		$sql =" insert into seed_pic values(";
		$sql.=" '$seed_no',";
		$sql.=" '$pic_no')";
		$sql_array1[$cmd_count1]=$sql;
		$cmd_count1++;				
		//-------------------------------
		//execute the Transaction
		//-------------------------------	
		$result1=DoTransaction($conn,$cmd_count1,$sql_array1);
		if ($result1)
		{
			//$msg="<font color='blue'>"."匯入seed_pic-OK"."</font>";
			$idx=1;
		}
		else
		{
			//$msg="<font color='red'>"."匯入seed_pic-ERROR"."</font>";
			$idx=2;
		}
		//--------------------------------------
	}
	else
	{
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
<title>相簿管理-新增上傳圖片</title>
</head>

<body>
<form name="AP_CT" action="seed_album_list.php" method="GET" target="pic_body">
<input name="seed_no" type="hidden" value="<?php echo $seed_no ?>">
</form>
</body>

<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<script language="javascript">
<?php
if ($idx==1)
{
?>
	alert("新增圖片-成功");
<?php
}
else
{
?>
	alert("新增圖片-失敗");
<?php
}
?>

	document.AP_CT.submit();
</script>
<!-----javascript code E----->

</html>