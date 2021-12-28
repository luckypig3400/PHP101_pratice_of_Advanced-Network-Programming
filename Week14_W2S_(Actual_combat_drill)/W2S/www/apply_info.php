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
	$apply_no=(isset ($_GET['apply_no'])) ? $_GET['apply_no'] : "";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0;   
	
	$status_name=array("1"=>"已申請","2"=>"已核准","3"=>"已否決");
//--------------------------------------
//processing
//--------------------------------------	
	if ($ck_user_no=="" || $ck_group!="1")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	$sql =" select count(*) from apply_info";
	$sql.=" where apply_no='$apply_no'";	
	
	if(TestDuplicate($conn,$sql))
	{
		//--------------------------------------	
		$sql =" select a.apply_no,b.name,a.school_name,a.contact_name,a.contact_tel,";
		$sql.="	a.contact_fax,a.contact_email,a.status,a.note,a.review_id,";
		$sql.="	a.join_date,a.modify_date,a.apply_url,a.apply_note";
		$sql.=" from apply_info a,school_area b";
		$sql.=" where a.apply_no='$apply_no'";
		$sql.=" and a.area_code=b.area_code";
	
		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此申請表不存在-ERROR"."</font>";
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
	answer = confirm("是否確定：維護申請表？");
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
<form name="AP_CT" action="apply_update.php" method="post" onsubmit="return form_action()">
<input name="apply_no" type="hidden" value="<?php echo $apply_no ?>">
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
                      <td width="93%"><b><font color="#FFFFFF">報名學校管理-報名學校資訊</font></b></td>
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
                      <td class="tdHeads" width="150">申請日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[10]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">學校名稱：</td>
                      <td class="tdHeads2"><?php echo $data_arr[2]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">聯絡人：</td>
                      <td class="tdHeads2"><?php echo $data_arr[3]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">電話：</td>
                      <td class="tdHeads2"><?php echo $data_arr[4]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">傳真：</td>
                      <td class="tdHeads2"><?php echo $data_arr[5]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">電子郵件：</td>
                      <td class="tdHeads2"><?php echo $data_arr[6]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">學校首頁或相關活動連結網址：</td>
                      <td class="tdHeads2"><?php echo $data_arr[12]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">學校推動走路上學現況說明：</td>
                      <td class="tdHeads2"><?php echo nl2br($data_arr[13])?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">狀態：</td>
                      <td class="tdHeads2">
<?php
/*
		      <font color="red"><input type="radio" name="status" value="2" <?php echo ($data_arr[7]=="3")?"":"checked"; ?>>核准 &nbsp; <input type="radio" name="status" value="3"<?php echo ($data_arr[7]=="3")?"checked":""; ?>>否決</font>
*/
?>
	<?php if ($data_arr[7]==1) { ?>
		      <font color="red"><input type="radio" name="status" value="2" checked>核准 &nbsp; <input type="radio" name="status" value="3">否決</font>
	<?php } else if ($data_arr[7]==2) { ?>
		      已核准
	<?php } else if ($data_arr[7]==3) { ?>
		      已否決
	<?php } ?>
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">審核日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[11]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">備註：</td>
                      <td class="tdHeads2">
	<?php if ($data_arr[7]==1) { ?>
                      <textarea name="note" cols="40" rows="8"><?php echo $data_arr[8] ?></textarea>
	<?php } else { ?>
		      <?php echo nl2br($data_arr[8]) ?>
	<?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="td_title" colspan="2" >
	<?php if ($data_arr[7]==1) { ?>
                        <input class="btns" type="submit" value="維護申請表">
                        <input class="btns" type="reset" value="重新輸入">
	<?php } else { ?>
                        <input class="btns" type="button" value="回上一頁" onClick="javascript:history.go(-1);">
	<?php } ?>
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
