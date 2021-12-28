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
	$qa_no=(isset ($_GET['qa_no'])) ? $_GET['qa_no'] : "";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0;   
	
	$type_name=array("1"=>"學生Q&A","2"=>"家長Q&A","3"=>"學校Q&A");
//--------------------------------------
//processing
//--------------------------------------	
	if ($ck_user_no=="" || $ck_group!="1")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	$sql =" select count(*) from qa_info";
	$sql.=" where qa_no='$qa_no'";	
	
	if(TestDuplicate($conn,$sql))
	{
		//--------------------------------------	
		$sql =" select a.qa_no,a.type,a.question,a.answer,b.name,";
		$sql.="	a.join_date,a.modify_date";
		$sql.=" from qa_info a, user_info b";
		$sql.=" where a.qa_no='$qa_no'";		
		$sql.=" and a.join_id=b.user_no";
	
		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此Q&A不存在-ERROR"."</font>";
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
	if(document.AP_CT.answer.value=="")
	{
		alert("請輸入：解決方案");
		return false;		
	}			
	else
	{				
		answer = confirm("是否確定：維護Q&A？");
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

</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="qa_update.php" method="post" onsubmit="return form_action()">
<input name="qa_no" type="hidden" value="<?php echo $qa_no ?>">
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
                      <td width="93%"><b><font color="#FFFFFF">Q&A管理-Q&A資訊</font></b></td>
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
                      <td class="tdHeads" width="150">Q&A類別：</td>
                      <td class="tdHeads2"><?php echo $type_name[$data_arr[1]]?></td>     
                    </tr>                     
                    <tr>
                      <td class="tdHeads" width="150">問題：</td>
                      <td class="tdHeads2"><?php echo nl2br($data_arr[2])?></td>
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">解決方案：</td>
                      <td class="tdHeads2">
                      <textarea name="answer" cols="40" rows="8"><?php echo $data_arr[3]?></textarea>                      
                      </td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">建檔人員：</td>
                      <td class="tdHeads2"><?php echo $data_arr[4]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">建檔日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[5]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">修改時間：</td>
                      <td class="tdHeads2"><?php echo $data_arr[6]?></td>
                    </tr>
		    <tr>
                      <td class="tdHeads" width="150">資料管理：</td>
                      <td class="tdHeads2"><input name="enable" type="checkbox" value="F"><font color='red'>刪除此筆資料</font></td>
                    </tr>                                                                                                                                                               
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="維護Q&A">
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
