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
	$l_type=FALSE;	
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
	$l_str="";
	$l_mode="";
	$l_key="";
	$i=0;
	
	while($i<6)
	{
		$l_mode=rand(1, 3);		
		
		if ($l_mode==1)
		{
			$l_str.= chr(rand(50, 57));
			$i++;
		}
		else if ($l_mode==2)
		{
			$j=rand(65, 90);
			if ($j==81||$j==79||$j==76||$j==73||$j==74)
			{
			}
			else
			{
				$l_str.= chr($j);
				$i++;
			}
		}
		else
		{
			$j=rand(97, 122);
			if ($j==111||$j==108||$j==105||$j==106)
			{
			}
			else
			{
				$l_str.= chr($j);
				$i++;
			}
		}						
	}		
			
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
<script language="javascript">
function form_action()
{
	var a=new Array(1);
	
	a[0]="<?php echo $l_str ?>";	
	
 	window.returnValue=a
 	window.close()	
}
</script>
<!-----javascript code E----->
<body class="body_main" onload=form_action()>
</body>
</html>