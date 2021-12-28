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
	if ($ck_user_no=="" || $ck_group!="1")
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
		alert("請輸入：發表日期");
		return false;		
	}
	else if(document.AP_CT.type.value=="")
	{
		alert("請輸入：消息類別");
		return false;		
	}
	else if(document.AP_CT.subject.value=="")
	{
		alert("請輸入：消息主旨");
		return false;		
	}
	else if(document.AP_CT.content.value=="")
	{
		alert("請輸入：消息內容");
		return false;		
	}			
	else
	{				
		answer = confirm("是否確定：輸入最新消息？");
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
function news_pic_new()
{
	var l_date = new Date();
	var key2= l_date.getTime();    	
  	var winFeature="dialogWidth:720px;dialogHeight:600px;status:no;";
  	var pic_info = null;

    	pic_info = window.showModalDialog("news_pic.php" + "?key2=" + key2 ,"",winFeature);
    	if(pic_info!=undefined)
    	{
      		document.AP_CT.pic_no.value = pic_info[0];
		span_myimg1.innerHTML = '<img name="myimg1" border="1" width="352" height="240" align="top" src="news/' + pic_info[1] + '">';
    	}
}
function chk_reset()
{
	span_myimg1.innerHTML = '';
	return true;
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="news_add.php" method="post" onsubmit="return form_action()">
<input name="pic_no" type="hidden" value="">
<!-- header start -->
<script language="javascript" src="walk_header1.js"></script>
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
            <script language="javascript" src="walk_left1.js"></script>
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
                      <td width="93%"><b><font color="#FFFFFF">消息管理-輸入最新消息</font></b></td>
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
                      <td class="tdHeads" width="150"><font color='red'>＊</font>消息類別：</td>
                      <td class="tdHeads2">  
                        <select name="type">				
				<option value="1">網站公告</option>
				<option value="2">活動訊息</option>
				<option value="3">健康新聞</option>
			</select>   
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>發表日期：</td>
                      <td class="tdHeads2">
                      <input type="input" name="issue_date" size="10" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('issue_date')">
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>消息標題：</td>
                      <td class="tdHeads2"><input type="input" name="subject" size="40" class="inputs" maxlength="100">
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150">消息圖片：</td>
                      <td class="tdHeads2">
                      <span id="span_myimg1"><img name="myimg1" border="1" width="352" height="240" style="display='none'"></span>
                      <input class="btns" type="button" value="*" onClick="news_pic_new()">
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>消息內容：</td>
                      <td class="tdHeads2">
                      <textarea name="content" cols="40" rows="8"></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="新增最新消息">
                        <input class="btns" type="reset" value="重新輸入" onClick="chk_reset()">
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
