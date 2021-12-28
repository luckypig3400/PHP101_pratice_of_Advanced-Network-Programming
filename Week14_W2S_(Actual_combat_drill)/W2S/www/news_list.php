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
	$type=(isset ($_POST['type'])) ? $_POST['type'] : "0";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0;

	$type_name=array("0"=>"全部類別","1"=>"網站公告","2"=>"活動訊息","3"=>"健康新聞");
//--------------------------------------
//processing
//--------------------------------------	
	if ($ck_user_no=="" || $ck_group!="1")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------	
	$sql =" select a.news_no,a.issue_date,a.type,a.subject";
	$sql.=" from news_info a";
	$sql.=" where 1>0";
  	if ($type!="0")
	{
		$sql.=" and a.type='$type'"; 
	}
	$sql.=" order by a.news_no desc";

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
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
<script language=javascript>
function form_action()
{
	document.AP_CT.submit();
}
function change_type()
{
	document.AP_CT.action="news_list.php";
	document.AP_CT.submit();
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="news_new.php" method="post">
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
                      <td width="93%"><b><font color="#FFFFFF">消息管理-最新消息列表</font></b></td>
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
            <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td colspan="2" align="left">
                <input class="btns" type="button" value="新增最新消息" onClick="form_action()">              
                </td>
              </tr>
              <tr>
              	<td width="520" align="right"><font color='red'>群組：</font></td>
                <td width="100" align="left">                	
                	<select name="type" onChange="change_type()">				
				<option value="0" <?php echo ($type=="0")?"selected":"" ?>>全部類別</option>
				<option value="1" <?php echo ($type=="1")?"selected":"" ?>>網站公告</option>
				<option value="2" <?php echo ($type=="2")?"selected":"" ?>>活動訊息</option>
				<option value="3" <?php echo ($type=="3")?"selected":"" ?>>健康新聞</option>
			</select>              
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="620" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
                      <td class="td_title" width="50">序號</td>
                      <td class="td_title" width="150">消息類別</td> 
                      <td class="td_title" width="120">發表日期</td>                                                                                      
                      <td class="td_title" width="300">消息標題</td>
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
	                      	<td align="center" width="150"><?php echo $type_name[$data_arr[2]] ?></td>
	                      	<td align="center" width="120"><?php echo $data_arr[1] ?></td>
	                      	<td align="left" width="300"><a href="news_info.php?news_no=<?php echo $data_arr[0]?>"><?php echo $data_arr[3] ?></a></td>
	                    	</tr>   
		    <?php
		    }
		    ?>	
<!-- List records E-->
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
