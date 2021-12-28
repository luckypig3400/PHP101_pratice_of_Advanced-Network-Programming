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

	$schedule_no=(isset ($_GET['schedule_no'])) ? $_GET['schedule_no'] : "";
//--------------------------------------
//initial Local variables
//--------------------------------------	
	$msg="";
	$idx="";
	$sql="";
	$sql_array=array();
	$cmd_count=0;

	$fx6_group=array("0"=>"","1"=>"優","2"=>"良","3"=>"可","4"=>"差");
//--------------------------------------
//processing
//--------------------------------------	
	if ($ck_user_no=="" || $ck_group!="3")
	{
		DisconnectMysql($l_type,$conn);	
		header("Location: backend/");
	}
	//--------------------------------------
	$sql =" select count(*)";
	$sql.=" from comment_schedule a,comment_info b";
	$sql.=" where a.schedule_no='$schedule_no'";
	$sql.=" and a.schedule_no=b.schedule_no";

	if(TestDuplicate($conn,$sql))
	{
		//--------------------------------------	
		$sql =" select a.issue_date,d.name,a.issue_times,a.contact_name,a.contact_tel,";
		$sql.="	a.contact_status,a.note,c.name,b.f01,b.f02,";
		$sql.="	b.f03,b.f04,b.f05,b.f06,b.f111,";
		$sql.="	b.f112,b.f113,b.f114,b.f115,b.f121,";
		$sql.=" b.f122,b.f123,b.f124,b.f125,b.f126,";
		$sql.=" b.f13,b.f14,b.f15,b.f16,b.f211,";
		$sql.=" b.f212,b.f213,b.f214,b.f215,b.f221,";
		$sql.=" b.f222,b.f223,b.f224,b.f225,b.f23,";
		$sql.=" b.f24,b.f25,b.f26,b.f311,b.f312,";
		$sql.=" b.f313,b.f314,b.f321,b.f322,b.f323,";
		$sql.=" b.f324,b.f325,b.f326,b.f327,b.f33,";
		$sql.=" b.f34,b.f35,b.f36,b.f411,b.f412,";
		$sql.=" b.f413,b.f414,b.f421,b.f422,b.f43,";
		$sql.=" b.f44,b.f45,b.f46,b.f511,b.f521,";
		$sql.=" b.f522,b.f523,b.f53,b.f54,b.f55,";
		$sql.=" b.f56,b.f61";
		$sql.=" from comment_schedule a,comment_info b,user_info c,school_info d";
		$sql.=" where a.schedule_no='$schedule_no'";		
		$sql.=" and a.schedule_no=b.schedule_no";
		$sql.=" and a.join_id='$ck_user_no'";		// 確定為同一輔導委員
		$sql.=" and a.status='2'";			// 狀態需為已核准
		$sql.=" and a.join_id=c.user_no";
		$sql.=" and a.school_no=d.school_no";

		$result = $conn->query($sql);
		$data_arr=$result->fetch();	
		//--------------------------------------					
		$idx=1;			
	}
	else
	{
		$msg="<font color='red'>"."此評核意見資訊不存在-ERROR"."</font>";
		$idx=0;
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
<script language=javascript>

function form_action()
{
	answer = confirm("是否確定：維護訪視紀錄？");
	if (answer)
	{	
		return true;
	}
	else
	{
		return false;	
	}
}

function chk_status()
{
	answer = confirm("是否確定：結案訪視紀錄？");
	if (answer)
	{
		document.AP_CT.status.value = "C";
		document.AP_CT.submit();
		return true;
	}
	else
	{
		return false;	
	}
}

function chg_page(p_page)
{
	var l_id;
	var l_obj;	
	var i;
	
	for(i=1;i<=7;i++)
	{
		l_id = "page" + i;  
		l_obj = document.all(l_id);
		
		if (i==p_page)
		{
			l_obj.className="btnsPage2";
			show_page(p_page);   
		}
		else
		{
			l_obj.className="btnsPage1";			
		}		
	}		
}
function show_page(p_page)
{
	var l_id;
	var l_obj;
	var l_ubound=45;
	var l_s_index;
	var l_e_index;
	var i;	
		
	if(p_page=="1")
	{
		l_s_index=1;
		l_e_index=8;		
	}
	else if(p_page=="2")
	{
		l_s_index=9;
		l_e_index=14;
	}
	else if(p_page=="3")
	{
		l_s_index=15;
		l_e_index=20;
	}		
	else if(p_page=="4")
	{
		l_s_index=21;
		l_e_index=26;
	}
	else if(p_page=="5")
	{
		l_s_index=27;
		l_e_index=32;
	}
	else if(p_page=="6")
	{
		l_s_index=33;
		l_e_index=38;
	}	
	else if(p_page=="7")
	{
		l_s_index=39;
		l_e_index=45;
	}			
	for(i=1;i<=l_ubound;i++)
	{
		l_id = "obj" + i;  
		l_obj = document.all(l_id);
		
		if(i>=l_s_index && i<=l_e_index)
		{
			l_obj.style.display="";
		}
		else
		{
			l_obj.style.display="none"; 
		}		
	}	   	
}

function chk_f11()
{
	var count=0;
	if (document.AP_CT.f111.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f112.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f113.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f114.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f115.checked==true)
	{
		count++;
	}
	span_f11.innerHTML = count;
}
function chk_f12()
{
	var count=0;
	if (document.AP_CT.f121.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f122.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f123.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f124.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f125.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f126.checked==true)
	{
		count++;
	}
	span_f12.innerHTML = count;
}
function chk_f13(Input)
{
	span_f13.innerHTML = Input.value;
}
function chk_f15(Input)
{
	span_f15.innerHTML = Input.value;
	span_total.innerHTML = parseInt(document.AP_CT.f15.value) + parseInt(document.AP_CT.f25.value) + parseInt(document.AP_CT.f35.value) + parseInt(document.AP_CT.f45.value) + parseInt(document.AP_CT.f55.value);
}
function chk_f16(Input)
{
	if (Input.value=="1")
	{
		span_f16.innerHTML = "優";
	}
	else if (Input.value=="2")
	{
		span_f16.innerHTML = "良";
	}
	else if (Input.value=="3")
	{
		span_f16.innerHTML = "可";
	}
	else if (Input.value=="4")
	{
		span_f16.innerHTML = "差";
	}
	else
	{
		span_f16.innerHTML = "";
	}
}
function chk_f21()
{
	var count=0;
	if (document.AP_CT.f211.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f212.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f213.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f214.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f215.checked==true)
	{
		count++;
	}
	span_f21.innerHTML = count;
}
function chk_f22()
{
	var count=0;
	if (document.AP_CT.f221.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f222.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f223.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f224.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f225.checked==true)
	{
		count++;
	}
	span_f22.innerHTML = count;
}
function chk_f23(Input)
{
	span_f23.innerHTML = Input.value;
}
function chk_f25(Input)
{
	span_f25.innerHTML = Input.value;
	span_total.innerHTML = parseInt(document.AP_CT.f15.value) + parseInt(document.AP_CT.f25.value) + parseInt(document.AP_CT.f35.value) + parseInt(document.AP_CT.f45.value) + parseInt(document.AP_CT.f55.value);
}
function chk_f26(Input)
{
	if (Input.value=="1")
	{
		span_f26.innerHTML = "優";
	}
	else if (Input.value=="2")
	{
		span_f26.innerHTML = "良";
	}
	else if (Input.value=="3")
	{
		span_f26.innerHTML = "可";
	}
	else if (Input.value=="4")
	{
		span_f26.innerHTML = "差";
	}
	else
	{
		span_f26.innerHTML = "";
	}
}
function chk_f31()
{
	var count=0;
	if (document.AP_CT.f311.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f312.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f313.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f314.checked==true)
	{
		count++;
	}
	span_f31.innerHTML = count;
}
function chk_f32()
{
	var count=0;
	if (document.AP_CT.f321.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f322.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f323.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f324.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f325.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f326.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f327.checked==true)
	{
		count++;
	}
	span_f32.innerHTML = count;
}
function chk_f33(Input)
{
	span_f33.innerHTML = Input.value;
}
function chk_f35(Input)
{
	span_f35.innerHTML = Input.value;
	span_total.innerHTML = parseInt(document.AP_CT.f15.value) + parseInt(document.AP_CT.f25.value) + parseInt(document.AP_CT.f35.value) + parseInt(document.AP_CT.f45.value) + parseInt(document.AP_CT.f55.value);
}
function chk_f36(Input)
{
	if (Input.value=="1")
	{
		span_f36.innerHTML = "優";
	}
	else if (Input.value=="2")
	{
		span_f36.innerHTML = "良";
	}
	else if (Input.value=="3")
	{
		span_f36.innerHTML = "可";
	}
	else if (Input.value=="4")
	{
		span_f36.innerHTML = "差";
	}
	else
	{
		span_f36.innerHTML = "";
	}
}
function chk_f41()
{
	var count=0;
	if (document.AP_CT.f411.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f412.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f413.checked==true)
	{
		count++;
	}
	span_f41.innerHTML = count;
}
function chk_f42()
{
	var count=0;
	if (document.AP_CT.f421.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f422.checked==true)
	{
		count++;
	}
	span_f42.innerHTML = count;
}
function chk_f43(Input)
{
	span_f43.innerHTML = Input.value;
}
function chk_f45(Input)
{
	span_f45.innerHTML = Input.value;
	span_total.innerHTML = parseInt(document.AP_CT.f15.value) + parseInt(document.AP_CT.f25.value) + parseInt(document.AP_CT.f35.value) + parseInt(document.AP_CT.f45.value) + parseInt(document.AP_CT.f55.value);
}
function chk_f46(Input)
{
	if (Input.value=="1")
	{
		span_f46.innerHTML = "優";
	}
	else if (Input.value=="2")
	{
		span_f46.innerHTML = "良";
	}
	else if (Input.value=="3")
	{
		span_f46.innerHTML = "可";
	}
	else if (Input.value=="4")
	{
		span_f46.innerHTML = "差";
	}
	else
	{
		span_f46.innerHTML = "";
	}
}
function chk_f51()
{
	var count=0;
	if (document.AP_CT.f511.checked==true)
	{
		count++;
	}
	span_f51.innerHTML = count;
}
function chk_f52()
{
	var count=0;
	if (document.AP_CT.f521.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f522.checked==true)
	{
		count++;
	}
	if (document.AP_CT.f523.checked==true)
	{
		count++;
	}
	span_f52.innerHTML = count;
}
function chk_f53(Input)
{
	span_f53.innerHTML = Input.value;
}
function chk_f55(Input)
{
	span_f55.innerHTML = Input.value;
	span_total.innerHTML = parseInt(document.AP_CT.f15.value) + parseInt(document.AP_CT.f25.value) + parseInt(document.AP_CT.f35.value) + parseInt(document.AP_CT.f45.value) + parseInt(document.AP_CT.f55.value);
}
function chk_f56(Input)
{
	if (Input.value=="1")
	{
		span_f56.innerHTML = "優";
	}
	else if (Input.value=="2")
	{
		span_f56.innerHTML = "良";
	}
	else if (Input.value=="3")
	{
		span_f56.innerHTML = "可";
	}
	else if (Input.value=="4")
	{
		span_f56.innerHTML = "差";
	}
	else
	{
		span_f56.innerHTML = "";
	}
}

function BeforeLoad()
{
	chg_page(1);
	chk_f11();
	chk_f12();
	chk_f21();
	chk_f22();
	chk_f31();
	chk_f32();
	chk_f41();
	chk_f42();
	chk_f51();
	chk_f52();
}
</script>
<!-----javascript code E----->
<body class="body_main" onload="BeforeLoad()">
<form name="AP_CT" action="comment_update.php" method="post" onsubmit="return form_action()">
<input name="schedule_no" type="hidden" value="<?php echo $schedule_no ?>">
<input name="status" type="hidden" value="">
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
                      <td width="93%"><b><font color="#FFFFFF">評核意見管理-評核意見資訊</font></b></td>
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
	<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td colspan="2" align="center">
                  <table class="table_in" width="550" border="0" cellspacing="1" cellpadding="3">
	            <tr>
		      <td class="tdHeads" colspan="2">
			<input type="button" name="page1" class="btnsPage2" value="訪視資料" onclick="chg_page(1)">
			<input type="button" name="page2" class="btnsPage1" value="檢核表1" onclick="chg_page(2)">
			<input type="button" name="page3" class="btnsPage1" value="檢核表2" onclick="chg_page(3)">
			<input type="button" name="page4" class="btnsPage1" value="檢核表3" onclick="chg_page(4)">
			<input type="button" name="page5" class="btnsPage1" value="檢核表4" onclick="chg_page(5)">
			<input type="button" name="page6" class="btnsPage1" value="檢核表5" onclick="chg_page(6)">
			<input type="button" name="page7" class="btnsPage1" value="評分總表" onclick="chg_page(7)">
		      </td>
	            </tr>
	            <!-- 訪視資料表 --->
                    <tr id="obj1">
                      <td class="tdHeads" width="150">輔導委員姓名：</td>
                      <td class="tdHeads2" width="400"><?php echo $data_arr[7]?></td>
                    </tr>
                    <tr id="obj2">
                      <td class="tdHeads" width="150">訪視日期：</td>
                      <td class="tdHeads2"><?php echo $data_arr[0]?></td>
                    </tr>
                    <tr id="obj3">
                      <td class="tdHeads" width="150">訪視學校：</td>
                      <td class="tdHeads2"><?php echo $data_arr[1]?></td>
                    </tr>
                    <tr id="obj4">
                      <td class="tdHeads" width="150">訪視學校聯絡人：</td>
                      <td class="tdHeads2"><?php echo $data_arr[3]?></td>
                    </tr>
                    <tr id="obj5">
                      <td class="tdHeads" width="150">電話：</td>
                      <td class="tdHeads2"><?php echo $data_arr[4]?></td>
                    </tr>
                    <tr id="obj6">
                      <td class="tdHeads" width="150">訪視次數：</td>
                      <td class="tdHeads2"><?php echo $data_arr[2]?>次</td>
                    </tr>
                    <tr id="obj7">
                      <td class="tdHeads" width="150">訪談對象：</td>
                      <td class="tdHeads2">
                      <input name="f01" type="checkbox" value="Y" <?php echo ($data_arr[8])?"checked":""; ?>>校長
                      <input name="f02" type="checkbox" value="Y" <?php echo ($data_arr[9])?"checked":""; ?>>主任
                      <input name="f03" type="checkbox" value="Y" <?php echo ($data_arr[10])?"checked":""; ?>>教職員
                      <input name="f04" type="checkbox" value="Y" <?php echo ($data_arr[11])?"checked":""; ?>>老師
                      <input name="f05" type="checkbox" value="Y" <?php echo ($data_arr[12])?"checked":""; ?>>學生
                      </td>
                    </tr>
                    <tr id="obj8" valign="top">
                      <td class="tdHeads" width="150">訪視要點：</td>
                      <td class="tdHeads2">
                      <textarea name="content" cols="40" rows="8"><?php echo $data_arr[13]?></textarea>
                      </td>
                    </tr>
	            <!-- 檢核表(1) --->
                    <tr id="obj9" valign="top">
                      <td class="tdHeads" width="150">核心工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f111" type="checkbox" value="Y" <?php echo ($data_arr[14])?"checked":""; ?> onChange="chk_f11()"> 1.</td><td>召集學校與政府公部門（交通、警察、教育局、工務局、交通大隊及環保局等）及社區代表，召開工作協調諮詢會議，每學期至少1次。</td></tr>
				<tr valign="top"><td nowrap><input name="f112" type="checkbox" value="Y" <?php echo ($data_arr[15])?"checked":""; ?> onChange="chk_f11()"> 2.</td><td>由校長、教務或學務主任、體育組長、衛生組長及護士相關人員或其他單位組成走路上學工作團隊。</td></tr>
				<tr valign="top"><td nowrap><input name="f113" type="checkbox" value="Y" <?php echo ($data_arr[16])?"checked":""; ?> onChange="chk_f11()"> 3.</td><td>依據地區與周邊環境特色與需求，研擬推動計畫書，訂定具體的工作目標(成效指標)。</td></tr>
				<tr valign="top"><td nowrap><input name="f114" type="checkbox" value="Y" <?php echo ($data_arr[17])?"checked":""; ?> onChange="chk_f11()"> 4.</td><td>調查及統計走路上學方式、周邊車流量、與上下學路線的交通事故。</td></tr>
				<tr valign="top"><td nowrap><input name="f115" type="checkbox" value="Y" <?php echo ($data_arr[18])?"checked":""; ?> onChange="chk_f11()"> 5.</td><td>多宣導走路上學活動相關訊息，以增加教職員生、家長與社區居民之認同，每學期至少1次。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj10" valign="top">
                      <td class="tdHeads" width="150">選辦工作：</td>
                      <td class="tdHeads2">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f121" type="checkbox" value="Y" <?php echo ($data_arr[19])?"checked":""; ?> onChange="chk_f12()"> 1.</td><td>定期舉辦與走路上學相關會議(不包含校內會議)。</td></tr>
				<tr valign="top"><td nowrap><input name="f122" type="checkbox" value="Y" <?php echo ($data_arr[20])?"checked":""; ?> onChange="chk_f12()"> 2.</td><td>協同專家學者或相關單位，檢視學童步行路線之周遭環境及交通安全狀況，制定具體的交通規劃方案與改善策略。</td></tr>
				<tr valign="top"><td nowrap><input name="f123" type="checkbox" value="Y" <?php echo ($data_arr[21])?"checked":""; ?> onChange="chk_f12()"> 3.</td><td>爭取學校所在地首長(里長或村長)支持，並整合學校相關預算支應或經費挹助。</td></tr>
				<tr valign="top"><td nowrap><input name="f124" type="checkbox" value="Y" <?php echo ($data_arr[22])?"checked":""; ?> onChange="chk_f12()"> 4.</td><td>學校選派教職員或導護志工參加義交訓練。</td></tr>
				<tr valign="top"><td nowrap><input name="f125" type="checkbox" value="Y" <?php echo ($data_arr[23])?"checked":""; ?> onChange="chk_f12()"> 5.</td><td>定期調查教職員生對與家長對走路上學活動之知識、態度及行為上的改變以評估執行成效。</td></tr>
				<tr valign="top"><td nowrap><input name="f126" type="checkbox" value="Y" <?php echo ($data_arr[24])?"checked":""; ?> onChange="chk_f12()"> 6.</td><td>訂定交通導護志工設置要點，定期辦理招募、培訓與獎勵等活動。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj11">
                      <td class="tdHeads" width="150">自訂工作數量：</td>
                      <td class="tdHeads2"><input type="input" name="f13" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[25]?>" onChange="chk_f13(this)"></td>
                    </tr>
                    <tr id="obj12" valign="top">
                      <td class="tdHeads" width="150">自訂工作內容：</td>
                      <td class="tdHeads2">
                      <textarea name="f14" cols="40" rows="8"><?php echo $data_arr[26]?></textarea>
                      </td>
                    </tr>
                    <tr id="obj13">
                      <td class="tdHeads" width="150">分項評分：</td>
                      <td class="tdHeads2"><input type="input" name="f15" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[27]?>" onChange="chk_f15(this)"></td>
                    </tr>
                    <tr id="obj14">
                      <td class="tdHeads" width="150">評比：</td>
                      <td class="tdHeads2">
                	<select name="f16" onChange="chk_f16(this)">
				<option value="0" <?php echo ($data_arr[28]=="0")?"selected":"" ?>></option>
				<option value="1" <?php echo ($data_arr[28]=="1")?"selected":"" ?>>優</option>
				<option value="2" <?php echo ($data_arr[28]=="2")?"selected":"" ?>>良</option>
				<option value="3" <?php echo ($data_arr[28]=="3")?"selected":"" ?>>可</option>
				<option value="4" <?php echo ($data_arr[28]=="4")?"selected":"" ?>>差</option>
			</select>
                      </td>
                    </tr>
	            <!-- 檢核表(2) --->
                    <tr id="obj15" valign="top">
                      <td class="tdHeads" width="150">核心工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f211" type="checkbox" value="Y" <?php echo ($data_arr[29])?"checked":""; ?> onChange="chk_f21()"> 1.</td><td>定期檢視學校內外步行或交通管制設施有無缺損或須改進的地方，每學期至少2次。</td></tr>
				<tr valign="top"><td nowrap><input name="f212" type="checkbox" value="Y" <?php echo ($data_arr[30])?"checked":""; ?> onChange="chk_f21()"> 2.</td><td>設置交通導護點、以提升學童走路上學之安全。</td></tr>
				<tr valign="top"><td nowrap><input name="f213" type="checkbox" value="Y" <?php echo ($data_arr[31])?"checked":""; ?> onChange="chk_f21()"> 3.</td><td>利用環境適合度評估學校週邊環境，每學期至少一次。</td></tr>
				<tr valign="top"><td nowrap><input name="f214" type="checkbox" value="Y" <?php echo ($data_arr[32])?"checked":""; ?> onChange="chk_f21()"> 4.</td><td>定期辦理校內推廣活動，以提升校內師生共識與社區意識，每學期至少1次。</td></tr>
				<tr valign="top"><td nowrap><input name="f215" type="checkbox" value="Y" <?php echo ($data_arr[33])?"checked":""; ?> onChange="chk_f21()"> 5.</td><td>定期利用校內各種電子資訊網頁或佈告欄宣導走路上學相關訊息。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj16" valign="top">
                      <td class="tdHeads" width="150">選辦工作：</td>
                      <td class="tdHeads2">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f221" type="checkbox" value="Y" <?php echo ($data_arr[34])?"checked":""; ?> onChange="chk_f22()"> 1.</td><td>定期辦理導護志工傷害保險及交通安全裝備之汰舊換新。</td></tr>
				<tr valign="top"><td nowrap><input name="f222" type="checkbox" value="Y" <?php echo ($data_arr[35])?"checked":""; ?> onChange="chk_f22()"> 2.</td><td>設置時段性通學巷或人車分流路線。</td></tr>
				<tr valign="top"><td nowrap><input name="f223" type="checkbox" value="Y" <?php echo ($data_arr[36])?"checked":""; ?> onChange="chk_f22()"> 3.</td><td>提供工作團隊或導護志工辦公室與集會空間。</td></tr>
				<tr valign="top"><td nowrap><input name="f224" type="checkbox" value="Y" <?php echo ($data_arr[37])?"checked":""; ?> onChange="chk_f22()"> 4.</td><td>規劃走路上學路隊，促進學童或親子間的交流與互動。</td></tr>
				<tr valign="top"><td nowrap><input name="f225" type="checkbox" value="Y" <?php echo ($data_arr[38])?"checked":""; ?> onChange="chk_f22()"> 5.</td><td>建立個人與班級獎勵制度來提高學童走路上學意願。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj17">
                      <td class="tdHeads" width="150">自訂工作數量：</td>
                      <td class="tdHeads2"><input type="input" name="f23" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[39]?>" onChange="chk_f23(this)"></td>
                    </tr>
                    <tr id="obj18" valign="top">
                      <td class="tdHeads" width="150">自訂工作內容：</td>
                      <td class="tdHeads2">
                      <textarea name="f24" cols="40" rows="8"><?php echo $data_arr[40]?></textarea>
                      </td>
                    </tr>
                    <tr id="obj19">
                      <td class="tdHeads" width="150">分項評分：</td>
                      <td class="tdHeads2"><input type="input" name="f25" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[41]?>" onChange="chk_f25(this)"></td>
                    </tr>
                    <tr id="obj20">
                      <td class="tdHeads" width="150">評比：</td>
                      <td class="tdHeads2">
                	<select name="f26" onChange="chk_f26(this)">
				<option value="0" <?php echo ($data_arr[42]=="0")?"selected":"" ?>></option>
				<option value="1" <?php echo ($data_arr[42]=="1")?"selected":"" ?>>優</option>
				<option value="2" <?php echo ($data_arr[42]=="2")?"selected":"" ?>>良</option>
				<option value="3" <?php echo ($data_arr[42]=="3")?"selected":"" ?>>可</option>
				<option value="4" <?php echo ($data_arr[42]=="4")?"selected":"" ?>>差</option>
			</select>
                      </td>
                    </tr>
	            <!-- 檢核表(3) --->
                    <tr id="obj21" valign="top">
                      <td class="tdHeads" width="150">核心工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f311" type="checkbox" value="Y" <?php echo ($data_arr[43])?"checked":""; ?> onChange="chk_f31()"> 1.</td><td>工作協調諮詢會議中包含家長代表及社區重要人士。</td></tr>
				<tr valign="top"><td nowrap><input name="f312" type="checkbox" value="Y" <?php echo ($data_arr[44])?"checked":""; ?> onChange="chk_f31()"> 2.</td><td>設置導護商店、以提升學童走路上學之安全。</td></tr>
				<tr valign="top"><td nowrap><input name="f313" type="checkbox" value="Y" <?php echo ($data_arr[45])?"checked":""; ?> onChange="chk_f31()"> 3.</td><td>建立導護志工及教職員生交通安全事故之標準緊急處理流程。</td></tr>
				<tr valign="top"><td nowrap><input name="f314" type="checkbox" value="Y" <?php echo ($data_arr[46])?"checked":""; ?> onChange="chk_f31()"> 4.</td><td>辦理社區推廣與宣導活動，提高社區居民對走路上學的支持與配合。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj22" valign="top">
                      <td class="tdHeads" width="150">選辦工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f321" type="checkbox" value="Y" <?php echo ($data_arr[47])?"checked":""; ?> onChange="chk_f32()"> 1.</td><td>結合家長、社區及政府組織相關團體之人力與經費支援，建立社區資源檔案。</td></tr>
				<tr valign="top"><td nowrap><input name="f322" type="checkbox" value="Y" <?php echo ($data_arr[48])?"checked":""; ?> onChange="chk_f32()"> 2.</td><td>學校師生定期支援社區服務，改善社區交通安全環境(如：找出人行道積水、缺損的地方等)，以創造學校-社區雙贏之契機。</td></tr>
				<tr valign="top"><td nowrap><input name="f323" type="checkbox" value="Y" <?php echo ($data_arr[49])?"checked":""; ?> onChange="chk_f32()"> 3.</td><td>公告家長與社區居民學童上下學時段之學區路線、導護站位置及交通路線(替代道路)等。</td></tr>
				<tr valign="top"><td nowrap><input name="f324" type="checkbox" value="Y" <?php echo ($data_arr[50])?"checked":""; ?> onChange="chk_f32()"> 4.</td><td>定期邀請導護商店參加工作會議，並暸解導護商店配合情形。</td></tr>
				<tr valign="top"><td nowrap><input name="f325" type="checkbox" value="Y" <?php echo ($data_arr[51])?"checked":""; ?> onChange="chk_f32()"> 5.</td><td>召開安親班協調說明會，以配合推廣走路上學活動。</td></tr>
				<tr valign="top"><td nowrap><input name="f326" type="checkbox" value="Y" <?php echo ($data_arr[52])?"checked":""; ?> onChange="chk_f32()"> 6.</td><td>老師配合教學，帶領小朋友認識導護商店。</td></tr>
				<tr valign="top"><td nowrap><input name="f327" type="checkbox" value="Y" <?php echo ($data_arr[53])?"checked":""; ?> onChange="chk_f32()"> 7.</td><td>公開表揚社區中積極參與的人員或團體。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj23">
                      <td class="tdHeads" width="150">自訂工作數量：</td>
                      <td class="tdHeads2"><input type="input" name="f33" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[54]?>" onChange="chk_f33(this)"></td>
                    </tr>
                    <tr id="obj24" valign="top">
                      <td class="tdHeads" width="150">自訂工作內容：</td>
                      <td class="tdHeads2">
                      <textarea name="f34" cols="40" rows="8"><?php echo $data_arr[55]?></textarea>
                      </td>
                    </tr>
                    <tr id="obj25">
                      <td class="tdHeads" width="150">分項評分：</td>
                      <td class="tdHeads2"><input type="input" name="f35" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[56]?>" onChange="chk_f35(this)"></td>
                    </tr>
                    <tr id="obj26">
                      <td class="tdHeads" width="150">評比：</td>
                      <td class="tdHeads2">
                	<select name="f36" onChange="chk_f36(this)">
				<option value="0" <?php echo ($data_arr[57]=="0")?"selected":"" ?>></option>
				<option value="1" <?php echo ($data_arr[57]=="1")?"selected":"" ?>>優</option>
				<option value="2" <?php echo ($data_arr[57]=="2")?"selected":"" ?>>良</option>
				<option value="3" <?php echo ($data_arr[57]=="3")?"selected":"" ?>>可</option>
				<option value="4" <?php echo ($data_arr[57]=="4")?"selected":"" ?>>差</option>
			</select>
                      </td>
                    </tr>
	            <!-- 檢核表(4) --->
                    <tr id="obj27" valign="top">
                      <td class="tdHeads" width="150">核心工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f411" type="checkbox" value="Y" <?php echo ($data_arr[58])?"checked":""; ?> onChange="chk_f41()"> 1.</td><td>辦理教職員相關教育訓練，每學年至少1次，並追蹤相關活動執行成效。</td></tr>
				<tr valign="top"><td nowrap><input name="f412" type="checkbox" value="Y" <?php echo ($data_arr[59])?"checked":""; ?> onChange="chk_f41()"> 2.</td><td>辦理交通安全領域之宣導或協同教學活動，每學期至少1次。</td></tr>
				<tr valign="top"><td nowrap><input name="f413" type="checkbox" value="Y" <?php echo ($data_arr[60])?"checked":""; ?> onChange="chk_f41()"> 3.</td><td>考核學童交通安全教育課程學習成效，並針對學習狀況不佳者進行輔導追蹤。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj28" valign="top">
                      <td class="tdHeads" width="150">選辦工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f421" type="checkbox" value="Y" <?php echo ($data_arr[62])?"checked":""; ?> onChange="chk_f42()"> 1.</td><td>實施走路技巧、自我安全保護或走路上學之身心效益課程融入教學。</td></tr>
				<tr valign="top"><td nowrap><input name="f422" type="checkbox" value="Y" <?php echo ($data_arr[63])?"checked":""; ?> onChange="chk_f42()"> 2.</td><td>實施書包減重方案，並定期評估實施成效。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj29">
                      <td class="tdHeads" width="150">自訂工作數量：</td>
                      <td class="tdHeads2"><input type="input" name="f43" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[64]?>" onChange="chk_f43(this)"></td>
                    </tr>
                    <tr id="obj30" valign="top">
                      <td class="tdHeads" width="150">自訂工作內容：</td>
                      <td class="tdHeads2">
                      <textarea name="f44" cols="40" rows="8"><?php echo $data_arr[65]?></textarea>
                      </td>
                    </tr>
                    <tr id="obj31">
                      <td class="tdHeads" width="150">分項評分：</td>
                      <td class="tdHeads2"><input type="input" name="f45" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[66]?>" onChange="chk_f45(this)"></td>
                    </tr>
                    <tr id="obj32">
                      <td class="tdHeads" width="150">評比：</td>
                      <td class="tdHeads2">
                	<select name="f46" onChange="chk_f46(this)">
				<option value="0" <?php echo ($data_arr[67]=="0")?"selected":"" ?>></option>
				<option value="1" <?php echo ($data_arr[67]=="1")?"selected":"" ?>>優</option>
				<option value="2" <?php echo ($data_arr[67]=="2")?"selected":"" ?>>良</option>
				<option value="3" <?php echo ($data_arr[67]=="3")?"selected":"" ?>>可</option>
				<option value="4" <?php echo ($data_arr[67]=="4")?"selected":"" ?>>差</option>
			</select>
                      </td>
                    </tr>
	            <!-- 檢核表(5) --->
                    <tr id="obj33" valign="top">
                      <td class="tdHeads" width="150">核心工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f511" type="checkbox" value="Y" <?php echo ($data_arr[68])?"checked":""; ?> onChange="chk_f51()"> 1.</td><td>提供教職員生、家長跟社區居民相關教育宣導資料。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj34" valign="top">
                      <td class="tdHeads" width="150">選辦工作：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr valign="top"><td nowrap><input name="f521" type="checkbox" value="Y" <?php echo ($data_arr[69])?"checked":""; ?> onChange="chk_f52()"> 1.</td><td>輔導教師編製走路上學學童手冊與教學輔導手冊。</td></tr>
				<tr valign="top"><td nowrap><input name="f522" type="checkbox" value="Y" <?php echo ($data_arr[70])?"checked":""; ?> onChange="chk_f52()"> 2.</td><td>建立社區安全危害熱點(hot spot)資料。</td></tr>
				<tr valign="top"><td nowrap><input name="f523" type="checkbox" value="Y" <?php echo ($data_arr[71])?"checked":""; ?> onChange="chk_f52()"> 3.</td><td>編制走路上下學相關教案。</td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj35">
                      <td class="tdHeads" width="150">自訂工作數量：</td>
                      <td class="tdHeads2"><input type="input" name="f53" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[72]?>" onChange="chk_f53(this)"></td>
                    </tr>
                    <tr id="obj36" valign="top">
                      <td class="tdHeads" width="150">自訂工作內容：</td>
                      <td class="tdHeads2">
                      <textarea name="f54" cols="40" rows="8"><?php echo $data_arr[73]?></textarea>
                      </td>
                    </tr>
                    <tr id="obj37">
                      <td class="tdHeads" width="150">分項評分：</td>
                      <td class="tdHeads2"><input type="input" name="f55" class="inputs" size="3" maxlength="5" value="<?php echo $data_arr[74]?>" onChange="chk_f55(this)"></td>
                    </tr>
                    <tr id="obj38">
                      <td class="tdHeads" width="150">評比：</td>
                      <td class="tdHeads2">
                	<select name="f56" onChange="chk_f56(this)">
				<option value="0" <?php echo ($data_arr[75]=="0")?"selected":"" ?>></option>
				<option value="1" <?php echo ($data_arr[75]=="1")?"selected":"" ?>>優</option>
				<option value="2" <?php echo ($data_arr[75]=="2")?"selected":"" ?>>良</option>
				<option value="3" <?php echo ($data_arr[75]=="3")?"selected":"" ?>>可</option>
				<option value="4" <?php echo ($data_arr[75]=="4")?"selected":"" ?>>差</option>
			</select>
                      </td>
                    </tr>
	            <!-- 評分總表 --->
                    <tr id="obj39" valign="top">
                      <td class="tdHeads" width="150">學校推廣政策：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0" class="tdHeads2">
				<tr valign="top"><td width="200">核心工作：完成<span id="span_f11"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">選辦工作：完成<span id="span_f12"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">自訂工作：共<span id="span_f13"><?php echo $data_arr[25]?></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">分項評分：<span id="span_f15"><?php echo $data_arr[27]?></span></td><td width="200">評比：<span id="span_f16"><?php echo $fx6_group[$data_arr[28]]; ?></span></td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj40" valign="top">
                      <td class="tdHeads" width="150">學校物質與社會環境：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0" class="tdHeads2">
				<tr valign="top"><td width="200">核心工作：完成<span id="span_f21"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">選辦工作：完成<span id="span_f22"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">自訂工作：共<span id="span_f23"><?php echo $data_arr[39]?></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">分項評分：<span id="span_f25"><?php echo $data_arr[41]?></span></td><td width="200">評比：<span id="span_f26"><?php echo $fx6_group[$data_arr[42]]; ?></span></td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj41" valign="top">
                      <td class="tdHeads" width="150">社區關係：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0" class="tdHeads2">
				<tr valign="top"><td width="200">核心工作：完成<span id="span_f31"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">選辦工作：完成<span id="span_f32"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">自訂工作：共<span id="span_f33"><?php echo $data_arr[54]?></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">分項評分：<span id="span_f35"><?php echo $data_arr[56]?></span></td><td width="200">評比：<span id="span_f36"><?php echo $fx6_group[$data_arr[57]]; ?></span></td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj42" valign="top">
                      <td class="tdHeads" width="150">個人健康技巧：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0" class="tdHeads2">
				<tr valign="top"><td width="200">核心工作：完成<span id="span_f41"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">選辦工作：完成<span id="span_f42"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">自訂工作：共<span id="span_f43"><?php echo $data_arr[64]?></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">分項評分：<span id="span_f45"><?php echo $data_arr[66]?></span></td><td width="200">評比：<span id="span_f46"><?php echo $fx6_group[$data_arr[67]]; ?></span></td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj43" valign="top">
                      <td class="tdHeads" width="150">健康服務：</td>
                      <td class="tdHeads2" width="400">
			<table border="0" cellspacing="0" cellpadding="0" class="tdHeads2">
				<tr valign="top"><td width="200">核心工作：完成<span id="span_f51"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">選辦工作：完成<span id="span_f52"></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">自訂工作：共<span id="span_f53"><?php echo $data_arr[72]?></span>項</td><td width="200"></td></tr>
				<tr valign="top"><td width="200">分項評分：<span id="span_f55"><?php echo $data_arr[74]?></span></td><td width="200">評比：<span id="span_f56"><?php echo $fx6_group[$data_arr[75]]; ?></span></td></tr>
			</table>
                      </td>
                    </tr>
                    <tr id="obj44">
                      <td class="tdHeads" width="150">總分：</td>
                      <td class="tdHeads2" width="400"><span id="span_total"><?php echo ($data_arr[27]+$data_arr[41]+$data_arr[56]+$data_arr[66]+$data_arr[74]); ?></span>分</td>
                    </tr>
                    <tr id="obj45" valign="top">
                      <td class="tdHeads" width="150">其他建議事項：</td>
                      <td class="tdHeads2">
                      <textarea name="f61" cols="40" rows="8"><?php echo $data_arr[76]?></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td class="td_title" colspan="2" >
                        <input class="btns" type="submit" value="維護訪視紀錄">
                        <input class="btns" type="button" value="結案訪視紀錄" onClick="chk_status();">
                        <input class="btns" type="reset" value="重新輸入">
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
<!-- footer -->
<script language="javascript" src="walk_footer1.js"></script>
<!-- footer -->
</form>
</body>
</html>
