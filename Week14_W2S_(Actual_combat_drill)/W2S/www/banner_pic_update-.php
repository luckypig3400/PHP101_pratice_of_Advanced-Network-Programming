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
	$game_no=(isset ($_POST['game_no'])) ? $_POST['game_no'] : "";	
	$show_no_list=(isset ($_POST['show_no_list'])) ? $_POST['show_no_list'] : "";	
	$slide_no=(isset ($_POST['slide_no'])) ? $_POST['slide_no'] : "";			
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0;               
//--------------------------------------
//processing
//--------------------------------------	
	//--------------------------------------		
	$show_no_list="(".str_replace(":", ",", $show_no_list).")";	

	$sql =" delete from game_show";
	$sql.=" where game_no='$game_no'";
	$sql.=" and show_no in $show_no_list";
	
	$sql_array[$cmd_count]=$sql;
	$cmd_count++;	
	//-------------------------------		
	$sql =" delete from game_role";
	$sql.=" where show_no in $show_no_list";

	$sql_array[$cmd_count]=$sql;
	$cmd_count++;		
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result=DoTransaction($conn,$cmd_count,$sql_array);
	if ($result)
	{
		//--------------------------------------
		$sql =" select count(*)";
		$sql.=" from game_show";
		$sql.=" where game_no='$game_no'";
		$sql.=" and slide_no='$slide_no'";		

		$result = $conn->query($sql);
		$row_count= $result->rowCount();
		$data_arr=$result->fetch();
		//--------------------------------------
		$idx=1;
	}
	else
	{		
		$idx=0;
	}			
//--------------------------------------
//disconnect database
//--------------------------------------	
        DisconnectMysql($l_type,$conn);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<!-----javascript code S----->
<script language="javascript" src="cbf_function.js"></script>
<script language="javascript">
<?php
if ($idx==1)
{
?>
	var pic_info = new Array(1);
		
	pic_info[0] = "<?php echo $data_arr[0] ?>";
	
	alert("刪除精采畫面-成功");
	returnValue = pic_info;
  	window.close();	
<?php
}
else
{
?>
	alert("刪除精采畫面-失敗");
  	window.close();
<?php
}
?>
</script>
<!-----javascript code E----->
</html>