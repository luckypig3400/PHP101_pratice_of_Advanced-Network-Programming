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
	$news_no=(isset ($_GET['news_no'])) ? $_GET['news_no'] : "";
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
	$sql =" select count(*) from news_info";
	$sql.=" where news_no='$news_no'";	
	$sql.=" and type='3'";
	
	if(TestDuplicate($conn,$sql))
	{
		//--------------------------------------	
		$sql =" select a.issue_date,a.type,a.subject,a.pic_no,b.title,";
		$sql.="	b.path,a.content";
		$sql.=" from news_info a, pic_info b";
		$sql.=" where a.news_no='$news_no'";
		$sql.=" and a.pic_no=b.pic_no";
		$sql.=" and a.type='3'";

		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此最新消息不存在-ERROR"."</font>";
		$idx=0;
	}
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
          <td valign="top"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td> 
                  <table width="596" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><b><font color="#CC6600">健康新聞</font></b></td>
                    </tr>
                    <tr> 
                      <td><img src="images/_spacer.gif" width="25" height="5"></td>
                    </tr>
                  </table>
                  <table width="596" border="0" cellspacing="0" cellpadding="0" align="center" background="images/form-back.gif">
                    <tr> 
                      <td height="125" valign="top" background="images/form-bottom.gif" class="set-bgbottom"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td background="images/form-top.gif" height="53" class="set-bgtop" valign="top">
                              <div align="center">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td><img src="images/_spacer.gif" width="25" height="8"></td>
                                  </tr>
                                </table>
                              </div>
                            </td>
                          </tr>
                          <tr> 
                            <td height="30">
<?php if ($idx==1) { ?>
                              <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign="top">
					  <!--新聞內容 start-->
					  <table width="570" border="0" cellspacing="0" cellpadding="0" class="font-12" >
			                    <!--發表日期&新聞主旨s-->
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>
			                    <tr> 
			                      <td height="25" align="left">
			                       <font color="#5E5E5E">[<?php echo $data_arr[0]?>]<img src="images/_a01.gif" width="28" height="10" align="absmiddle"></font>
			                       <font color="#006699"><?php echo $data_arr[2]?></font></td>
			                    </tr>			                    
			                    <!--新聞照片 PS:若沒有則不顯示-->
					<?php if ($data_arr[3]!=0) { ?>
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      <img src="news/<?php echo $data_arr[5]?>" alt="<?php echo $data_arr[4]?>" border="1" width="352" height="240">
			                      </td>
			                    </tr>
					<?php } ?>
			                    <!--新聞內容-->
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="left">
			                      <?php echo nl2br($data_arr[6])?>
			                      </td>
			                    </tr>	
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      <input class="btns" type="button" value="回上一頁" onclick="history.go(-1)">	
			                      </td>
			                    </tr>	                    		                    
			                  </table>                                                                                                 
			                  <!--新聞內容 end-->
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
                            <td height="60">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
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
