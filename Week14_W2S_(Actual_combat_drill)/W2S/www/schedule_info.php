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

	$schedule_no=(isset ($_GET['schedule_no'])) ? $_GET['schedule_no'] : "";
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
	if ($ck_user_no=="" || $ck_group!="3")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	$sql =" select count(*) from comment_schedule";
	$sql.=" where schedule_no='$schedule_no'";	
	
	if(TestDuplicate($conn,$sql))
	{
		//--------------------------------------	
		$sql =" select a.issue_date,b.school_no,b.name,a.issue_times,a.contact_name,";
		$sql.="	a.contact_tel,a.contact_status,a.status,a.note,a.review_id,";
		$sql.="	a.join_id,a.join_date,a.modify_date";
		$sql.=" from comment_schedule a, school_info b";
		$sql.=" where a.schedule_no='$schedule_no'";		
		$sql.=" and a.join_id='$ck_user_no'";
		$sql.=" and a.school_no=b.school_no";

		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此輔導評核行程不存在-ERROR"."</font>";
		$idx=0;
	}
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
		answer = confirm("是否確定：維護輔導評核行程？");
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

function chk_status()
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
		answer = confirm("是否確定：申請輔導評核公文？");
		if (answer)
		{
			document.AP_CT.status.value = "A";
			document.AP_CT.submit();
			return true;
		}
		else
		{
			return false;	
		}
	}
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="schedule_update.php" method="post" onsubmit="return form_action()">
<input name="schedule_no" type="hidden" value="<?php echo $schedule_no ?>">
<input name="school_no" type="hidden" value="<?php echo $data_arr[1] ?>">
<input name="status" type="hidden" value="<?php echo $data_arr[7] ?>">
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
                      <td width="93%"><b><font color="#FFFFFF">評核行程管理-評核行程資訊</font></b></td>
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
                      <input type="input" name="issue_date" size="10" class="inputs" value="<?php echo $data_arr[0]?>" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('issue_date')">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視學校：</td>
                      <td class="tdHeads2">
                      <input type="input" name="school_name" size="40" class="inputs" value="<?php echo $data_arr[2] ?>" readonly>
                      <input class="btns" type="button" value="*" onClick="chk_school()">
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視次數：</td>
                      <td class="tdHeads2">
		      <input type="radio" name="issue_times" value="1" <?php echo ($data_arr[3]==1)?"checked":""; ?>>一次 &nbsp; <input type="radio" name="issue_times" value="2"<?php echo ($data_arr[3]==2)?"checked":""; ?>>二次
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>訪視聯絡人：</td>
                      <td class="tdHeads2"><input type="input" name="contact_name" size="20" class="inputs" value="<?php echo $data_arr[4] ?>" maxlength="20">                      
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>電話：</td>
                      <td class="tdHeads2"><input type="input" name="contact_tel" size="20" class="inputs" maxlength="20" value="<?php echo $data_arr[5] ?>" onblur=check_tel(this)>                      
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>是否確認行程：</td>
                      <td class="tdHeads2">
		      <input type="radio" name="contact_status" value="1" <?php echo ($data_arr[6]==1)?"checked":""; ?>>是 &nbsp; <input type="radio" name="contact_status" value="2"<?php echo ($data_arr[6]==2)?"checked":""; ?>>否
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">建檔日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[11]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">修改時間：</td>
                      <td class="tdHeads2"><?php echo $data_arr[12]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">資料管理：</td>
                      <td class="tdHeads2"><input name="enable" type="checkbox" value="F"><font color='red'>刪除此筆資料</font></td>
                    </tr>                                                                                                                                                               
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="button" value="申請輔導評核公文" onClick="chk_status();">
                        <input class="btns" type="submit" value="維護輔導評核行程">
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
