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
	$qa_no=0;
	$join_date=date("Y-m-d H:i:s");
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
	$sql =" insert into qa_effect values(";
	$sql.=" $qa_no,";
	$sql.=" '$join_date',";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL,";
	$sql.=" NULL)";	

	$sql_array[$cmd_count]=$sql;
	$cmd_count++;				
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result=DoTransaction($conn,$cmd_count,$sql_array);
	if ($result)
	{
		$sql =" select LAST_INSERT_ID()";
		$result = $conn->query($sql);
		$data_arr=$result->fetch();
		$qa_no=$data_arr[0];
		//--------------------------------------
		$idx=1;
	}
	else
	{		
		$msg="<font color='blue'>"."????????????"."</font>";
		$idx=0;	
	}
	//--------------------------------------
	$sql =" select a.area_code,a.name";
	$sql.=" from school_area a";
	$sql.=" order by a.area_code,a.name";

	$result1 = $conn->query($sql);
	$row_count1= $result1->rowCount();	
//--------------------------------------
//disconnect database
//--------------------------------------	
        DisconnectMysql($l_type,$conn);	
?>
<html>
<head>
<title>??????????????????</title>
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
	document.AP_CT.action="qa_effect_20.php";
	document.AP_CT.submit();
}

function chk_f14()
{
	if (document.AP_CT.f14.value=="4")
	{
		span_f14.innerHTML = '<input type="input" name="f144" size="20" class="inputs" maxlength="50">';
	}
	else
	{
		span_f14.innerHTML = '';
	}
}
function chk_f18()
{
	if (document.AP_CT.f18.value=="1")
	{
		span_f19.innerHTML = '			                        <select name="f19"> \
							<option value="1">????????????1????????????</option> \
							<option value="2">????????????2~3???</option> \
							<option value="3">????????????4~5???</option> \
						</select>';
	}
	else
	{
		span_f19.innerHTML = '';
	}

	if (document.AP_CT.f18.value=="6")
	{
		span_f18.innerHTML = '<input type="input" name="f186" size="20" class="inputs" maxlength="50">';
	}
	else
	{
		span_f18.innerHTML = '';
	}
}
function chk_f1A()
{
	if (document.AP_CT.f1A.value=="1")
	{
		span_f1B.innerHTML = '			                        <select name="f1B"> \
							<option value="1">????????????1????????????</option> \
							<option value="2">????????????2~3???</option> \
							<option value="3">????????????4~5???</option> \
						</select>';
	}
	else
	{
		span_f1B.innerHTML = '';
	}

	if (document.AP_CT.f1A.value=="6")
	{
		span_f1A.innerHTML = '<input type="input" name="f1A6" size="20" class="inputs" maxlength="50">';
	}
	else
	{
		span_f1A.innerHTML = '';
	}
}

</script>
<!-----javascript code E----->
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('btn/btn01_over.gif','btn/btn02_over.gif','btn/btn03_over.gif','btn/btn04_over.gif','btn/btn05_over.gif','btn/btn06_over.gif')">
<form name="AP_CT" action="" method="post" onsubmit="return form_action()">
<input name="qa_no" type="hidden" value="<?php echo $data_arr[0] ?>">
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
                      <td><img src="btn/peo-b01.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><A href="qa_effect_start.php"><img border="0" src="btn/peo-b02.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-b03.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><img src="btn/peo-b04.gif" width="181" height="24"></td>
                    </tr>
                    <tr> 
                      <td><A href="qa2_list.php"><img border="0" src="btn/peo-b05.gif" width="181" height="25"></a></td>
                    </tr>
                    <tr> 
                      <td><a href="people03.htm"><img src="btn/people03.gif" width="181" height="30" border="0"></a></td>
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
                      <td><b><font color="#CC6600">?????????????????????????????????</font></b></td>
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
                              <!-- ???????????? s-->
                              <font color='white'>??????????????????</font>
                              <!-- ???????????? e-->
                            </td>
                          </tr>
                          <tr> 
                            <td height="30">
                              <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign="top" align="center">
                                          <BR>					  
