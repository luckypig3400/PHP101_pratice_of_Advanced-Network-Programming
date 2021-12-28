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
	$ck_school_no=(isset ($_COOKIE['ck_school_no'])) ? $_COOKIE['ck_school_no'] : "";

	$evaluate_no=0;	
	$school_no=$ck_school_no;
	$total_students=(isset ($_POST['total_students'])) ? $_POST['total_students'] : "";
	$sign_position=(isset ($_POST['sign_position'])) ? $_POST['sign_position'] : "";
	$note_position=(isset ($_POST['note_position'])) ? $_POST['note_position'] : "";
	$when_response=(isset ($_POST['when_response'])) ? $_POST['when_response'] : "";
	$first_day=(isset ($_POST['first_day'])) ? $_POST['first_day'] : "";
	$f111=(isset ($_POST['f111'])) ? $_POST['f111'] : "";
	$f112=(isset ($_POST['f112'])) ? $_POST['f112'] : "";
	$f121=(isset ($_POST['f121'])) ? $_POST['f121'] : "";
	$f122=(isset ($_POST['f122'])) ? $_POST['f122'] : "";
	$f131=(isset ($_POST['f131'])) ? $_POST['f131'] : "";
	$f132=(isset ($_POST['f132'])) ? $_POST['f132'] : "";
	$f141=(isset ($_POST['f141'])) ? $_POST['f141'] : "";
	$f142=(isset ($_POST['f142'])) ? $_POST['f142'] : "";
	$f151=(isset ($_POST['f151'])) ? $_POST['f151'] : "";
	$f152=(isset ($_POST['f152'])) ? $_POST['f152'] : "";
	$f161=(isset ($_POST['f161'])) ? $_POST['f161'] : "";
	$f162=(isset ($_POST['f162'])) ? $_POST['f162'] : "";
	$first_day=(isset ($_POST['second_day'])) ? $_POST['second_day'] : "";
	$f211=(isset ($_POST['f211'])) ? $_POST['f211'] : "";
	$f212=(isset ($_POST['f212'])) ? $_POST['f212'] : "";
	$f221=(isset ($_POST['f221'])) ? $_POST['f221'] : "";
	$f222=(isset ($_POST['f222'])) ? $_POST['f222'] : "";
	$f231=(isset ($_POST['f231'])) ? $_POST['f231'] : "";
	$f232=(isset ($_POST['f232'])) ? $_POST['f232'] : "";
	$f241=(isset ($_POST['f241'])) ? $_POST['f241'] : "";
	$f242=(isset ($_POST['f242'])) ? $_POST['f242'] : "";
	$f251=(isset ($_POST['f251'])) ? $_POST['f251'] : "";
	$f252=(isset ($_POST['f252'])) ? $_POST['f252'] : "";
	$f261=(isset ($_POST['f261'])) ? $_POST['f261'] : "";
	$f262=(isset ($_POST['f262'])) ? $_POST['f262'] : "";
	$first_day=(isset ($_POST['third_day'])) ? $_POST['third_day'] : "";
	$f311=(isset ($_POST['f311'])) ? $_POST['f311'] : "";
	$f312=(isset ($_POST['f312'])) ? $_POST['f312'] : "";
	$f321=(isset ($_POST['f321'])) ? $_POST['f321'] : "";
	$f322=(isset ($_POST['f322'])) ? $_POST['f322'] : "";
	$f331=(isset ($_POST['f331'])) ? $_POST['f331'] : "";
	$f332=(isset ($_POST['f332'])) ? $_POST['f332'] : "";
	$f341=(isset ($_POST['f341'])) ? $_POST['f341'] : "";
	$f342=(isset ($_POST['f342'])) ? $_POST['f342'] : "";
	$f351=(isset ($_POST['f351'])) ? $_POST['f351'] : "";
	$f352=(isset ($_POST['f352'])) ? $_POST['f352'] : "";
	$f361=(isset ($_POST['f361'])) ? $_POST['f361'] : "";
	$f362=(isset ($_POST['f362'])) ? $_POST['f362'] : "";
	$join_id=$ck_user_no;
	$join_date=date("Y-m-d H:i:s");	
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
	if ($ck_user_no=="" || $ck_group!="2" || $ck_school_no=="")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	//--------------------------------------
	$sql =" insert into evaluate_car values(";
	$sql.=" $evaluate_no,";
	$sql.=" '$school_no',";
	$sql.=" '$total_students',";
	$sql.=" '$sign_position',";
	$sql.=" '$note_position',";
	$sql.=" '$when_response',";
	$sql.=" '$first_day',";
	$sql.=" '$f111',";
	$sql.=" '$f112',";
	$sql.=" '$f121',";
	$sql.=" '$f122',";
	$sql.=" '$f131',";
	$sql.=" '$f132',";
	$sql.=" '$f141',";
	$sql.=" '$f142',";
	$sql.=" '$f151',";
	$sql.=" '$f152',";
	$sql.=" '$f161',";
	$sql.=" '$f162',";
	$sql.=" '$second_day',";
	$sql.=" '$f211',";
	$sql.=" '$f212',";
	$sql.=" '$f221',";
	$sql.=" '$f222',";
	$sql.=" '$f231',";
	$sql.=" '$f232',";
	$sql.=" '$f241',";
	$sql.=" '$f242',";
	$sql.=" '$f251',";
	$sql.=" '$f252',";
	$sql.=" '$f261',";
	$sql.=" '$f262',";
	$sql.=" '$third_day',";
	$sql.=" '$f311',";
	$sql.=" '$f312',";
	$sql.=" '$f321',";
	$sql.=" '$f322',";
	$sql.=" '$f331',";
	$sql.=" '$f332',";
	$sql.=" '$f341',";
	$sql.=" '$f342',";
	$sql.=" '$f351',";
	$sql.=" '$f352',";
	$sql.=" '$f361',";
	$sql.=" '$f362',";
	$sql.=" '$join_id',";
	$sql.=" '$join_date')";

	$sql_array[$cmd_count]=$sql;
	$cmd_count++;				
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result=DoTransaction($conn,$cmd_count,$sql_array);
	if ($result)
	{
		$msg="<font color='blue'>"."新增車流量統計-OK"."</font>";			
	}
	else
	{		
		$msg="<font color='red'>"."新增車流量統計-ERROR"."</font>";
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
<script language="javascript" src="walk_header2.js"></script>
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
            <script language="javascript" src="walk_left2.js"></script>
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
                      <td width="93%"><b><font color="#FFFFFF">效益評估-新增車流量統計</font></b></td>
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
