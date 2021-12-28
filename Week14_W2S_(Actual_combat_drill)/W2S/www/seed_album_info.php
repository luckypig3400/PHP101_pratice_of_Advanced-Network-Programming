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
	$pic_no=(isset ($_GET['pic_no'])) ? $_GET['pic_no'] : "";
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
	$sql =" select a.path,a.title";
	$sql.=" from pic_info a";
	$sql.=" where a.pic_no='$pic_no'";

	$result = $conn->query($sql);
	$data_arr=$result->fetch();	

	$idx=1;			
//--------------------------------------
//disconnect database
//--------------------------------------	
        DisconnectMysql($l_type,$conn);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<!-----CSS include S----->
<link href="table.css" rel="stylesheet" type="text/css" />
<link href="_set.css" rel="stylesheet" type="text/css" />
<!-----CSS include E----->
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<!-----javascript code E----->
<body class="body_main">
<center><br>
<?php if ($idx==1) { ?>                            
<!-- work sheet start-->                      
	<img border="1" width="352" height="240" src="seed/<?php echo $data_arr[0] ?>"><br><br><?php echo $data_arr[1] ?>
<!-- work sheet end-->
<?php } else { ?>
<!-- ERROR MSG S-->
<!-- ERROR MSG E-->
<?php } ?>                         

<br><br><input class="btns" type="button" value="關閉" onClick="window.close();">
</center>

</body>
</html>