<?php if ($idx==1) { ?>
					  <!--????????????????????????????????? start(idx==1) -->					  
					  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">                                              
					    <tr>
			                      <td class="tdHeads" width="250">?????????</td>
			                      <td class="tdHeads2">
			                        <select name="f11">
							<option value="1">???</option>
							<option value="2">???</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">?????????</td>
			                      <td class="tdHeads2">
			                        <input type="input" name="f12" size="3" class="inputs" maxlength="3" onblur="check_num(this)">
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">???????????????</td>
			                      <td class="tdHeads2">
			                        <select name="f13">
							<option value="1">?????????????????????</option>
							<option value="2">???????????????</option>
							<option value="3">?????????????????????</option>
							<option value="4">?????????????????????</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">????????????????????????</td>
			                      <td class="tdHeads2">
			                        <select name="f14" onChange="chk_f14()">
							<option value="1">??????</option>
							<option value="2">?????????</option>
							<option value="3">??????</option>
							<option value="4">??????</option>
						</select>
						<span id="span_f14"></span>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">?????????-????????????</td>
			                      <td class="tdHeads2">
			                        <select name="f151">
					    <?php
					    for($i=0;$i<$row_count1;$i++)
					    {	
					    	$data_arr1=$result1->fetch();	
					    ?>
							<option value="<?php echo $data_arr1[0] ?>" <?php echo ($area_code=="$data_arr1[0]")?"selected":"" ?>><?php echo $data_arr1[1] ?></option>
					    <?php
					    }
					    ?>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">?????????-????????????</td>
			                      <td class="tdHeads2">
			                        <input type="input" name="f153" size="10" class="inputs" maxlength="10">
			                        <select name="f152">
							<option value="1">???</option>
							<option value="2">???</option>
							<option value="3">???</option>
							<option value="4">???</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">???????????????????????????????????????????????????????????????</td>
			                      <td class="tdHeads2">
			                        <select name="f16">
							<option value="1">???</option>
							<option value="2">???</option>
						</select>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">???????????????????????????????????????????????????????????????</td>
			                      <td class="tdHeads2">
			                        <input type="input" name="f17" size="3" class="inputs" maxlength="3" onblur="check_num(this)">??????
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">????????????????????????????????????????????????</td>
			                      <td class="tdHeads2">
			                        <select name="f18" onChange="chk_f18()">
							<option value="1">??????</option>
							<option value="2">?????????</option>
							<option value="3">????????????????????????????????????</option>
							<option value="4">????????????????????????</option>
							<option value="5">???????????????</option>
							<option value="6">??????</option>
						</select>
						<span id="span_f18"></span>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">??????????????????????????????????????????</td>
			                      <td class="tdHeads2">
			                      <span id="span_f19"></span>
			                      </td>
					    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">????????????????????????????????????????????????</td>
			                      <td class="tdHeads2">
			                        <select name="f1A" onChange="chk_f1A()">
							<option value="1">??????</option>
							<option value="2">?????????</option>
							<option value="3">????????????????????????????????????</option>
							<option value="4">????????????????????????</option>
							<option value="5">???????????????</option>
							<option value="6">??????</option>
						</select>
						<span id="span_f1A"></span>
			                      </td>
			                    </tr>
					    <tr>
			                      <td class="tdHeads" width="250">????????????????????????????????????????????????</td>
			                      <td class="tdHeads2">
			                      <span id="span_f1B"></span>
			                      </td>
					    </tr>
			                  </table>  
			                  <!-- ?????????-->
			                  <table width="550" border="0" cellspacing="0" cellpadding="0" class="font-12" >
			                    <tr> 
			                      <td height="10">&nbsp;</td>
			                    </tr>			                    
			                    <tr> 
			                      <td align="center">
			                      	<input class="btns" type="submit" value="?????????">
			                        <input class="btns" type="reset" value="????????????">			                        
			                      </td>
			                    </tr>                                                                                             
			                  </table> 
			                  <!--????????????????????????????????? (idx==1) end-->
<?php } else { ?>
			                  <!--????????????-->
			                  <!--????????????????????????????????? start(idx==0) -->					  
					  <BR>
					  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">                                              
			                    <tr height="150">
			                      <td class="tdHeads" width="150">???????????????</td>
			                      <td class="tdHeads2">  
			                       <center><?php echo $msg; ?></center>
			                      </td>
			                    </tr>                     			                    
			                  </table>  
			                  <!--????????????????????????????????? (idx==0) end-->
<?php } ?>    
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
