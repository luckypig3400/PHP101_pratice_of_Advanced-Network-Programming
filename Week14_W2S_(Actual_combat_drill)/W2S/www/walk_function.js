function button()
{
/****************************
  function name: button
  功能: 縮放頁面的左右寬度
  傳入參數: 無
  回傳參數: 無
*****************************/

  document.write('<div align="left" style=" position: absolute; top:25; left: 25">');
  document.write('<img src="images/_arrow01-x.gif" onclick=top.ss_bottom.cpbl_menu.cols="0,*" style="cursor:pointer;">');
  document.write('<img src="images/_arrow01.gif" onclick=top.ss_bottom.cpbl_menu.cols="230,*" style="cursor:pointer;">');
  document.write('</div>');
}
//==================================================================================
function check_tel(p_object)
{
/****************************
  function name: check_tel
  功能: 檢查是否為電話號碼的格式
  傳入參數: 欲被檢查的物件
  回傳參數: BOOLEAN
*****************************/

  if (p_object.value=="")
    return;

  if(!Check_NumValue(p_object.value,"0123456789#-()"))
  {
    alert("請輸入合法的電話格式:{[0~9],( )-#}");
    p_object.value="";
    p_object.focus();
    return false;
  }
  else
  {
    return true;
  }
}
function check_mail(p_object)
{
/****************************
  function name: check_mail
  功能: 檢查是否為EMAIL的格式
  傳入參數: 欲被檢查的物件
  回傳參數: BOOLEAN
*****************************/

  if (p_object.value=="")
  return;

  if(!Check_MailValue(p_object.value))
  {
    alert("請輸入合法的電子郵件格式");
    p_object.value="";
    p_object.focus();
    return false;
    }
    else
    {
      return true;
    }
  }

function Check_MailValue(p_str)
{
/****************************
  function name: Check_MailValue
  功能: 檢查是否為EMAIL的格式
  傳入參數: 欲被檢查的字串
  回傳參數: BOOLEAN
*****************************/

  var checkStr = p_str;

  for (i = 0;  i < checkStr.length;  i++)
  {
    if(checkStr.charAt(i)=="@") return true;
  }
  return false;
}
function check_num(p_object)
{
/****************************
  function name: check_num
  功能: 檢查是否為數字的格式
  傳入參數: 欲被檢查的物件
  回傳參數: BOOLEAN
*****************************/

  if (p_object.value=="")
    return;

  if(!Check_NumValue(p_object.value,"0123456789-"))
  {
    alert("請輸入合法的數字格式");
    p_object.value="";
    p_object.focus();
    return false;
  }
  else
  {
    return true;
  }
}
function Check_NumValue(p_str,p_value)
{
/****************************
  function name: Check_NumValue
  功能: 檢查是否為數字的格式
  傳入參數: 欲被檢查的字串
  回傳參數: BOOLEAN
*****************************/

  var checkOK = p_value;
  var checkStr = p_str;
  var allValid = true;
  var decPoints = 0;
  for(i=0;i<checkStr.length;i++){
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++){
      if (ch == checkOK.charAt(j)){
        break;
      }
    }
    if (j == checkOK.length){
      allValid = false;
      break;
    }
  }
  if (!allValid){
    return false;
  }else{
    return true;
  }
}
//=================================================================================
function GetCookie (name)
{
/****************************
  function name: GetCookie
  功能: 傳回欲抓取的COOKIE變數值
  傳入參數: COOKIE NAME
  回傳參數: COOKIE VALUE
*****************************/

  var arg = name + "=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i = 0;
  while (i < clen)
  {
    var j = i + alen;
    if (document.cookie.substring(i, j) == arg) return getCookieVal(j);

    i = document.cookie.indexOf(" ", i) + 1;

    if (i == 0) break;
  }
  return null;
}
function getCookieVal (offset) 
{ 
      	var endstr = document.cookie.indexOf (";", offset); 
      	if (endstr == -1) 
		endstr = document.cookie.length; 
      	return unescape(document.cookie.substring(offset,endstr)); 
} 

function SetCookie(name, value)
{
/****************************
  function name: SetCookie
  功能: 儲存欲存的COOKIE變數
  傳入參數: NAME, VALUE
  回傳參數: 無
*****************************/

  var argv = SetCookie.arguments;
  var argc = SetCookie.arguments.length;
  var expires = (argc > 2) ? argv[2] : null;
  var path = (argc > 3) ? argv[3] : null;
  var domain = (argc > 4) ? argv[4] : null;
  var secure = (argc > 5) ? argv[5] : false;

  document.cookie = name + "=" + escape (value) + ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
}

function DeleteCookie (name)
{
/****************************
  function name: DeleteCookie
  功能: 刪除COOKIE變數
  傳入參數: NAME
  回傳參數: 無
*****************************/

  document.cookie = name + "=" + ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
function show_banner(p_type)
{
	var l_date = new Date();
	var key2= l_date.getTime();    	
  	var winFeature="dialogWidth:0px;dialogHeight:0px;status:no;";
  	var banner_info = null;

    	banner_info = window.showModalDialog("show_banner.php" + "?key2=" + key2 + "&type=" + p_type ,"",winFeature);
    	if(banner_info!=undefined)
    	{
      		if (p_type==1)
      		{
			span_banner1.innerHTML = '<a href="'+ banner_info[0]+'"><img src="banner/'+banner_info[1]+'" width="183" height="55" border="0"></a>';   			
      		}
      		else if (p_type==2)
      		{
      			span_banner2.innerHTML = '<a href="'+ banner_info[0]+'"><img src="banner/'+banner_info[1]+'" width="183" height="55" border="0"></a>';   			
      		}
      		else
      		{
      		}      		
    	}
}