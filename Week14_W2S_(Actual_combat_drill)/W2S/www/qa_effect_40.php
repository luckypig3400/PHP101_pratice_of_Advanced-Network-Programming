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
	$f31=(isset ($_POST['f31'])) ? $_POST['f31'] : "";
	$f32=(isset ($_POST['f32'])) ? $_POST['f32'] : "";
	$f33=(isset ($_POST['f33'])) ? $_POST['f33'] : "";
	$f34=(isset ($_POST['f34'])) ? $_POST['f34'] : "";
	$f35=(isset ($_POST['f35'])) ? $_POST['f35'] : "";
	$f36=(isset ($_POST['f36'])) ? $_POST['f36'] : "";
	$f37=(isset ($_POST['f37'])) ? $_POST['f37'] : "";
	$f38=(isset ($_POST['f38'])) ? $_POST['f38'] : "";
	$f38_1=(isset ($_POST['f38-1'])) ? $_POST['f38-1'] : "";
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
		$sql.=" f31='$f31',";
		$sql.=" f32='$f32',";
		$sql.=" f33='$f33',";
		$sql.=" f34='$f34',";
		$sql.=" f35='$f35',";
		$sql.=" f36='$f36',";
		$sql.=" f37='$f37',";
		$sql.=" f38='$f38'";
		if ($f38!=""&&$f38_1!="")
		{
			$sql.=" ,f38='$f38'";
			$sql.=" ,`f38-1`='$f38_1'";
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
	document.AP_CT.action="qa_effect_finish.php";
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
                      <td><b><font color="#CC6600">阻力因素</font></b></td>
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
                              <font color='white'>您認為下因素影響學童走路上下學的情形為何？</font>
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
			                      <td class="tdHeads" width="250">天氣狀況：</td>
			                      <td class="tdHeads2">
			                        <select name="f41">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">交通安全的顧慮：</td>
			                      <td class="tdHeads2">
			                        <select name="f42">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">擔心人身安全：</td>
			                      <td class="tdHeads2">
			                        <select name="f43">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">缺乏同伴：</td>
			                      <td class="tdHeads2">
			                        <select name="f44">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">上學時間來不及：</td>
			                      <td class="tdHeads2">
			                        <select name="f45">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">要帶去學校的東西：</td>
			                      <td class="tdHeads2">
			                        <select name="f46">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">孩子意願：</td>
			                      <td class="tdHeads2">
			                        <select name="f47">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">父母的意願：</td>
			                      <td class="tdHeads2">
			                        <select name="f48">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">上下學路線的步道設施：</td>
			                      <td class="tdHeads2">
			                        <select name="f49">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">上下學路線的環境：</td>
			                      <td class="tdHeads2">
			                        <select name="f4A">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">居住社區人口稠密：</td>
			                      <td class="tdHeads2">
			                        <select name="f4B">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">學校鼓勵走路上下學：</td>
			                      <td class="tdHeads2">
			                        <select name="f4C">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">學校附近有公共交通運輸：</td>
			                      <td class="tdHeads2">
			                        <select name="f4D">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">鄰居間互動少：</td>
			                      <td class="tdHeads2">
			                        <select name="f4E">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">距離學校太遠：</td>
			                      <td class="tdHeads2">
			                        <select name="f4F">
							<option value="1">非常不同意</option>
							<option value="2">不同意</option>
							<option value="3">沒意見</option>
							<option value="4">同意</option>
							<option value="5">非常同意</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">住家與學校的距離：</td>
			                      <td class="tdHeads2">
			                        <input type="input" name="f4F1" size="3" class="inputs" maxlength="5" onblur="check_num(this)">公里
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">其他：
			                        <input type="input" name="f4G1" size="20" class="inputs" maxlength="50">
			                      </td>
			                      <td class="tdHeads2">
			                        <select name="f4G">
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
