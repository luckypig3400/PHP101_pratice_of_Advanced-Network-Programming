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
	$seed_no=(isset ($_GET['seed_no'])) ? $_GET['seed_no'] : "";
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
	$sql =" select a.school_no,b.name,c.name";
	$sql.=" from seed_info a, school_area b, school_info c";
	$sql.=" where a.school_no=c.school_no";
	$sql.=" and a.seed_no='$seed_no'";
	$sql.=" and b.area_code=c.area_code";

	$result = $conn->query($sql);
	$data_arr=$result->fetch();	
	//--------------------------------------					
	$sql =" select a.seed_no,a.issue_date,a.subject,a.pic_no,b.title,";
	$sql.=" b.path,a.content";
	$sql.=" from seed_info a, pic_info b";
	$sql.=" where a.seed_no='$seed_no'";
	$sql.=" and a.pic_no=b.pic_no";

	$result1 = $conn->query($sql);
    	$data_arr1=$result1->fetch();	
	//--------------------------------------
	if ($data_arr1)
	{
		$idx=1;
	}
	else
	{
		$msg="<font color='red'>"."此示範成果不存在-ERROR"."</font>";
		$idx=0;
	}
	//--------------------------------------
	$sql =" select count(*)";
	$sql.=" from seed_pic a";
	$sql.=" where a.seed_no='$seed_no'";

	$result2 = $conn->query($sql);
   	$data_arr2=$result2->fetch();
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
<!-----javascript code E----->
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
                      <td><a href="people01.htm"><img src="btn/people01.gif" width="181" height="30" border="0"></a></td>
                    </tr>
                    <tr> 
                      <td><a href="people02.htm"><img src="btn/people02.gif" width="181" height="30" border="0"></a></td>
                    </tr>
                    <tr> 
                      <td><a href="people03.htm"><img src="btn/people03.gif" width="181" height="30" border="0"></a></td>
                    </tr>
                    <tr> 
                      <td><A href="qa_school_start.php"><img border="0" src="btn/peo-c01.gif" width="181" height="24"></a></td>
                    </tr>
                    <tr> 
                      <td><A href="qa_school_start.php"><img border="0" src="btn/peo-c02.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-c03.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-c04.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><A href="qa3_list.php"><img border="0" src="btn/peo-b05.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><A href="apply_new.php"><img border="0" src="btn/peo-c06.gif" width="181" height="24"></a></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
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
          <td><img src="images/title-people.gif" width="657" height="71"></td>
        </tr>
        <tr> 
          <td valign="top"> 
<?php if ($idx==1) { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td> 
                  <!-- 示範成果展列表 s-->
                  <table width="605" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><b><font color="#CC6600">示範成果展-[<?php echo $data_arr[1] ?>]-<?php echo $data_arr[2] ?></font></b></td>
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
                            <td background="images/form-top.gif" height="53" class="set-bgtop" valign="middle" align="center">
                              <div align="center">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td><img src="images/_spacer.gif" width="25" height="8"></td>
                                  </tr>
                                </table>
                              </div>
                              <!-- 示範成果展大綱 s-->
                              <font color='white'>示範成果展資訊</font>
                              <!-- 示範成果展 e-->
                            </td>
                          </tr>
                          <tr> 
                            <td height="30">
                              <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign="top">
					  <!--示範成果展內容 start-->
					  <table width="570" border="0" cellspacing="0" cellpadding="0" class="font-12" >
			                    <!--發表日期&示範成果展主旨s-->
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>
			                    <tr> 
			                      <td height="25" align="left">
			                       <font color="#5E5E5E">[<?php echo $data_arr1[1]?>]</font>
			                       <font color="#006699"><?php echo $data_arr1[2]?></font></td>
			                    </tr>			                    
			                    <!--示範成果展照片 PS:若沒有則不顯示-->
					<?php if ($data_arr1[3]!=0) { ?>
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      <img src="seed/<?php echo $data_arr1[5]?>" alt="<?php echo $data_arr1[4]?>" border="1" width="352" height="240">
			                      </td>
			                    </tr>
					<?php } ?>
			                    <!--示範成果展內容-->
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="left">
			                      <?php echo $data_arr1[6]?>
			                      </td>
			                    </tr>	
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      <!-- 若有相關活動相簿，擇顯示[活動相簿]功能鈕 -->
					<?php if ($data_arr2[0]>0) { ?>

			                      <input class="btns" type="button" value="觀賞活動相簿" onclick="location.href='seeder_album.php?seed_no=<?php echo $seed_no ?>'">
					<?php } ?>
			                      <input class="btns" type="button" value="回上一頁" onclick="history.go(-1)">	
			                      </td>
			                    </tr>	                    		                    
			                  </table>                                                                                                 
			                  <!--示範成果展內容 end-->
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr> 
                            <td height="60">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <!-- 示範成果展列表 e-->
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
