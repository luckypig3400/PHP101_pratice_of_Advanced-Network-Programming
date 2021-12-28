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
	
	$schedule_no=(isset ($_POST['schedule_no'])) ? $_POST['schedule_no'] : "";
	$status=(isset ($_POST['status'])) ? $_POST['status'] : "";
	$f01=(isset ($_POST['f01'])) ? $_POST['f01'] : "";
	$f02=(isset ($_POST['f02'])) ? $_POST['f02'] : "";
	$f03=(isset ($_POST['f03'])) ? $_POST['f03'] : "";
	$f04=(isset ($_POST['f04'])) ? $_POST['f04'] : "";
	$f05=(isset ($_POST['f05'])) ? $_POST['f05'] : "";
	$f06=(isset ($_POST['f06'])) ? $_POST['f06'] : "";
	$f111=(isset ($_POST['f111'])) ? $_POST['f111'] : "";
	$f112=(isset ($_POST['f112'])) ? $_POST['f112'] : "";
	$f113=(isset ($_POST['f113'])) ? $_POST['f113'] : "";
	$f114=(isset ($_POST['f114'])) ? $_POST['f114'] : "";
	$f115=(isset ($_POST['f115'])) ? $_POST['f115'] : "";
	$f121=(isset ($_POST['f121'])) ? $_POST['f121'] : "";
	$f122=(isset ($_POST['f122'])) ? $_POST['f122'] : "";
	$f123=(isset ($_POST['f123'])) ? $_POST['f123'] : "";
	$f124=(isset ($_POST['f124'])) ? $_POST['f124'] : "";
	$f125=(isset ($_POST['f125'])) ? $_POST['f125'] : "";
	$f126=(isset ($_POST['f126'])) ? $_POST['f126'] : "";
	$f13=(isset ($_POST['f13'])) ? $_POST['f13'] : "";
	$f14=(isset ($_POST['f14'])) ? $_POST['f14'] : "";
	$f15=(isset ($_POST['f15'])) ? $_POST['f15'] : "";
	$f16=(isset ($_POST['f16'])) ? $_POST['f16'] : "";
	$f211=(isset ($_POST['f211'])) ? $_POST['f211'] : "";
	$f212=(isset ($_POST['f212'])) ? $_POST['f212'] : "";
	$f213=(isset ($_POST['f213'])) ? $_POST['f213'] : "";
	$f214=(isset ($_POST['f214'])) ? $_POST['f214'] : "";
	$f215=(isset ($_POST['f215'])) ? $_POST['f215'] : "";
	$f221=(isset ($_POST['f221'])) ? $_POST['f221'] : "";
	$f222=(isset ($_POST['f222'])) ? $_POST['f222'] : "";
	$f223=(isset ($_POST['f223'])) ? $_POST['f223'] : "";
	$f224=(isset ($_POST['f224'])) ? $_POST['f224'] : "";
	$f225=(isset ($_POST['f225'])) ? $_POST['f225'] : "";
	$f23=(isset ($_POST['f23'])) ? $_POST['f23'] : "";
	$f24=(isset ($_POST['f24'])) ? $_POST['f24'] : "";
	$f25=(isset ($_POST['f25'])) ? $_POST['f25'] : "";
	$f26=(isset ($_POST['f26'])) ? $_POST['f26'] : "";
	$f311=(isset ($_POST['f311'])) ? $_POST['f311'] : "";
	$f312=(isset ($_POST['f312'])) ? $_POST['f312'] : "";
	$f313=(isset ($_POST['f313'])) ? $_POST['f313'] : "";
	$f314=(isset ($_POST['f314'])) ? $_POST['f314'] : "";
	$f321=(isset ($_POST['f321'])) ? $_POST['f321'] : "";
	$f322=(isset ($_POST['f322'])) ? $_POST['f322'] : "";
	$f323=(isset ($_POST['f323'])) ? $_POST['f323'] : "";
	$f324=(isset ($_POST['f324'])) ? $_POST['f324'] : "";
	$f325=(isset ($_POST['f325'])) ? $_POST['f325'] : "";
	$f326=(isset ($_POST['f326'])) ? $_POST['f326'] : "";
	$f327=(isset ($_POST['f327'])) ? $_POST['f327'] : "";
	$f33=(isset ($_POST['f33'])) ? $_POST['f33'] : "";
	$f34=(isset ($_POST['f34'])) ? $_POST['f34'] : "";
	$f35=(isset ($_POST['f35'])) ? $_POST['f35'] : "";
	$f36=(isset ($_POST['f36'])) ? $_POST['f36'] : "";
	$f411=(isset ($_POST['f411'])) ? $_POST['f411'] : "";
	$f412=(isset ($_POST['f412'])) ? $_POST['f412'] : "";
	$f413=(isset ($_POST['f413'])) ? $_POST['f413'] : "";
	$f414=(isset ($_POST['f414'])) ? $_POST['f414'] : "";
	$f421=(isset ($_POST['f421'])) ? $_POST['f421'] : "";
	$f422=(isset ($_POST['f422'])) ? $_POST['f422'] : "";
	$f43=(isset ($_POST['f43'])) ? $_POST['f43'] : "";
	$f44=(isset ($_POST['f44'])) ? $_POST['f44'] : "";
	$f45=(isset ($_POST['f45'])) ? $_POST['f45'] : "";
	$f46=(isset ($_POST['f46'])) ? $_POST['f46'] : "";
	$f511=(isset ($_POST['f511'])) ? $_POST['f511'] : "";
	$f521=(isset ($_POST['f521'])) ? $_POST['f521'] : "";
	$f522=(isset ($_POST['f522'])) ? $_POST['f522'] : "";
	$f523=(isset ($_POST['f523'])) ? $_POST['f523'] : "";
	$f53=(isset ($_POST['f53'])) ? $_POST['f53'] : "";
	$f54=(isset ($_POST['f54'])) ? $_POST['f54'] : "";
	$f55=(isset ($_POST['f55'])) ? $_POST['f55'] : "";
	$f56=(isset ($_POST['f56'])) ? $_POST['f56'] : "";
	$f61=(isset ($_POST['f61'])) ? $_POST['f61'] : "";
	$modify_date=date("Y-m-d H:i:s");	
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
	if ($ck_user_no=="" || $ck_group!="3")
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
		if ($status=="C")
		{
			//--------------------------------------
			$sql =" update comment_schedule set";
			$sql.=" status='4'";
			$sql.=" where schedule_no='$schedule_no'";
			$sql.=" and join_id='$ck_user_no'";
			
			$sql_array[$cmd_count]=$sql;
			$cmd_count++;	
			//-------------------------------
			//execute the Transaction
			//-------------------------------	
			$result=DoTransaction($conn,$cmd_count,$sql_array);
			if ($result)
			{
				$msg="<font color='blue'>"."結案訪視紀錄-OK"."</font>";
			}
			else
			{		
				$msg="<font color='red'>"."結案訪視紀錄-ERROR"."</font>";
			}				
		}
		//--------------------------------------	
		$sql =" update comment_info set";
		$sql.=" f01='$f01',";
		$sql.=" f02='$f02',";
		$sql.=" f03='$f03',";
		$sql.=" f04='$f04',";
		$sql.=" f05='$f05',";
		$sql.=" f06='$f06',";
		$sql.=" f111='$f111',";
		$sql.=" f112='$f112',";
		$sql.=" f113='$f113',";
		$sql.=" f114='$f114',";
		$sql.=" f115='$f115',";
		$sql.=" f121='$f121',";
		$sql.=" f122='$f122',";
		$sql.=" f123='$f123',";
		$sql.=" f124='$f124',";
		$sql.=" f125='$f125',";
		$sql.=" f126='$f126',";
		$sql.=" f13='$f13',";
		$sql.=" f14='$f14',";
		$sql.=" f15='$f15',";
		$sql.=" f16='$f16',";
		$sql.=" f211='$f211',";
		$sql.=" f212='$f212',";
		$sql.=" f213='$f213',";
		$sql.=" f214='$f214',";
		$sql.=" f215='$f215',";
		$sql.=" f221='$f221',";
		$sql.=" f222='$f222',";
		$sql.=" f223='$f223',";
		$sql.=" f224='$f224',";
		$sql.=" f225='$f225',";
		$sql.=" f23='$f23',";
		$sql.=" f24='$f24',";
		$sql.=" f25='$f25',";
		$sql.=" f26='$f26',";
		$sql.=" f311='$f311',";
		$sql.=" f312='$f312',";
		$sql.=" f313='$f313',";
		$sql.=" f314='$f314',";
		$sql.=" f321='$f321',";
		$sql.=" f322='$f322',";
		$sql.=" f323='$f323',";
		$sql.=" f324='$f324',";
		$sql.=" f325='$f325',";
		$sql.=" f326='$f326',";
		$sql.=" f327='$f327',";
		$sql.=" f33='$f33',";
		$sql.=" f34='$f34',";
		$sql.=" f35='$f35',";
		$sql.=" f36='$f36',";
		$sql.=" f411='$f411',";
		$sql.=" f412='$f412',";
		$sql.=" f413='$f413',";
		$sql.=" f414='$f414',";
		$sql.=" f421='$f421',";
		$sql.=" f422='$f422',";
		$sql.=" f43='$f43',";
		$sql.=" f44='$f44',";
		$sql.=" f45='$f45',";
		$sql.=" f46='$f46',";
		$sql.=" f511='$f511',";
		$sql.=" f521='$f521',";
		$sql.=" f522='$f522',";
		$sql.=" f523='$f523',";
		$sql.=" f53='$f53',";
		$sql.=" f54='$f54',";
		$sql.=" f55='$f55',";
		$sql.=" f56='$f56',";
		$sql.=" f61='$f61',";
		$sql.=" modify_date='$modify_date'";
		$sql.=" where schedule_no='$schedule_no'";
		$sql.=" and join_id='$ck_user_no'";

		$sql_array[$cmd_count]=$sql;
		$cmd_count++;
		//-------------------------------
		//execute the Transaction
		//-------------------------------	
		$result=DoTransaction($conn,$cmd_count,$sql_array);
		if ($result)
		{
			if ($msg=="")
			{
				$msg="<font color='blue'>"."維護訪視紀錄-OK"."</font>";
			}
		}
		else
		{		
			$msg.="<font color='red'>"."維護訪視紀錄-ERROR"."</font>";
		}	
		//--------------------------------------
	}
	else
	{
		$msg="<font color='red'>"."此訪視紀錄不存在-ERROR"."</font>";
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
<!-----javascript code E----->
<body class="body_main">
<!-- header start -->
<script language="javascript" src="walk_header3.js"></script>
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
            <script language="javascript" src="walk_left3.js"></script>
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
                      <td width="93%"><b><font color="#FFFFFF">評核意見管理-維護評核意見</font></b></td>
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
<!-- work sheet start-->                      
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
<!-- work sheet end-->                       
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
</body>
</html>
