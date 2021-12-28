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
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<script language=javascript>
function form_action()
{
	if(document.AP_CT.id.value=="")
	{
		alert("請輸入：帳號");
		return false;		
	}
	else if(document.AP_CT.passwd.value=="")
	{
		alert("請輸入：密碼");
		return false;		
	}
	else if(document.AP_CT.name.value=="")
	{
		alert("請輸入：姓名");
		return false;		
	}
	else if(document.AP_CT.group.value=="2" && document.AP_CT.school_no.value=="")
	{
		alert("請輸入：學校名稱");
		return false;		
	}			
	else
	{				
		answer = confirm("是否確定：輸入使用者帳號？");
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
function chk_pwd()
{
	var l_date = new Date();
	var key2= l_date.getTime();    	
  	var winFeature="dialogWidth:700px;dialogHeight:500px;status:no;";
  	var pwd_info = null;

    	pwd_info = window.showModalDialog("user_chk.php" + "?key2=" + key2,"",winFeature);
    	if(pwd_info!=undefined)
    	{
      		document.AP_CT.passwd.value = pwd_info[0];
    	}
    	else
    	{
    		document.AP_CT.passwd.value = "";
    	}
}
function chk_school()
{
	var l_date = new Date();
	var key2= l_date.getTime();    	
  	var winFeature="dialogWidth:710px;dialogHeight:500px;status:no;";
  	var school_info = null;

    	school_info = window.showModalDialog("user_chk2.php" + "?key2=" + key2 ,"",winFeature);
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
<form name="AP_CT" action="user_add.php" method="post" onsubmit="return form_action()">
<input name="school_no" type="hidden" value="">
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
                      <td width="93%"><b><font color="#FFFFFF">帳號管理-輸入使用者帳號</font></b></td>
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
                      <td class="tdHeads" width="150"><font color='red'>＊</font>帳號：</td>
                      <td class="tdHeads2"><input type="input" name="id" size="20" class="inputs" maxlength="20">                      
                      </td>
                    </tr>                     
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>密碼：</td>
                      <td class="tdHeads2">
                      <input type="input" name="passwd" size="20" class="inputs">
                      <input class="btns" type="button" value="*" onClick="chk_pwd()">
                      </td>
                    </tr> 
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>姓名：</td>
                      <td class="tdHeads2"><input type="input" name="name" size="20" class="inputs" maxlength="20">                      
                      </td>
                    </tr> 
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>群組：</td>
                      <td class="tdHeads2">  
                        <select name="group">
				<option value="1">網站後台管裡</option>
				<option value="2">種子學校平台</option>
				<option value="3">輔導評核平台</option>
				<option value="4">報名學校平台</option>
			</select>
                      </td>
                    </tr>                     
                    <tr>
                      <td class="tdHeads" width="150">學校名稱：</td>
                      <td class="tdHeads2">
                      <input type="input" name="school_name" size="40" class="inputs" readonly>
                      <input class="btns" type="button" value="*" onClick="chk_school()">
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">電話：</td>
                      <td class="tdHeads2"><input type="input" name="tel" size="20" class="inputs" maxlength="20" onblur=check_tel(this)>                      
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150">傳真：</td>
                      <td class="tdHeads2"><input type="input" name="fax" size="20" class="inputs" maxlength="20" onblur=check_tel(this)>                      
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">電子郵件：</td>
                      <td class="tdHeads2"><input type="input" name="email" size="20" class="inputs" maxlength="20" onblur=check_mail(this)>                      
                      </td>
                    </tr>     
		    <tr>
                      <td class="tdHeads" width="150">備註：</td>
                      <td class="tdHeads2">
                      <textarea name="note" cols="40" rows="4"></textarea>
                      </td>
                    </tr>                                                                                                           
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="新增使用者帳號">
                        <input class="btns" type="reset" value="重新輸入">
<!--
                        <input class="btns" type="button" value="回上一頁" onclick="history.go(-1)">
--->
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
