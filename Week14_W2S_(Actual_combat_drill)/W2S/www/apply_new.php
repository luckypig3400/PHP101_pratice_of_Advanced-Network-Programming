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
	$seq="";            
//--------------------------------------
//processing
//--------------------------------------	
	$sql =" select a.area_code,a.name";
	$sql.=" from school_area a";
	$sql.=" order by a.area_code,a.name";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();	
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
<script language=javascript>
function form_action()
{
	if(document.AP_CT.area_code.value=="")
	{
		alert("請輸入：縣市別");
		return false;		
	}
	else if(document.AP_CT.school_name.value=="")
	{
		alert("請輸入：學校名稱");
		return false;		
	}
	else if(document.AP_CT.contact_name.value=="")
	{
		alert("請輸入：主要聯絡人");
		return false;		
	}
	else if(document.AP_CT.contact_tel.value=="")
	{
		alert("請輸入：電話");
		return false;		
	}
	else if(document.AP_CT.contact_fax.value=="")
	{
		alert("請輸入：傳真");
		return false;		
	}
	else if(document.AP_CT.contact_email.value=="")
	{
		alert("請輸入：電子郵件");
		return false;		
	}
	else
	{				
		answer = confirm("是否確定：送出申請表？");
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
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('btn/btn01_over.gif','btn/btn02_over.gif','btn/btn03_over.gif','btn/btn04_over.gif','btn/btn05_over.gif','btn/btn06_over.gif')">
<form name="AP_CT" action="apply_add.php" method="post" onsubmit="return form_action()">
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
                      <td><img src="btn/peo-c01.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-c02.gif" width="181" height="25"></td>
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td> 
                  <table width="596" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td><b><font color="#CC6600">我要報名</font></b></td>
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
                              <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign="top" align="center">
                                          <BR>
					  <!--我要報名 start-->
					  <!--資料欄位 start-->
					  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">                                              
			                    <tr>
			                      <td class="tdHeads" width="150"><font color='red'>＊</font>縣市別：</td>
			                      <td class="tdHeads2">  
						<select name="area_code">				
						<option value=""></option>
		    				<?php
		    				for($i=0;$i<$row_count;$i++)
		    				{	
		    					$data_arr=$result->fetch();	
		    				?>
						<option value="<?php echo $data_arr[0] ?>"><?php echo $data_arr[1] ?></option>
		    				<?php
		    				}
		    				?>
						</select>   
			                      </td>
			                    </tr>                     
					    <tr>
			                      <td class="tdHeads" width="150"><font color='red'>＊</font>學校名稱：</td>
			                      <td class="tdHeads2">
			                      <input type="input" name="school_name" size="20" class="inputs" maxlength="100">
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="150"><font color='red'>＊</font>主要聯絡人：</td>
			                      <td class="tdHeads2">
			                      <input type="input" name="contact_name" size="20" class="inputs" maxlength="10">
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="150"><font color='red'>＊</font>電話：</td>
			                      <td class="tdHeads2"><input type="input" name="contact_tel" size="20" class="inputs" maxlength="20" onblur=check_tel(this)>                      
			                      </td>
			                    </tr> 
					    <tr>
			                      <td class="tdHeads" width="150"><font color='red'>＊</font>傳真：</td>
			                      <td class="tdHeads2"><input type="input" name="contact_fax" size="20" class="inputs" maxlength="20" onblur=check_tel(this)>                      
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="150"><font color='red'>＊</font>電子郵件：</td>
			                      <td class="tdHeads2"><input type="input" name="contact_email" size="40" class="inputs" maxlength="20" onblur=check_mail(this)>                      
			                      </td>
			                    </tr>     
					    <tr>
			                      <td class="tdHeads" width="150">學校首頁或相關活動連結網址：</td>
			                      <td class="tdHeads2">
			                      <input type="input" name="apply_url" size="40" class="inputs" maxlength="100">
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="150">學校推動走路上學現況說明：</td>
			                      <td class="tdHeads2">
			                      <textarea name="apply_note" cols="40" rows="8"></textarea>
			                      </td>
			                    </tr>			                    
			                  </table>  
			                  <!-- 功能鍵-->
			                  <table width="550" border="0" cellspacing="0" cellpadding="0" class="font-12" >
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      	<input class="btns" type="submit" value="送出申請表">
			                        <input class="btns" type="reset" value="重新輸入">
			                      </td>
			                    </tr>                                                                                             
			                  </table> 
			                  <!--我要報名 end-->
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
