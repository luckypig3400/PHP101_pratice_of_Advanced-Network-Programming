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
	$when_response=(isset ($_POST['when_response'])) ? $_POST['when_response'] : "";
	$sign_year=(isset ($_POST['sign_year'])) ? $_POST['sign_year'] : "";
	$sign_class=(isset ($_POST['sign_class'])) ? $_POST['sign_class'] : "";
	$sign_students=(isset ($_POST['sign_students'])) ? $_POST['sign_students'] : "";
	$sign_teacher=(isset ($_POST['sign_teacher'])) ? $_POST['sign_teacher'] : "";
	$first_day=(isset ($_POST['first_day'])) ? $_POST['first_day'] : "";
	$f11=(isset ($_POST['f11'])) ? $_POST['f11'] : "";
	$f12=(isset ($_POST['f12'])) ? $_POST['f12'] : "";
	$f131=(isset ($_POST['f131'])) ? $_POST['f131'] : "";
	$f132=(isset ($_POST['f132'])) ? $_POST['f132'] : "";
	$f133=(isset ($_POST['f133'])) ? $_POST['f133'] : "";
	$f134=(isset ($_POST['f134'])) ? $_POST['f134'] : "";
	$f14=(isset ($_POST['f14'])) ? $_POST['f14'] : "";
	$f15=(isset ($_POST['f15'])) ? $_POST['f15'] : "";
	$f161=(isset ($_POST['f161'])) ? $_POST['f161'] : "";
	$f162=(isset ($_POST['f162'])) ? $_POST['f162'] : "";
	$f171=(isset ($_POST['f171'])) ? $_POST['f171'] : "";
	$f172=(isset ($_POST['f172'])) ? $_POST['f172'] : "";
	$first_day=(isset ($_POST['second_day'])) ? $_POST['second_day'] : "";
	$f21=(isset ($_POST['f21'])) ? $_POST['f21'] : "";
	$f22=(isset ($_POST['f22'])) ? $_POST['f22'] : "";
	$f231=(isset ($_POST['f231'])) ? $_POST['f231'] : "";
	$f232=(isset ($_POST['f232'])) ? $_POST['f232'] : "";
	$f233=(isset ($_POST['f233'])) ? $_POST['f233'] : "";
	$f234=(isset ($_POST['f234'])) ? $_POST['f234'] : "";
	$f24=(isset ($_POST['f24'])) ? $_POST['f24'] : "";
	$f25=(isset ($_POST['f25'])) ? $_POST['f25'] : "";
	$f261=(isset ($_POST['f261'])) ? $_POST['f261'] : "";
	$f262=(isset ($_POST['f262'])) ? $_POST['f262'] : "";
	$f271=(isset ($_POST['f271'])) ? $_POST['f271'] : "";
	$f272=(isset ($_POST['f272'])) ? $_POST['f272'] : "";
	$first_day=(isset ($_POST['third_day'])) ? $_POST['third_day'] : "";
	$f31=(isset ($_POST['f31'])) ? $_POST['f31'] : "";
	$f32=(isset ($_POST['f32'])) ? $_POST['f32'] : "";
	$f331=(isset ($_POST['f331'])) ? $_POST['f331'] : "";
	$f332=(isset ($_POST['f332'])) ? $_POST['f332'] : "";
	$f333=(isset ($_POST['f333'])) ? $_POST['f333'] : "";
	$f334=(isset ($_POST['f334'])) ? $_POST['f334'] : "";
	$f34=(isset ($_POST['f34'])) ? $_POST['f34'] : "";
	$f35=(isset ($_POST['f35'])) ? $_POST['f35'] : "";
	$f361=(isset ($_POST['f361'])) ? $_POST['f361'] : "";
	$f362=(isset ($_POST['f362'])) ? $_POST['f362'] : "";
	$f371=(isset ($_POST['f371'])) ? $_POST['f371'] : "";
	$f372=(isset ($_POST['f372'])) ? $_POST['f372'] : "";
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
	$sql =" insert into evaluate_student values(";
	$sql.=" $evaluate_no,";
	$sql.=" '$school_no',";
	$sql.=" '$total_students',";
	$sql.=" '$when_response',";
	$sql.=" '$sign_year',";
	$sql.=" '$sign_class',";
	$sql.=" '$sign_students',";
	$sql.=" '$sign_teacher',";
	$sql.=" '$first_day',";
	$sql.=" '$f11',";
	$sql.=" '$f12',";
	$sql.=" '$f131',";
	$sql.=" '$f132',";
	$sql.=" '$f133',";
	$sql.=" '$f134',";
	$sql.=" '$f14',";
	$sql.=" '$f15',";
	$sql.=" '$f161',";
	$sql.=" '$f162',";
	$sql.=" '$f171',";
	$sql.=" '$f172',";
	$sql.=" '$second_day',";
	$sql.=" '$f21',";
	$sql.=" '$f22',";
	$sql.=" '$f231',";
	$sql.=" '$f232',";
	$sql.=" '$f233',";
	$sql.=" '$f234',";
	$sql.=" '$f24',";
	$sql.=" '$f25',";
	$sql.=" '$f261',";
	$sql.=" '$f262',";
	$sql.=" '$f271',";
	$sql.=" '$f272',";
	$sql.=" '$third_day',";
	$sql.=" '$f31',";
	$sql.=" '$f32',";
	$sql.=" '$f331',";
	$sql.=" '$f332',";
	$sql.=" '$f333',";
	$sql.=" '$f334',";
	$sql.=" '$f34',";
	$sql.=" '$f35',";
	$sql.=" '$f361',";
	$sql.=" '$f362',";
	$sql.=" '$f371',";
	$sql.=" '$f372',";
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
		$msg="<font color='blue'>"."新增學生上學方式統計-OK"."</font>";			
	}
	else
	{		
		$msg="<font color='red'>"."新增學生上學方式統計-ERROR"."</font>";
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
                      <td width="93%"><b><font color="#FFFFFF">效益評估-新增學生上學方式統計</font></b></td>
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
