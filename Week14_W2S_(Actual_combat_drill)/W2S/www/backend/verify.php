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
//	$http_arr=split('[/\]',getenv("HTTP_REFERER"));//for checking right path
	$http_arr=explode('/',getenv("HTTP_REFERER"));	//for checking right path
	$l_referer	=$http_arr[(count($http_arr)-1)];      
	$id=(isset ($_POST['id'])) ? $_POST['id'] : "";
	$passwd=(isset ($_POST['passwd'])) ? $_POST['passwd'] : "";	
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
	if ($l_referer!="login.php")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: /");
	}
		
	$sql =" select count(*) from user_info";
	$sql.=" where id='$id'";
	$sql.=" and passwd='$passwd'";
	
	if(TestDuplicate($conn,$sql))
	{
		$sql =" select user_no,`group`,school_no from user_info";
		$sql.=" where id='$id'";
		$sql.=" and passwd='$passwd'";

		$result = $conn->query($sql);
		$data_arr=$result->fetch();
		
		setcookie("ck_user_no",$data_arr[0],time()+86400,"/");
		setcookie("ck_group",$data_arr[1],time()+86400,"/");
		if ($data_arr[1]=="2")
		{
			setcookie("ck_school_no",$data_arr[2],time()+86400,"/");
		}
		
		$idx=1;
		if ($data_arr[1]=="1")
		{
			header("Location: ../user_list.php");
		}
		else if ($data_arr[1]=="2")
		{
			header("Location: ../seed_list.php");
		}
		else if ($data_arr[1]=="3")
		{
			header("Location: ../schedule_list.php");
		}
		else if ($data_arr[1]=="4")
		{
			header("Location: ../.php");
		}
	}
	else
	{
		setcookie("ck_user_no","",time()-86400,"/");
		setcookie("ck_group","",time()-86400,"/");
		
		$idx=0;
		$msg="使用者不存在或密碼錯誤";
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
                      <td width="93%"><b><font color="#FFFFFF">使用者-系統登入</font></b></td>
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
</body>
</html>
