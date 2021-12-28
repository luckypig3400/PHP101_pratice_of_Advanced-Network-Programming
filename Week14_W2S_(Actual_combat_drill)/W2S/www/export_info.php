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
	if ($ck_user_no=="" || $ck_group!="1")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------	
	$sql =" select a.table_no,a.name,a.description";
	$sql.=" from export_info a";
	$sql.=" order by a.name,a.table_no";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();	
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
	var objForm = document.forms["AP_CT"];
	var objLen = objForm.length;
	var SelectOne = 0;
	for (var i=0;i<objLen;i++)
	{
		if (objForm.elements[i].type=="checkbox" && objForm.elements[i].checked==true)
		{
			SelectOne = 1;
			break;
		}
	}
	if (SelectOne==0)
	{
		alert("請至少選擇一資料表");
		return false;		
	}
	else if(document.AP_CT.start_date.value=="")
	{
		alert("請輸入：起始日期");
		return false;		
	}
	else if(document.AP_CT.end_date.value=="")
	{
		alert("請輸入：結束日期");
		return false;		
	}			
	else
	{				
		answer = confirm("是否確定：匯出資料表？");
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

function chk_selectall()
{
	var objForm = document.forms["AP_CT"];
	var objLen = objForm.length;
	for (var i=0;i<objLen;i++)
	{
		if (objForm.elements[i].type == "checkbox")
		{
			objForm.elements[i].checked = true;
		}
	}
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="export_done.php" method="post" onsubmit="return form_action()">
<input name="totalbox" type="hidden" value="<?php echo $row_count ?>">
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
                      <td width="93%"><b><font color="#FFFFFF">資料管理-資料表列表</font></b></td>
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
<!-- List Header S-->
            <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td colspan="2" align="left">
                  <table border="0" cellspacing="3" cellpadding="0">                                              
                    <tr>
                      <td><font color='red'>＊</font>起始日期：</td>
                      <td><input type="input" name="start_date" size="10" class="inputs" readonly></td>
                      <td><input class="btns" type="button" value="*" onClick="w_displayDatePicker('start_date')"></td>
                    </tr> 
                    <tr>
                      <td><font color='red'>＊</font>結束日期：</td>
                      <td><input type="input" name="end_date" size="10" class="inputs" readonly></td>
                      <td><input class="btns" type="button" value="*" onClick="w_displayDatePicker('end_date')"></td>
                    </tr> 
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="600" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
		
                      <td class="td_title" width="50">序號</td>
                      <td class="td_title" width="200">表格名稱</td>
                      <td class="td_title" width="300">功能描述</td> 
                      <td class="td_title" width="50">選擇</td> 
                    </tr>
<!-- List Header E-->
<!-- List records S--> 
		    <?php	
		    for($i=0;$i<$row_count;$i++)
		    {	
		    	$data_arr=$result->fetch();	
		    ?>	
		    	<?php 
	                if($i%2 == 1)
	                {
	                ?>
	                    	<tr class="tr_data">
	                <?php 
	                }
	                else
	                {
	                ?>
	                    	<tr class="tr_data_2">                    
	                <?php
	                }
	                ?>        	
	                      	<td align="center" width="50"><?php echo ($i+1) ?></td>
	                      	<td align="left" width="200"><?php echo $data_arr[1] ?></td>
	                      	<td align="left" width="300"><?php echo $data_arr[2] ?></td>
	                      	<td align="center" width="50"><input name="table_no[]" type="checkbox" value="<?php echo $data_arr[0] ?>"></td>
	                    	</tr>   
		    <?php
		    }
		    ?>	
<!-- List records E-->
                    <tr>
                      <td class="td_title" colspan="4">
                        <input class="btns" type="submit" value="匯出資料表">
                        <input class="btns" type="button" name="checkselect" value="全選" onClick="chk_selectall();">
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
