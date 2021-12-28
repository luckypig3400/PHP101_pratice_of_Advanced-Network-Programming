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
	$sql =" select a.news_no,a.issue_date,a.subject";
	$sql.=" from news_info a";
	$sql.=" where a.type='1'"; 
	$sql.=" order by a.issue_date desc";

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
<title>走路上學計劃</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-----CSS include S----->
<link href="table.css" rel="stylesheet" type="text/css" />
<link href="_set.css" rel="stylesheet" type="text/css" />
<!-----CSS include E----->
<!-----javascript code S----->
<script language="javascript" src="walk_function.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('btn/btn01_over.gif','btn/btn02_over.gif','btn/btn03_over.gif','btn/btn04_over.gif','btn/btn05_over.gif','btn/btn06_over.gif')">
<!-- header start -->
<script language="javascript" src="walk_header.js"></script>
<!-- header end -->
<table width="860" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top"> 
    <td width="276"> 
      <table width="32%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="4%" valign="top"><img src="images/block01-top01.gif" width="65" height="89"></td>
          <td width="48%" valign="top"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/block01-back.gif">
              <tr>
                <td><img src="images/block01-top02.gif" width="183" height="89"></td>
              </tr>
              <tr>
                <td>
                  <table width="181" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td><A href="news1_list.php"><img border="0" src="btn/news01.gif" width="181" height="30"></A></td>
                    </tr>
                    <tr>
                      <td><A href="news2_list.php"><img border="0" src="btn/news02.gif" width="181" height="30"></A></td>
                    </tr>
                    <tr>
                      <td><A href="news3_list.php"><img border="0" src="btn/news03.gif" width="181" height="30"></A></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td><img src="images/block01-bottom.gif" width="183" height="12"></td>
              </tr>
            </table>
<!-- banner -->
<script language="javascript" src="walk_banner.js"></script>
<!-- banner -->
          </td>
          <td width="48%" valign="top"><img src="images/_spacer.gif" width="30" height="25"></td>
        </tr>
      </table>
    </td>
    <td width="584"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/page-right-back.gif">
        <tr> 
          <td><img src="images/title-news.gif" width="657" height="71"></td>
        </tr>
        <tr> 
          <td>
<?php if ($idx==1) { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td> 
                  <!-- 最新消息列表 s-->
                  <table width="605" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><b><font color="#CC6600">網站公告</font></b></td>
                    </tr>
                    <tr> 
                      <td><img src="images/_spacer.gif" width="25" height="5"></td>
                    </tr>
                  </table>
                  <table width="605" border="0" cellspacing="0" cellpadding="0" class="font-12" align="center">
		    <?php
		    for($i=0;$i<$row_count;$i++)
		    {
		    	$data_arr=$result->fetch();
		    ?>
                    <tr> 
                      <td height="25"><img src="images/_point01.gif" width="25" height="13" align="absmiddle">
                       <font color="#5E5E5E">[<?php echo $data_arr[1] ?>]<img src="images/_a01.gif" width="28" height="10" align="absmiddle"></font>
                       <font color="#006699"><A href="news1_info.php?news_no=<?php echo $data_arr[0]?>"><?php echo $data_arr[2]?></A></font></td>
                    </tr>
                    <tr> 
                      <td><img src="images/_line01.gif" width="605" height="7"></td>
                    </tr>                    
		    <?php
		    }
		    ?>
                  </table>
                  <!-- 最新消息列表 e-->
                </td>
              </tr>
            </table>
<?php } else { ?>
<!-- ERROR MSG S-->
			  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">
	                    <tr height="150">
	                      <td class="tdHeads" width="150">系統訊息：</td>
	                      <td class="tdHeads2">  
	                       <center><?php echo $msg; ?></center>
	                      </td>
	                    </tr>
	                  </table>
<!-- ERROR MSG E-->
<?php } ?>
          </td>
        </tr>
        <tr>
          <td height="30">&nbsp;</td>
        </tr>
        <tr> 
          <td><img src="images/page-right-bottom.gif" width="657" height="34"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- footer -->
<script language="javascript" src="walk_footer.js"></script>
<!-- footer -->
</body>
</html>
<script language="javascript">
show_banner(1);
show_banner(2);
</script>
