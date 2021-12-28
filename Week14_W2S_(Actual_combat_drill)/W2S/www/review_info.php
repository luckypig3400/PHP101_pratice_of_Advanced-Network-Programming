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
	if ($ck_user_no=="" || $ck_group!="1")
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
		$sql =" select a.join_id,b.name,a.issue_date,c.name,a.issue_times,";
		$sql.="	a.contact_name,a.contact_tel,a.contact_status,a.note,a.join_date,";
		$sql.="	a.modify_date";
		$sql.=" from comment_schedule a, user_info b, school_info c";
		$sql.=" where a.schedule_no='$schedule_no'";		
		$sql.=" and a.join_id=b.user_no";
		$sql.=" and a.school_no=c.school_no";
		$sql.=" and a.status='1'";

		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此評核意見不存在-ERROR"."</font>";
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
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<script language=javascript>
function form_action()
{
	answer = confirm("是否確定：維護評核行程？");
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
<form name="AP_CT" action="review_update.php" method="post" onsubmit="return form_action()">
<input name="schedule_no" type="hidden" value="<?php echo $schedule_no ?>">
<input name="join_id" type="hidden" value="<?php echo $data_arr[0] ?>">
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
                      <td width="93%"><b><font color="#FFFFFF">輔導評核管理-輔導評核資訊</font></b></td>
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
                      <td class="tdHeads" width="150">輔導委員姓名：</td>
                      <td class="tdHeads2"><?php echo $data_arr[1]?></td>                      
                      </td>
                    </tr>
                    <tr>
                      <td class="tdHeads" width="150">訪視日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[2]?></td>
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">訪視學校：</td>
                      <td class="tdHeads2"><?php echo $data_arr[3]?></td>
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">訪視學校聯絡人：</td>
                      <td class="tdHeads2"><?php echo $data_arr[5]?></td>
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150">電話：</td>
                      <td class="tdHeads2"><?php echo $data_arr[6]?></td>
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150">訪視次數：</td>
                      <td class="tdHeads2"><?php echo $data_arr[4]?>次</td>
                      </td>
                    </tr> 
		    <tr>
                      <td class="tdHeads" width="150">是否確認行程：</td>
                      <td class="tdHeads2"><?php echo ($data_arr[7]==1?"是":"否"); ?></td>
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">狀態：</td>
                      <td class="tdHeads2">
		      <font color="red"><input type="radio" name="status" value="2" checked>核准 &nbsp; <input type="radio" name="status" value="3">否決</font>
                      </td>
                    </tr>

		    <tr>
                      <td class="tdHeads" width="150">備註：</td>
                      <td class="tdHeads2">
                      <textarea name="note" cols="40" rows="8"><?php echo $data_arr[8]?></textarea>                      
                      </td>
                    </tr>
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="維護評核行程">
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
