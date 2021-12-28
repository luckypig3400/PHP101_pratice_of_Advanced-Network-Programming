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
	$banner_no=(isset ($_GET['banner_no'])) ? $_GET['banner_no'] : "";
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
	if ($ck_user_no=="" || $ck_group!="1")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	$sql =" select count(*) from banner_info";
	$sql.=" where banner_no='$banner_no'";	
	
	if(TestDuplicate($conn,$sql))
	{
		//--------------------------------------	
		$sql =" select a.title,a.pic_no,b.title,b.path,a.pic_url,";
		$sql.="	a.start_date,a.expire_date,c.name,a.join_date,a.modify_date,";
		$sql.="	a.type";
		$sql.=" from banner_info a, pic_info b, user_info c";
		$sql.=" where a.banner_no='$banner_no'";		
		$sql.=" and a.pic_no=b.pic_no";
		$sql.=" and a.join_id=c.user_no";
	
		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此廣告不存在-ERROR"."</font>";
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
	if(document.AP_CT.pic_no.value=="")
	{
		alert("請輸入：廣告圖片");
		return false;		
	}
	else if(document.AP_CT.type.value=="")
	{
		alert("請輸入：廣告區塊");
		return false;		
	}
	else if(document.AP_CT.pic_url.value=="")
	{
		alert("請輸入：廣告URL");
		return false;		
	}
	else if(document.AP_CT.start_date.value=="")
	{
		alert("請輸入：啟用日期");
		return false;		
	}			
	else if(document.AP_CT.expire_date.value=="")
	{
		alert("請輸入：到期日期");
		return false;		
	}			
	else
	{				
		answer = confirm("是否確定：維護廣告？");
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
function banner_pic_new()
{
	var l_date = new Date();
	var key2= l_date.getTime();    	
  	var winFeature="dialogWidth:720px;dialogHeight:600px;status:no;";
  	var pic_info = null;

    	pic_info = window.showModalDialog("banner_pic1.php" + "?key2=" + key2 ,"",winFeature);
    	if(pic_info!=undefined)
    	{
      		document.AP_CT.pic_no.value = pic_info[0];
		span_myimg1.innerHTML = '<img name="myimg1" border="1" width="352" height="240" align="top" src="banner/' + pic_info[1] + '">';
    	}
/*
    	else
    	{
    		document.AP_CT.pic_no.value = "<?php echo $data_arr[1] ?>";
		span_myimg1.innerHTML = '<img name="myimg1" border="1" width="352" height="240" align="top" src="banner/<?php echo $data_arr[3]?>" alt="<?php echo $data_arr[2]?>">';
    	}
*/
}
function chk_pic_url()
{
    	if(document.AP_CT.pic_url.value=="" || document.AP_CT.pic_url.value=="http://")
    	{
    		alert("請輸入：廣告URL");
    	}
    	else
    	{
		window.open(document.AP_CT.pic_url.value);
    	}
}
function chk_reset()
{
	span_myimg1.innerHTML = '<img name="myimg1" border="1" width="352" height="240" align="top" src="banner/<?php echo $data_arr[3]?>" alt="<?php echo $data_arr[2]?>">';
	return true;
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="banner_update.php" method="post" onsubmit="return form_action()">
<input name="banner_no" type="hidden" value="<?php echo $banner_no ?>">
<input name="pic_no" type="hidden" value="<?php echo $data_arr[1] ?>">
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
                      <td width="93%"><b><font color="#FFFFFF">廣告管理-廣告內容資訊</font></b></td>
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
                      <td class="tdHeads" width="150">廣告名稱：</td>
                      <td class="tdHeads2"><?php echo $data_arr[0]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>廣告區塊：</td>
                      <td class="tdHeads2"><input type="radio" name="type" value="1" <?php echo ($data_arr[10]=="1")?"checked":""; ?>>廣告(一) &nbsp; <input type="radio" name="type" value="2" <?php echo ($data_arr[10]=="2")?"checked":""; ?>>廣告(二)
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>廣告圖片：</td>
                      <td class="tdHeads2">
                      <span id="span_myimg1"><img name="myimg1" border="1" width="352" height="240" align="top" src="banner/<?php echo $data_arr[3]?>" alt="<?php echo $data_arr[2]?>"></span>
                      <input class="btns" type="button" value="*" onClick="banner_pic_new()">
                      </td>
                    </tr> 
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>廣告URL：</td>
                      <td class="tdHeads2">
                      <input type="input" name="pic_url" size="30" class="inputs" maxlength="150" value="<?php echo $data_arr[4]?>">
                      <input class="btns" type="button" value="*" onClick="chk_pic_url();">
                      </td>
                    </tr> 
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>啟用日期：</td>
                      <td class="tdHeads2">
                      <input type="input" name="start_date" size="10" class="inputs" value="<?php echo $data_arr[5]?>" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('start_date')">
                      </td>
                    </tr> 
                    <tr>
                      <td class="tdHeads" width="150"><font color='red'>＊</font>到期日期：</td>
                      <td class="tdHeads2">
                      <input type="input" name="expire_date" size="10" class="inputs" value="<?php echo $data_arr[6]?>" readonly>
                      <input class="btns" type="button" value="*" onClick="w_displayDatePicker('expire_date')">
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150">建檔人員：</td>
                      <td class="tdHeads2"><?php echo $data_arr[7]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">建檔日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[8]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">修改時間：</td>
                      <td class="tdHeads2"><?php echo $data_arr[9]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">資料管理：</td>
                      <td class="tdHeads2"><input name="enable" type="checkbox" value="F"><font color='red'>刪除此筆資料</font></td>
                    </tr>            
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="維護廣告">
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
