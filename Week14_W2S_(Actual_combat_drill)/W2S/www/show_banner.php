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
	$type=(isset ($_GET['type'])) ? $_GET['type'] : "1";
	$current_date=date("Y-m-d");
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
	$sql =" select a.title,a.pic_no,b.title,b.path,a.pic_url";
	$sql.=" from banner_info a, pic_info b";
	$sql.=" where a.pic_no=b.pic_no";		
	$sql.=" and a.type='$type'";
	$sql.=" and a.start_date<='$current_date'";
	$sql.=" and a.expire_date>='$current_date'";
	$sql.=" order by rand() limit 1";

	$result = $conn->query($sql);
	$data_arr=$result->fetch();	
	if ($data_arr)
	{
		$idx=1;
	}
	else
	{
		$idx=0;
	}
	//--------------------------------------					
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
<script language="javascript">
function form_action()
{
	var pic_info = new Array(2);
		
<?php if ($idx==1) { ?>
	pic_info[0] = "<?php echo $data_arr[4]?>";
	pic_info[1] = "<?php echo $data_arr[3]?>";
<?php } else { ?>
	pic_info[0] = "http://walktoschool.ty.ntsu.edu.tw/";
	pic_info[1] = "banner01.jpg";
<?php } ?>
	
	returnValue = pic_info;
  	window.close();		
}
</script>
<!-----javascript code E----->
<body class="body_main" onload=form_action()>
</body>
</html>