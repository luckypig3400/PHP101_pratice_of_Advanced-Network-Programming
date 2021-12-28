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
	$qa_no=(isset ($_POST['qa_no'])) ? $_POST['qa_no'] : "";
	$f41=(isset ($_POST['f41'])) ? $_POST['f41'] : "";
	$f42=(isset ($_POST['f42'])) ? $_POST['f42'] : "";
	$f43=(isset ($_POST['f43'])) ? $_POST['f43'] : "";
	$f44=(isset ($_POST['f44'])) ? $_POST['f44'] : "";
	$f45=(isset ($_POST['f45'])) ? $_POST['f45'] : "";
	$f46=(isset ($_POST['f46'])) ? $_POST['f46'] : "";
	$f47=(isset ($_POST['f47'])) ? $_POST['f47'] : "";
	$f48=(isset ($_POST['f48'])) ? $_POST['f48'] : "";
	$f49=(isset ($_POST['f49'])) ? $_POST['f49'] : "";
	$f4A=(isset ($_POST['f4A'])) ? $_POST['f4A'] : "";
	$f4B=(isset ($_POST['f4B'])) ? $_POST['f4B'] : "";
	$f4C=(isset ($_POST['f4C'])) ? $_POST['f4C'] : "";
	$f4D=(isset ($_POST['f4D'])) ? $_POST['f4D'] : "";
	$f4E=(isset ($_POST['f4E'])) ? $_POST['f4E'] : "";
	$f4F=(isset ($_POST['f4F'])) ? $_POST['f4F'] : "";
	$f4F1=(isset ($_POST['f4F1'])) ? $_POST['f4F1'] : "";
	$f4G=(isset ($_POST['f4G'])) ? $_POST['f4G'] : "";
	$f4G1=(isset ($_POST['f4G1'])) ? $_POST['f4G1'] : "";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0;   
	$seq="";            
//--------------------------------------
//processing
//--------------------------------------	
	$sql =" select count(*) from qa_effect";
	$sql.=" where qa_no='$qa_no'";	
	
	if(TestDuplicate($conn,$sql))
	{	
		//--------------------------------------
		$sql =" update qa_effect set";
		$sql.=" f41='$f41',";
		$sql.=" f42='$f42',";
		$sql.=" f43='$f43',";
		$sql.=" f44='$f44',";
		$sql.=" f45='$f45',";
		$sql.=" f46='$f46',";
		$sql.=" f47='$f47',";
		$sql.=" f48='$f48',";
		$sql.=" f49='$f49',";
		$sql.=" f4A='$f4A',";
		$sql.=" f4B='$f4B',";
		$sql.=" f4C='$f4C',";
		$sql.=" f4D='$f4D',";
		$sql.=" f4E='$f4E',";
		$sql.=" f4F='$f4F',";
		$sql.=" f4F1='$f4F1'";
		if ($f4G!=""&&$f4G1!="")
		{
			$sql.=" ,f4G='$f4G'";
			$sql.=" ,`f4G1`='$f4G1'";
		}
		$sql.=" where qa_no='$qa_no'";

		$sql_array[$cmd_count]=$sql;
		$cmd_count++;
		//-------------------------------
		//execute the Transaction
		//-------------------------------
		$result=DoTransaction($conn,$cmd_count,$sql_array);
		if ($result)
		{
			$msg="<font color='blue'>"."本回問卷已全部結束，再次謝謝您寶貴的意見！"."</font>";

			$idx=1;
		}
		else
		{
			$msg="<font color='blue'>"."更新失敗"."</font>";
			$idx=0;
		}
		//--------------------------------------
	}
	else
	{		
		$msg="<font color='blue'>"."此問卷不存在"."</font>";
		$idx=0;
	}
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
<script language=javascript>
</script>
<!-----javascript code E----->
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('btn/btn01_over.gif','btn/btn02_over.gif','btn/btn03_over.gif','btn/btn04_over.gif','btn/btn05_over.gif','btn/btn06_over.gif')">
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
                      <td><img src="btn/peo-b01.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><A href="qa_effect_start.php"><img border="0" src="btn/peo-b02.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-b03.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-b04.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><A href="qa2_list.php"><img border="0" src="btn/peo-b05.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><a href="people03.htm"><img src="btn/people03.gif" width="181" height="30" border="0"></a></td>
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
                  <table width="596" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><b><font color="#CC6600">學童走路上下學影響因素</font></b></td>
                    </tr>
                    <tr> 
                      <td><img src="images/_spacer.gif" width="25" height="5"></td>
                    </tr>
                  </table>
                  <table width="596" border="0" cellspacing="0" cellpadding="0" align="center" background="images/form-back.gif">
                    <tr> 
                      <td height="125" valign="top" background="images/form-bottom.gif" class="set-bgbottom"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td background="images/form-top.gif" height="53" class="set-bgtop" valign="middle" align="center">
                              <div align="center">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td><img src="images/_spacer.gif" width="25" height="8"></td>
                                  </tr>
                                </table>
                              </div>
                              <!-- 問卷大綱 s-->
                              <font color='white'>問卷完成</font>
                              <!-- 問卷大綱 e-->
                            </td>
                          </tr>
                          <tr> 
                            <td height="30">
                              <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign="top" align="center">
                                          <BR>					  
<?php if ($idx==1) { ?>
					  <!--學童走路上下學影響因素 start(idx==1) -->					  
					  <BR>
					  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">                                              
			                    <tr height="150">
			                      <td class="tdHeads" width="150">系統訊息：</td>
			                      <td class="tdHeads2">  
			                       <center><?php echo $msg; ?></center>
			                      </td>
			                    </tr>                     			                    
			                  </table>  
			                  <!--學童走路上下學影響因素 (idx==1) end-->
<?php } else { ?>
			                  <!--系統訊息-->
			                  <!--學童走路上下學影響因素 start(idx==0) -->					  
					  <BR>
					  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">                                              
			                    <tr height="150">
			                      <td class="tdHeads" width="150">系統訊息：</td>
			                      <td class="tdHeads2">  
			                       <center><?php echo $msg; ?></center>
			                      </td>
			                    </tr>                     			                    
			                  </table>  
			                  <!--學童走路上下學影響因素 (idx==0) end-->
<?php } ?>    
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr> 
                            <td height="60">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
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
