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

	$export_no=0;
	$table_no=(isset ($_POST['table_no'])) ? $_POST['table_no'] : "";
	$start_date=(isset ($_POST['start_date'])) ? $_POST['start_date'] : "";
	$end_date=(isset ($_POST['end_date'])) ? $_POST['end_date'] : "";
	$export_key=date("YmdHis");
	$export_id=$ck_user_no;
	$join_date=date("Y-m-d H:i:s");	
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$sql_array1=array();
	$null_table=array();
	$cmd_count=0;
	$cmd_count1=0;
//--------------------------------------
//processing
//--------------------------------------	
	if ($ck_user_no=="" || $ck_group!="1")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------	
	$sql =" select a.table_no,a.name,a.description";
	$sql.=" from export_info a";
	$sql.=" where 1<0";
	for ($i=0;$i<count($table_no);$i++)
	{
		$sql.=" or a.table_no='$table_no[$i]'";
	}
	$sql.=" order by a.name,a.table_no";

	$result = $conn->query($sql);
	$row_count= $result->rowCount();	
	//--------------------------------------
	for($i=0;$i<$row_count;$i++)
	{	
		$data_arr=$result->fetch();	

		// 無法使用SQL "INTO OUTFILE" 語法，因為 No file privilege (所以這邊要select->dump)
		$sql =" select *";
		$sql.=" from $data_arr[1]";
		$sql.=" where join_date>'$start_date'";
		$sql.=" and join_date<'$end_date'";
		$sql.=" order by join_date";

		$result2 = $conn->query($sql);
		$row_count2= $result2->rowCount();	
		$null_table[$i]=$row_count2;
		$field_count2= $result2->columnCount();

		if ($null_table[$i]!=0)
		{
			$fp=fopen("export/" . $data_arr[1] . $export_key . ".csv", "a+");
			$string="";
			for($j=0;$j<$row_count2;$j++)
			{
				if ($j==0)
				{
					for($k=0;$k<$field_count2;$k++)
					{
						if ($k!=0)
						{
							$string.=",";
						}
						// $string.="\"" . mysql_field_name($result2,$k) . "\"";	// 無 mysqli_field_name 所以不能用
						// $fieldinfo = mysqli_fetch_field($result2);
						$fieldinfo = $result2->getColumnMeta($k);
						$string.="\"" . $fieldinfo->name . "\"";
					}
					$string.="\n";
				}
			    	$data_arr2=$result2->fetch();	
				for($k=0;$k<$field_count2;$k++)
				{
					if ($k!=0)
					{
						$string.=",";
					}
					$string.="\"" . str_replace("\\", "\\\\", $data_arr2[$k]) . "\"";
				}
				$string.="\n";
			}
			fputs($fp, $string, strlen($string));
			fclose($fp);

			//--------------------
			$sql =" insert into export_log values(";
			$sql.=" $export_no,";
			$sql.=" '$data_arr[0]',";
			$sql.=" '$start_date',";
			$sql.=" '$end_date',";
			$sql.=" '" . $data_arr[1] . $export_key . ".csv',";
			$sql.=" '$export_id',";
			$sql.=" '$export_key',";
			$sql.=" '$join_date');";
		
			$sql_array1[$cmd_count1]=$sql;
			$cmd_count1++;						
		}
		//--------------------
	}
	mysqli_data_seek($result, 0);	// 移回開頭
	//-------------------------------
	//execute the Transaction
	//-------------------------------	
	$result1=DoTransaction($conn,$cmd_count1,$sql_array1);
	if ($result1)
	{
		// $msg="<font color='blue'>存入Log紀錄檔-OK"."</font>";
		$idx=1;
	}
	else
	{
		$msg="<font color='red'>存入Log紀錄檔-ERROR"."</font>";
		$idx=2;
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
                      <td width="93%"><b><font color="#FFFFFF">資料管理-匯出資料表</font></b></td>
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
            <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="650" border="0" cellspacing="1" cellpadding="3">
                    <tr class="tr_title">
		
                      <td class="td_title" width="50">序號</td>
                      <td class="td_title" width="150">表格名稱</td>
                      <td class="td_title" width="250">功能描述</td> 
                      <td class="td_title" width="100">資料筆數</td> 
                      <td class="td_title" width="100">匯出檔案</td> 
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
	                      	<td align="left" width="150"><?php echo $data_arr[1] ?></td>
	                      	<td align="left" width="250"><?php echo $data_arr[2] ?></td>
	                      	<td align="center" width="100"><?php echo $null_table[$i] ?></td>
			    <?php if ($null_table[$i]!=0) { ?>
				<td align="center" width="100"><a href="export/<?php echo $data_arr[1].$export_key.".csv"; ?>">下載</a></td>
			    <?php } else { ?>
				<td align="center" width="100">無資料</td>
			    <?php } ?>
	                    	</tr>   
		    <?php
		    }
		    ?>	
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
<!-- footer -->
<script language="javascript" src="walk_footer1.js"></script>
<!-- footer -->
</form>
</body>
</html>
