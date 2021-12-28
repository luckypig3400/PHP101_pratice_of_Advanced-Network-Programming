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
	$sql =" select a.pic_no,b.title";
	$sql.=" from seed_pic a, pic_info b";
	$sql.=" where a.seed_no='$seed_no'";
	$sql.=" and a.pic_no=b.pic_no";
	$sql.=" order by a.pic_no";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();

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
<script language=javascript>
function form_action()
{
	document.AP_CT.submit();
}
function form_remove()
{
	var objForm = document.forms["AP_CT"];
	var objLen = objForm.length;
	var SelectOne = 0;
	for (var i=0;i<objLen;i++)
	{
		if (objForm.elements[i].type=="checkbox" && objForm.elements[i].checked==true)
		{
			SelectOne = 1;
			break;
		}
	}
	if (SelectOne==0)
	{
		alert("請至少選擇一活動圖片");
		return false;		
	}
	else
	{				
		answer = confirm("是否確定：刪除活動圖片？");
		if (answer)
		{	
			document.AP_CT.target="pic_top";
			document.AP_CT.action="seed_album_update.php";
			document.AP_CT.submit();
			return true;
		}
		else
		{
			return false;	
		}
	}
}

function album_return()
{
	album_info = "<?php echo $row_count ?>";
	
	returnValue = album_info;
  	window.close();	
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="seed_album_new.php" method="post">
<input name="seed_no" type="hidden" value="<?php echo $seed_no ?>">
<!--<input name="totalpic" type="hidden" value="<?php echo $row_count ?>">--->
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
                      <td width="93%"><b><font color="#FFFFFF">相簿管理-上傳圖片列表</font></b></td>
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
            <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td colspan="2" align="left">
                <input class="btns" type="button" value="新增活動圖片" onClick="form_action()">
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="400" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
                      <td class="td_title" width="50">序號</td>
                      <td class="td_title" width="300">圖片標題</td>
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
<!--	                      	<td align="left" width="300"><a href="seed_album_info.php?pic_no=<?php echo $data_arr[0]?>" target="_blank"><?php echo $data_arr[1] ?></a></td>--->
	                      	<td align="left" width="300"><a href="seed_album_info.php?pic_no=<?php echo $data_arr[0]?>" onClick="javascript:nw=window.showModalDialog('seed_album_info.php?pic_no=<?php echo $data_arr[0]?>','PicInfo','dialogWidth:450px;dialogHeight:450px');return false;"><?php echo $data_arr[1] ?></a></td>
	                      	<td align="center" width="50"><input name="pic_no[]" type="checkbox" value="<?php echo $data_arr[0] ?>"></td>
	                    	</tr>   
		    <?php
		    }
		    ?>	
<!-- List records E-->
                    <tr>
                      <td class="td_title" colspan="4">
                        <input class="btns" type="button" value="刪除活動圖片" onClick="form_remove()">
                        <input class="btns" type="reset" value="重新輸入">
                        <input class="btns" type="button" value="關閉並返回" onClick="album_return();">
                      </td>
                    </tr>
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
