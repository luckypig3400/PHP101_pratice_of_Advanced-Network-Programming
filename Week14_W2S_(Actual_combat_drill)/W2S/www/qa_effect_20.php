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
	$f11=(isset ($_POST['f11'])) ? $_POST['f11'] : "";
	$f12=(isset ($_POST['f12'])) ? $_POST['f12'] : "";
	$f13=(isset ($_POST['f13'])) ? $_POST['f13'] : "";
	$f14=(isset ($_POST['f14'])) ? $_POST['f14'] : "";
	$f144=(isset ($_POST['f144'])) ? $_POST['f144'] : "";
	$f151=(isset ($_POST['f151'])) ? $_POST['f151'] : "";
	$f152=(isset ($_POST['f152'])) ? $_POST['f152'] : "";
	$f153=(isset ($_POST['f153'])) ? $_POST['f153'] : "";
	$f16=(isset ($_POST['f16'])) ? $_POST['f16'] : "";
	$f17=(isset ($_POST['f17'])) ? $_POST['f17'] : "";
	$f18=(isset ($_POST['f18'])) ? $_POST['f18'] : "";
	$f186=(isset ($_POST['f186'])) ? $_POST['f186'] : "";
	$f19=(isset ($_POST['f19'])) ? $_POST['f19'] : "";
	$f1A=(isset ($_POST['f1A'])) ? $_POST['f1A'] : "";
	$f1A6=(isset ($_POST['f1A6'])) ? $_POST['f1A6'] : "";
	$f1B=(isset ($_POST['f1B'])) ? $_POST['f1B'] : "";
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
		$sql.=" f11='$f11',";
		$sql.=" f12='$f12',";
		$sql.=" f13='$f13',";
		$sql.=" f14='$f14',";
		$sql.=" f144='$f144',";
		$sql.=" f151='$f151',";
		$sql.=" f152='$f152',";
		$sql.=" f153='$f153',";
		$sql.=" f16='$f16',";
		$sql.=" f17='$f17',";
		$sql.=" f18='$f18',";
		if ($f18=="6")
		{
			$sql.=" f186='$f186',";
		}
		if ($f18=="1")
		{
			$sql.=" f19='$f19',";
		}
		$sql.=" f1A='$f1A'";
		if ($f1A=="6")
		{
			$sql.=" ,f1A6='$f1A6'";
		}
		if ($f1A=="1")
		{
			$sql.=" ,f1B='$f1B'";
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
	document.AP_CT.action="qa_effect_30.php";
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
                              <font color='white'>請問您是否同意走路上下學對學童可以獲得下列的好處？</font>
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
			                      <td class="tdHeads" width="250">增加身體活動量：</td>
			                      <td class="tdHeads2">
			                        <select name="f21">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">養成規律的身體活動習慣：</td>
			                      <td class="tdHeads2">
			                        <select name="f22">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">提升體能：</td>
			                      <td class="tdHeads2">
			                        <select name="f23">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">培養學童獨立自主的能力：</td>
			                      <td class="tdHeads2">
			                        <select name="f24">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">有益身體健康：</td>
			                      <td class="tdHeads2">
			                        <select name="f25">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">改善體格：</td>
			                      <td class="tdHeads2">
			                        <select name="f26">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">增加身體協調能力：</td>
			                      <td class="tdHeads2">
			                        <select name="f27">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">增進人際關係：</td>
			                      <td class="tdHeads2">
			                        <select name="f28">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">促進親子互動：</td>
			                      <td class="tdHeads2">
			                        <select name="f29">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">提升交通安全知識與行為的整合：</td>
			                      <td class="tdHeads2">
			                        <select name="f2A">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">增加自信心：</td>
			                      <td class="tdHeads2">
			                        <select name="f2B">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">降低對汽機車的依賴：</td>
			                      <td class="tdHeads2">
			                        <select name="f2C">
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
			                        <input type="input" name="f2D1" size="20" class="inputs" maxlength="50">
			                      </td>
			                      <td class="tdHeads2">
			                        <select name="f2D">
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
