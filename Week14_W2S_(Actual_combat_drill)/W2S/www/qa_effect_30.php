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
	$f21=(isset ($_POST['f21'])) ? $_POST['f21'] : "";
	$f22=(isset ($_POST['f22'])) ? $_POST['f22'] : "";
	$f23=(isset ($_POST['f23'])) ? $_POST['f23'] : "";
	$f24=(isset ($_POST['f24'])) ? $_POST['f24'] : "";
	$f25=(isset ($_POST['f25'])) ? $_POST['f25'] : "";
	$f26=(isset ($_POST['f26'])) ? $_POST['f26'] : "";
	$f27=(isset ($_POST['f27'])) ? $_POST['f27'] : "";
	$f28=(isset ($_POST['f28'])) ? $_POST['f28'] : "";
	$f29=(isset ($_POST['f29'])) ? $_POST['f29'] : "";
	$f2A=(isset ($_POST['f2A'])) ? $_POST['f2A'] : "";
	$f2B=(isset ($_POST['f2B'])) ? $_POST['f2B'] : "";
	$f2C=(isset ($_POST['f2C'])) ? $_POST['f2C'] : "";
	$f2D=(isset ($_POST['f2D'])) ? $_POST['f2D'] : "";
	$f2D1=(isset ($_POST['f2D1'])) ? $_POST['f2D1'] : "";
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
		$sql.=" f21='$f21',";
		$sql.=" f22='$f22',";
		$sql.=" f23='$f23',";
		$sql.=" f24='$f24',";
		$sql.=" f25='$f25',";
		$sql.=" f26='$f26',";
		$sql.=" f27='$f27',";
		$sql.=" f28='$f28',";
		$sql.=" f29='$f29',";
		$sql.=" f2A='$f2A',";
		$sql.=" f2B='$f2B',";
		$sql.=" f2C='$f2C'";
		if ($f2D!=""&&$f2D1!="")
		{
			$sql.=" ,f2D='$f2D'";
			$sql.=" ,f2D1='$f2D1'";
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
function form_action()
{
	document.AP_CT.action="qa_effect_40.php";
	document.AP_CT.submit();
}
</script>
<!-----javascript code E----->
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('btn/btn01_over.gif','btn/btn02_over.gif','btn/btn03_over.gif','btn/btn04_over.gif','btn/btn05_over.gif','btn/btn06_over.gif')">
<form name="AP_CT" action="" method="post" onsubmit="return form_action()">
<input name="qa_no" type="hidden" value="<?php echo $qa_no ?>">
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
                      <td><b><font color="#CC6600">助力因素</font></b></td>
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
                              <font color='white'>請問您是否同意走路上下學對社區可以獲得下列的好處？</font>
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
					  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">                                              
					    <tr>
			                      <td class="tdHeads" width="250">減少車流量：</td>
			                      <td class="tdHeads2">
			                        <select name="f31">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">減低車速：</td>
			                      <td class="tdHeads2">
			                        <select name="f32">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">改善空氣品質：</td>
			                      <td class="tdHeads2">
			                        <select name="f33">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">增加社區互動：</td>
			                      <td class="tdHeads2">
			                        <select name="f34">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">改善治安，減少犯罪：</td>
			                      <td class="tdHeads2">
			                        <select name="f35">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">改善社區居民交通安全行為：</td>
			                      <td class="tdHeads2">
			                        <select name="f36">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">具有教育意義：</td>
			                      <td class="tdHeads2">
			                        <select name="f37">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">其他：
			                        <input type="input" name="f38-1" size="20" class="inputs" maxlength="50">
			                      </td>
			                      <td class="tdHeads2">
			                        <select name="f38">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
			                  </table> 
			                  <!-- 功能鍵-->
			                  <table width="550" border="0" cellspacing="0" cellpadding="0" class="font-12" >
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      	<input class="btns" type="submit" value="下一頁">
			                        <input class="btns" type="reset" value="重新輸入">			                        
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
