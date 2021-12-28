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
	$join_id=(isset ($_POST['join_id'])) ? $_POST['join_id'] : "0";
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
	$sql =" select a.schedule_no,b.name,a.issue_date,c.name,a.issue_times";
	$sql.=" from comment_schedule a, user_info b, school_info c";
	$sql.=" where 1>0";
  	if ($join_id!="0")
	{
		$sql.=" and a.join_id='$join_id'"; 
	}
	$sql.=" and a.join_id=b.user_no";
	$sql.=" and a.school_no=c.school_no";
	$sql.=" and a.status='1'";
	$sql.=" order by b.name,c.name";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();	
	//--------------------------------------
	$sql =" select b.user_no,b.name";
	$sql.=" from comment_schedule a, user_info b";
	$sql.=" where a.join_id=b.user_no";
	$sql.=" and a.status='1'";
	$sql.=" group by b.name";
	$sql.=" order by b.name";

	$result1 = $conn->query($sql);
	$row_count1= $result1->rowCount();	
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
function change_join_id()
{
	document.AP_CT.submit();
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="review_list.php" method="post">
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
                      <td width="93%"><b><font color="#FFFFFF">輔導評核管理-輔導評核列表</font></b></td>
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
            <table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
              	<td width="500" align="right"><font color='red'>輔導委員：</font></td>
                <td width="50" align="left">                	
                	<select name="join_id" onChange="change_join_id()">				
				<option value="0" <?php echo ($join_id=="0")?"selected":"" ?>>全部人員</option>
		    <?php	
		    for($i=0;$i<$row_count1;$i++)
		    {	
		    	$data_arr1=$result1->fetch();	

			echo "\t\t\t\t<option value=\"" . $data_arr1[0] . "\"" . (($join_id==$data_arr1[0])?" selected":"") . ">" . $data_arr1[1] . "</option>\n";
		    }
		    ?>	
			</select>              
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
                      <td class="td_title" width="50">序號</td>
                      <td class="td_title" width="100">輔導委員</td>
                      <td class="td_title" width="120">訪視日期</td> 
                      <td class="td_title" width="200">訪視學校</td> 
                      <td class="td_title" width="80">訪視次數</td> 
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
	                      	<td align="center" width="100"><?php echo $data_arr[1] ?></td>
	                      	<td align="center" width="120"><?php echo $data_arr[2] ?></td>
	                      	<td align="left" width="200"><a href="review_info.php?schedule_no=<?php echo $data_arr[0]?>"><?php echo $data_arr[3] ?></a></td>
	                      	<td align="center" width="80"><?php echo $data_arr[4] ?></td>
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
