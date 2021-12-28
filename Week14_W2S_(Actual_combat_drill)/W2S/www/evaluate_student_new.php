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
	$ck_school_no=(isset ($_COOKIE['ck_school_no'])) ? $_COOKIE['ck_school_no'] : "";
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
	if ($ck_user_no=="" || $ck_group!="2" || $ck_school_no=="")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------		
	$sql =" select b.school_no,b.name";
	$sql.=" from user_info a,school_info b";
	$sql.=" where a.user_no='$ck_user_no'";
	$sql.=" and a.school_no=b.school_no";

	$result = $conn->query($sql);
	$data_arr=$result->fetch();
	//--------------------------------------					
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
<!-- calendar S-->
<LINK REL=StyleSheet HREF="calendar_src/calendar.css" TYPE="text/css">
<script language="javascript" src="calendar_src/cbf_calendar.js"></script>
<script language="javascript">buildWeeklyCalendar(1);</script>
<!-- calendar E-->
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<script language=javascript>
function form_action()
{
	answer = confirm("是否確定：新增學生上學方式統計？");
	if (answer)
	{	
		return true;
	}
	else
	{
		return false;	
	}
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="evaluate_student_add.php" method="post" onsubmit="return form_action()">
<!-- header start -->
<script language="javascript" src="walk_header2.js"></script>
<!-- header end -->
<table width="1002" border="0" cellspacing="0" cellpadding="0" class="set-bgtop" background="images/page-back.gif">
  <tr> 
    <td width="262" valign="top"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="23" colspan="2">&nbsp;</td>
        </tr>
        <tr> 
          <td height="2" width="12%">&nbsp;</td>
          <td height="2" width="88%">
            <!-- left function start -->
            <script language="javascript" src="walk_left2.js"></script>
            <!-- left function end -->
          </td>
        </tr>
      </table>
    </td>    
    <td width="740" valign="top"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="23" width="740">&nbsp;</td>
        </tr>
        <tr> 
          <td>           
            <table width="713" border="0" cellspacing="0" cellpadding="0">
              <!-- tip start -->
              <tr> 
                <td background="images/block-top01.gif" height="60" valign="top"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="7%" height="27">&nbsp;</td>
                      <td width="93%" height="27">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="7%">&nbsp;</td>
                      <td width="93%"><b><font color="#FFFFFF">效益評估-輸入學生上學方式統計</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <!-- tip end -->
              <tr> 
                <td background="images/block-back.gif">                
                  <table width="703" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td>
                        <BR><BR> 
<?php if ($idx==1) { ?>      
<!-- work sheet start-->
	<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">  
		    <tr>
                      <td class="tdHeads" width="250">學校名稱：</td>
                      <td class="tdHeads2"><?php echo $data_arr[1]?></td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">全校學生人數：</td>
                      <td class="tdHeads2">
                      <input type="input" name="total_students" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">回報時程：</td>
                      <td class="tdHeads2">
                        <select name="when_response">
				<option value="1">活動前2週</option>
				<option value="2">活動進行後2週</option>
				<option value="3">活動進行後4週</option>
				<option value="4">活動結束後2週</option>
			</select>
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">班級：</td>
                      <td class="tdHeads2">
                      <input type="input" name="sign_year" size="3" class="inputs" maxlength="2" onblur="check_num(this)">年
                      <input type="input" name="sign_class" size="3" class="inputs" maxlength="10">班
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">全班人數：</td>
                      <td class="tdHeads2">
                      <input type="input" name="sign_students" size="3" class="inputs" maxlength="3" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">全班人數：</td>
                      <td class="tdHeads2">
                      <input type="input" name="sign_teacher" size="10" class="inputs" maxlength="10">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">第一天：</td>
                      <td class="tdHeads2">
                      <input type="input" name="first_day" size="10" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('first_day')">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">自行走路：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f11" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">自行騎腳踏車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f12" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-走路：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f131" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-騎腳踏車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f132" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-騎機車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f133" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-開車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f134" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">安親班交通車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f14" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">大眾運輸系統：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f15" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">他一說明：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f161" size="20" class="inputs" maxlength="50">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他一數量統計：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f162" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他二說明：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f171" size="20" class="inputs" maxlength="50">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他二數量統計：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f172" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">第二天：</td>
                      <td class="tdHeads2">
                      <input type="input" name="second_day" size="10" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('second_day')">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">自行走路：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f21" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">自行騎腳踏車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f22" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-走路：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f231" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-騎腳踏車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f232" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-騎機車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f233" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-開車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f234" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">安親班交通車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f24" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">大眾運輸系統：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f25" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">他一說明：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f261" size="20" class="inputs" maxlength="50">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他一數量統計：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f262" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他二說明：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f271" size="20" class="inputs" maxlength="50">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他二數量統計：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f272" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">第三天：</td>
                      <td class="tdHeads2">
                      <input type="input" name="third_day" size="10" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('third_day')">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">自行走路：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f31" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">自行騎腳踏車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f32" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-走路：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f331" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-騎腳踏車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f332" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-騎機車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f333" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">家長接送-開車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f334" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">安親班交通車：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f34" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">大眾運輸系統：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f35" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">他一說明：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f361" size="20" class="inputs" maxlength="50">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他一數量統計：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f362" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他二說明：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f371" size="20" class="inputs" maxlength="50">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="250">其他二數量統計：</td>
                      <td class="tdHeads2">
                      <input type="input" name="f372" size="6" class="inputs" maxlength="6" onblur="check_num(this)">
                      </td>
                    </tr>

                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="新增學生上學方式統計">
                        <input class="btns" type="reset" value="重新輸入">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
<!-- work sheet end-->
<?php } else { ?>
<!-- ERROR MSG S-->
	<table class="table_in" width="550" height="200" cellspacing="1" cellpadding="3" align="center">
	  <tr class="tr_title">
	    <td class="td_title">系統訊息</td>
	  </tr>
	  <tr>
	    <td class="msg" width="550">
	    <center>
	      <?php
	      echo $msg;
	      ?>
	    </center>
	    </td>
	  </tr>
	  <tr class="tr_title">
	    <td class="td_title"></td>
	  </tr>
	</table>
<!-- ERROR MSG E-->
<?php } ?>   
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td background="images/block-back.gif" height="25">&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/block-bottom.gif" width="713" height="29"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>      				    
    </td>
  </tr>
  <tr>
    <td width="262" valign="top" height="40">&nbsp;</td>
    <td width="740" valign="top" height="40">&nbsp;</td>
  </tr>
</table>
<!-- footer -->
<script language="javascript" src="walk_footer1.js"></script>
<!-- footer -->
</form>
</body>
</html>
