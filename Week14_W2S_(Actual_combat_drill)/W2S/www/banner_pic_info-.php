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
	$game_no=(isset ($_GET['game_no'])) ? $_GET['game_no'] : "";
	$slide_no=(isset ($_GET['slide_no'])) ? $_GET['slide_no'] : "";		
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
	$sql =" select show_no,show_upload,show_desc";
	$sql.=" from game_show";
	$sql.=" where game_no='$game_no'";
	$sql.=" and slide_no='$slide_no'";			
	$sql.=" order by show_no";

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
<script language="javascript" src="cpbl_function.js"></script>
<script language="javascript">
function form_action()
{
  	document.AP_CT.target="pic_body"
  	document.AP_CT.submit();
}
function del_pic()
{
	var p_k=<?php echo $row_count ?>;
	var l_show_no_list="";
	var i=0; 
	var s=0;        

	if( p_k > 1)
	{
		for (i=0;i<p_k;i++)
		{	
			if (document.AP_CT.C1[i].checked)
			{				
				l_show_no_list+= document.AP_CT.C1[i].value;						
				s++;
			}	
		}
	}
	else
	{
		if (document.AP_CT.C1.checked)
		{							
			l_show_no_list+= document.AP_CT.C1.value;		
			s++;
		}		
	} 
	
	if (s > 0)
	{		
		answer = confirm("是否確定：刪除所選擇的精采畫面？");
		if (answer)
		{	
			document.AP_CT.show_no_list.value=l_show_no_list.substring(0,l_show_no_list.length-1);		
			document.AP_CT.action="banner_pic_update.php";		
			document.AP_CT.submit();
		}						
	}
	else
	{
		alert("請選擇-想要刪除的精采圖片");
	}	
}
</script>
<!-----javascript code E----->
<body class="body_main">
<form name="AP_CT" action="banner_pic_new.php" method="post" target="pic_top">
<input name="game_no" type="hidden" value="<?php echo $game_no ?>">
<input name="slide_no" type="hidden" value="<?php echo $slide_no ?>">
<input name="show_no_list" type="hidden" value="">
<center>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13"><img src="images/menu02-left.gif" width="13" height="35"></td>
    <td class="title" background="images/menu02-back.gif" width="100%">
      上傳精采畫面圖片-精采畫面資訊
    </td>
    <td width="13"><img src="images/menu02-right.gif" width="14" height="35"></td>
  </tr>
  <tr>
    <td width="13" background="images/block04-left-back.gif" valign="top"><img src="images/block04-left-top.gif" width="13" height="130"></td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/block01-top.gif" class="set-bgtop">
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="100" valign="top">
<!-----function work S----->
            <br><BR>
<?php if ($idx==1) { ?>  
<!-- List Header S-->
            <table width="590" border="0" cellspacing="0" cellpadding="0" align="center">
             <tr align="left">
                <td colspan="2">
                <input class="btns" type="button" value="新增圖片" onClick="form_action()">               
                </td>
              </tr>
              <tr align="left">
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="590" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
                      <td class="td_title" width="40">序號</td>
                      <td class="td_title" width="200">圖片名稱</td>
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
	                      	<td align="center" width="40"><?php echo ($i+1) ?></td>
	                      	<td align="left" width="250"><?php echo $data_arr[1] ?></td>
	                      	<td align="left" width="300"><?php echo $data_arr[2] ?></td>
	                      	<td align="center" width="50"><input name="C1" type="checkbox" value="<?php echo $data_arr[0] ?>:"></td>	 	                      	                      		                      		                      	                      		                      		                      		                      	
	                    	</tr>
	            <?php
	            }
	            ?> 		    
		    <tr>
                      <td class="td_title" colspan="4" >
                        <?php
                        if ($row_count>0)
			{
			?>
                        	<input class="btns" type="button" value="刪除圖片" onclick="del_pic()"> 
                        <?php
                        }
                        ?>                        
                        <input class="btns" type="reset" value="重新輸入">
                        <input class="btns" type="button" value="取消" onClick="window.close()">                      
                      </td>
                    </tr>	                   	   		    
<!-- List records E-->
                 </table>
                </td>
              </tr>
            </table>
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
<!-----function work E----->
            <p>&nbsp;</p>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
    <td width="13" background="images/block04-right-back.gif" valign="top"><img src="images/block04-right-top.gif" width="14" height="130"></td>
  </tr>
  <tr>
    <td width="13"><img src="images/block04-left-bt.gif" width="13" height="7"></td>
    <td width="100%" background="images/block04-center-bt.gif"><img src="images/block04-center-bt.gif" width="24" height="7"></td>
    <td width="13"><img src="images/block04-right-bt.gif" width="14" height="7"></td>
  </tr>
</table>
</form>
</center>
</body>
</html>
