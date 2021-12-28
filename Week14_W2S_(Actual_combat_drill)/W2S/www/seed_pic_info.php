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
	if(document.AP_CT.show_upload.value=="")
	{
		alert("請輸入：上傳圖片");
		return false;		
	}	
	else if(!check_pic(document.AP_CT.show_upload.value))
	{
		alert("你所輸入的圖片格式錯誤，需為圖片檔:*.gif,*.jpg");
		return false;	
	}	
	else
	{
		answer = confirm("是否確定：更新圖片？");
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
function check_pic(p_name)
{
	splitName = p_name.split(".");
	
	fileType = splitName[(splitName.length-1)].toUpperCase();

	if (fileType == "GIF" || fileType == "JPG")
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
<form name="AP_CT" enctype="multipart/form-data" action="seed_pic_update.php" method="post" onsubmit="return form_action()" target="pic_top">
<table width="740" border="0" cellspacing="0" cellpadding="0" class="set-bgtop" background="images/page-back.gif">
  <tr>       
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
                      <td width="93%"><b><font color="#FFFFFF">活動管理-上傳圖片資訊</font></b></td>
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
                      <td class="tdHeads" width="150"><font color='red'>＊</font>上傳圖片：</td>
                      <td class="tdHeads2">
                      <input type="file" name="show_upload" size="30" onChange="myimg1.style.display='';myimg1.src=show_upload.value;">
                      </td>
                    </tr>                     
                    <tr>
                      <td class="tdHeads" width="150">圖片標題：</td>
                      <td class="tdHeads2">
                      <input type="input" name="title" size="30" class="inputs" maxlength="150">
                      </td>
                    </tr> 
                    <tr>
                      <td class="tdHeads" width="150">圖片預覽：</td>
                      <td class="tdHeads2">
                      <img name="myimg1" border="1" width="352" height="240" style="display='none'">
                      </td>
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="更新圖片">
                        <input class="btns" type="reset" value="重新輸入">
                        <input class="btns" type="button" value="取消" onClick="window.close();">
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
</form>
</body>
</html>
