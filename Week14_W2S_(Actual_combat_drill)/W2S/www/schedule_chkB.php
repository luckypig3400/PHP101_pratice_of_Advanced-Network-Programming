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

	$area_code=(isset ($_POST['area_code'])) ? $_POST['area_code'] : "0";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0; 
	
	$type_name=array("1"=>"國小","2"=>"國中","3"=>"高中","4"=>"高職");            	               
//--------------------------------------
//processing
//--------------------------------------		
	if ($ck_user_no=="" || $ck_group!="3")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	$sql =" select a.school_no,b.name,a.name,a.type";
	$sql.=" from school_info a, school_area b";		
	$sql.=" where a.area_code=b.area_code";
  	if ($area_code!="0")
	{
		$sql.=" and a.area_code='$area_code'"; 
	}
	$sql.=" order by a.area_code,a.name";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();	
	//--------------------------------------
	$sql =" select a.area_code,a.name";
	$sql.=" from school_area a";
	$sql.=" order by a.area_code,a.name";

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
<script language="javascript">
function form_action(p_object)
{
	var l_array = p_object.value;
	var l_str ="";
	var l_sidx=0;
	var l_nidx=0;
	var i=0;
	var a=new Array(2);
		
	l_str=l_array;
	for(i=0;i<2;i++)
	{
		l_nidx=l_str.indexOf(":");
		a[i]=l_str.substring(l_sidx,l_nidx);
		
		l_str=l_str.substring(l_nidx+1,l_str.length);		
	}
		
 	window.returnValue=a
 	window.close()	
}

function change_area_code()
{
//	document.AP_CT.action="schedule_chk.php";
	document.AP_CT.submit();
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="" method="post">
<table width="740" border="0" cellspacing="0" cellpadding="0" class="set-bgtop" background="images/page-back.gif">
  <tr>       
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
                      <td width="93%"><b><font color="#FFFFFF">評核行程管理-輸入種子學校</font></b></td>
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
            <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
              	<td width="500" align="right"><font color='red'>切換縣市：</font></td>
                <td width="100" align="left">                	
                	<select name="area_code" onChange="change_area_code()">				
				<option value="0" <?php echo ($area_code=="0")?"selected":"" ?>>全部縣市</option>
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
                <td colspan="2" align="center">               
                  <table class="table_in" width="600" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
                      <td class="td_title" width="50">序號</td>
                      <td class="td_title" width="100">縣市別</td>
                      <td class="td_title" width="300">學校名稱</td>
                      <td class="td_title" width="100">學制</td>   
                      <td class="td_title" width="50">選擇</td>                                                                                    
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
	                      	<td align="left" width="300"><?php echo $data_arr[2] ?></td>
	                      	<td align="center" width="100"><?php echo $type_name[$data_arr[3]] ?></td>
	                      	<td align="center" width="50"><input type="radio" name="C1" value="<?php echo $data_arr[0] ?>:<?php echo $data_arr[1].$data_arr[2] ?>:" onclick=form_action(this)></td>	                      	                      		                      		                      	                      		                      		                      		                      	
	                    	</tr>   
		    <?php
		    }
		    ?>	
		     <tr>
                      <td class="td_title" colspan="5" >
                        <input class="btns" type="button" value="取消" onClick="window.close()">
                      </td>
                    </tr>
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
</form>
</body>
</html>
