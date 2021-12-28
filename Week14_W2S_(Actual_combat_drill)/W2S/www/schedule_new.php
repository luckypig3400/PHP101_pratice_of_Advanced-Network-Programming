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
	$seq="";            
//--------------------------------------
//processing
//--------------------------------------	
	if ($ck_user_no=="" || $ck_group!="3")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
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
	if(document.AP_CT.issue_date.value=="")
	{
		alert("請輸入：訪視日期");
		return false;		
	}
	else if(document.AP_CT.school_no.value=="")
	{
		alert("請輸入：訪視學校");
		return false;		
	}
	else if(document.AP_CT.issue_times.value=="")
	{
		alert("請輸入：訪視次數");
		return false;		
	}
	else if(document.AP_CT.contact_name.value=="")
	{
		alert("請輸入：訪視聯絡人");
		return false;		
	}			
	else if(document.AP_CT.contact_tel.value=="")
	{
		alert("請輸入：電話");
		return false;		
	}
	else if(document.AP_CT.contact_status.value=="")
	{
		alert("請輸入：是否確認行程");
		return false;		
	}
	else
	{				
		answer = confirm("是否確定：新增輔導評核行程？");
		if (answer)
		{	
			return true;
		}
		else
		{
			return false;	
		}
	}
}
function chk_school()
{
	var l_date = new Date();
	var key2= l_date.getTime();    	
  	var winFeature="dialogWidth:710px;dialogHeight:500px;status:no;";
  	var school_info = null;

    	school_info = window.showModalDialog("schedule_chk.php" + "?key2=" + key2 ,"",winFeature);
    	if(school_info!=undefined)
    	{
      		document.AP_CT.school_no.value = school_info[0];
      		document.AP_CT.school_name.value = school_info[1];
    	}
    	else
    	{
    		document.AP_CT.school_no.value = "";
    		document.AP_CT.school_name.value = "";
    	}
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="schedule_add.php" method="post" onsubmit="return form_action()">
<input name="school_no" type="hidden" value="">
<!-- header start -->
<script language="javascript" src="walk_header3.js"></script>
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
            <script language="javascript" src="walk_left3.js"></script>
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
                      <td width="93%"><b><font color="#FFFFFF">評核行程管理-輸入評核行程</font></b></td>
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
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視日期：</td>
                      <td class="tdHeads2">
                      <input type="input" name="issue_date" size="10" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('issue_date')">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視學校：</td>
                      <td class="tdHeads2">
                      <input type="input" name="school_name" size="40" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="chk_school()">
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視次數：</td>
                      <td class="tdHeads2">
		      <input type="radio" name="issue_times" value="1" checked>一次 &nbsp; <input type="radio" name="issue_times" value="2">二次
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視聯絡人：</td>
                      <td class="tdHeads2"><input type="input" name="contact_name" size="20" class="inputs" maxlength="20">                      
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>電話：</td>
                      <td class="tdHeads2"><input type="input" name="contact_tel" size="20" class="inputs" maxlength="20" onblur=check_tel(this)>                      
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>是否確認行程：</td>
                      <td class="tdHeads2">
		      <input type="radio" name="contact_status" value="1">是 &nbsp; <input type="radio" name="contact_status" value="2">否
                      </td>
                    </tr>
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="新增輔導評核行程">
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
