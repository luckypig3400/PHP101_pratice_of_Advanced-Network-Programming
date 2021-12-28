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
	$area_code=(isset ($_POST['area_code'])) ? $_POST['area_code'] : "0";
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
	$sql =" select a.school_no,b.name,c.name";
	$sql.=" from seed_info a, school_area b, school_info c";
	$sql.=" where a.school_no=c.school_no";
	$sql.=" and b.area_code=c.area_code";
  	if ($area_code!="0")
	{
		$sql.=" and c.area_code='$area_code'"; 
	}
	$sql.=" group by a.school_no";
	$sql.=" order by b.name,c.name";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();	
	//--------------------------------------
	$sql =" select a.area_code,a.name";
	$sql.=" from school_area a";
	$sql.=" order by a.area_code,a.name";

	$result1 = $conn->query($sql);
	$row_count1= $result1->rowCount();	
	//--------------------------------------

	$idx=1;
//--------------------------------------
//disconnect database
//--------------------------------------	
        DisconnectMysql($l_type,$conn);	
?>
<html>
<head>
<title>走路上學計劃</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-----CSS include S----->
<link href="table.css" rel="stylesheet" type="text/css" />
<link href="_set.css" rel="stylesheet" type="text/css" />
<!-----CSS include E----->
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<script language="javascript">
function change_area_code()
{
	document.AP_CT.submit();
}
</script>
<!-----javascript code E----->
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('btn/btn01_over.gif','btn/btn02_over.gif','btn/btn03_over.gif','btn/btn04_over.gif','btn/btn05_over.gif','btn/btn06_over.gif')">
<form name="AP_CT" action="" method="post">
<!-- header start -->
<script language="javascript" src="walk_header.js"></script>
<!-- header end -->
<table width="860" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top"> 
    <td width="276"> 
      <table width="32%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="4%" valign="top"><img src="images/block01-top01.gif" width="65" height="89"></td>
          <td width="48%" valign="top"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/block01-back.gif">
              <tr>
                <td><img src="images/block01-top02.gif" width="183" height="89"></td>
              </tr>
              <tr>
                <td>
                  <table width="181" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                      <td><a href="people01.htm"><img src="btn/people01.gif" width="181" height="30" border="0"></a></td>
                    </tr>
                    <tr> 
                      <td><a href="people02.htm"><img src="btn/people02.gif" width="181" height="30" border="0"></a></td>
                    </tr>
                    <tr> 
                      <td><a href="people03.htm"><img src="btn/people03.gif" width="181" height="30" border="0"></a></td>
                    </tr>
                    <tr> 
                      <td><A href="qa_school_start.php"><img border="0" src="btn/peo-c01.gif" width="181" height="24"></a></td>
                    </tr>
                    <tr> 
                      <td><A href="qa_school_start.php"><img border="0" src="btn/peo-c02.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-c03.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-c04.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><A href="qa3_list.php"><img border="0" src="btn/peo-b05.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><A href="apply_new.php"><img border="0" src="btn/peo-c06.gif" width="181" height="24"></a></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td><img src="images/block01-bottom.gif" width="183" height="12"></td>
              </tr>
            </table>
<!-- banner -->
<script language="javascript" src="walk_banner.js"></script>
<!-- banner -->
          </td>
          <td width="48%" valign="top"><img src="images/_spacer.gif" width="30" height="25"></td>
        </tr>
      </table>
    </td>
    <td width="584"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/page-right-back.gif">
        <tr> 
          <td><img src="images/title-people.gif" width="657" height="71"></td>
        </tr>
        <tr> 
          <td valign="top"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td> 
                  <!-- 示範成果展列表 s-->
                  <table width="605" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><b><font color="#CC6600">示範成果展</font></b></td>
                    </tr>
                    <tr> 
                      <td><img src="images/_spacer.gif" width="25" height="5"></td>
                    </tr>
                  </table>
                  <table width="605" border="0" cellspacing="0" cellpadding="0" class="font-12" align="center">
		    <tr>
                      <td height="25" align="right">切換縣市：
                	<select name="area_code" onChange="change_area_code()">				
				<option value="0" <?php echo ($area_code=="0")?"selected":"" ?>>全部縣市</option>
		    <?php
		    for($i=0;$i<$row_count1;$i++)
		    {	
		    	$data_arr1=$result1->fetch();	
		    ?>
				<option value="<?php echo $data_arr1[0] ?>" <?php echo ($area_code=="$data_arr1[0]")?"selected":"" ?>><?php echo $data_arr1[1] ?></option>
		    <?php
		    }
		    ?>
			</select>              
                      </td>
		    </tr>
                    <tr> 
                      <td><img src="images/_line01.gif" width="605" height="7"></td>
                    </tr>                     
		    <?php	
		    for($i=0;$i<$row_count;$i++)
		    {	
		    	$data_arr=$result->fetch();	
		    ?>	
                    <tr> 
                      <td height="25"><img src="images/_point01.gif" width="25" height="13" align="absmiddle">
                       <font color="#5E5E5E">[<?php echo $data_arr[1] ?>]-</font>
                       <font color="#006699"><a href="seeder_alist.php?school_no=<?php echo $data_arr[0] ?>"><?php echo $data_arr[2] ?></a></font></td>
                    </tr>
                    <tr> 
                      <td><img src="images/_line01.gif" width="605" height="7"></td>
                    </tr>                    
		    <?php
		    }
		    ?>	
                  </table>
                  <!-- 示範成果展列表 e-->
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td height="30">&nbsp;</td>
        </tr>
        <tr> 
          <td><img src="images/page-right-bottom.gif" width="657" height="34"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- footer -->
<script language="javascript" src="walk_footer.js"></script>
<!-- footer -->
</body>
</html>
<script language="javascript">
show_banner(1);
show_banner(2);
</script>
