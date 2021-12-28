//************************************************************************************
// weeklycalendar
// Copyright (C) 2006, Massimo Beatini
//
// This software is provided "as-is", without any express or implied warranty. In
// no event will the authors be held liable for any damages arising from the use
// of this software.
//
// Permission is granted to anyone to use this software for any purpose, including
// commercial applications, and to alter it and redistribute it freely, subject to
// the following restrictions:
//
// 1. The origin of this software must not be misrepresented; you must not claim
//    that you wrote the original software. If you use this software in a product,
//    an acknowledgment in the product documentation would be appreciated but is
//    not required.
//
// 2. Altered source versions must be plainly marked as such, and must not be
//    misrepresented as being the original software.
//
// 3. This notice may not be removed or altered from any source distribution.
//
//************************************************************************************
/*********************defined by leeraphael*******************************************/
function getCookieVal (offset)
{
      	var endstr = document.cookie.indexOf (";", offset);
      	if (endstr == -1)
		endstr = document.cookie.length;
      	return unescape(document.cookie.substring(offset,endstr));
}

function GetCookie (name)
{
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

function SetCookie (name, value)
{
	var argv = SetCookie.arguments;
      	var argc = SetCookie.arguments.length;
      	var expires = (argc > 2) ? argv[2] : null;
      	var path = (argc > 3) ? argv[3] : null;
      	var domain = (argc > 4) ? argv[4] : null;
      	var secure = (argc > 5) ? argv[5] : false;

      	document.cookie = name + "=" + escape (value) + ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
}
function w_anime_over(e)
{
	var i,j;
	var e_out;
	var ie_var = "srcElement";
	var moz_var = "target";
	var prop_var = "rownumber";

	// "target" for Mozilla, Netscape, Firefox et al. ; "srcElement" for IE
	//evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	i = e.srcElement.rownumber ;
	//prop_var = "colnumber";
	//evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	j = e.srcElement.colnumber;
	//alert(i);
	document.getElementById("w_c"+i+j).style.backgroundColor='#F2F491';
}
function w_anime_out(e)
{
	var i,j;
	var e_out;
	var ie_var = "srcElement";
	var moz_var = "target";
	var prop_var = "rownumber";
	var today = new Date();
	// "target" for Mozilla, Netscape, Firefox et al. ; "srcElement" for IE
	//evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	i = e.srcElement.rownumber ;
	//prop_var = "colnumber";
	//evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	j = e.srcElement.colnumber;
	//alert(i);
	if(j==5||j==6)
	{
		if(document.getElementById("w_c"+i+j).innerText==today.getDate()&&(today.getMonth() == w_d.getMonth()) && (today.getFullYear() == w_d.getFullYear()))
			document.getElementById("w_c"+i+j).style.backgroundColor='#FFFF80';
		else
			document.getElementById("w_c"+i+j).style.backgroundColor='#FFCCCC';

	}
	else
	{
		if(document.getElementById("w_c"+i+j).innerText==today.getDate()&&(today.getMonth() == w_d.getMonth()) && (today.getFullYear() == w_d.getFullYear()))
			document.getElementById("w_c"+i+j).style.backgroundColor='#FFFF80';
		else
			document.getElementById("w_c"+i+j).style.backgroundColor='#ffffff';
	}

}
function reload_fun()
{
	var reload_function_name = "trade_list.asp, remind_list.asp, schedule_list.asp"
	var program_name = GetCookie("jk_program_name")
	if(reload_function_name.indexOf(program_name)>=0)
	{
		top.cbf_right.location.href = program_name
	}
}


// for search day
var wk_1 = new Date();
var wk_1_y = "";
var wk_1_m = "";
var wk_1_d = "";
var schedule_d = new Date();
var schedule_d_y = "";
var schedule_d_m = "";
var schedule_d_d = "";
SetCookie("jk_schedule_d", schedule_d.getFullYear()+"/"+(schedule_d.getMonth()+1)+"/"+schedule_d.getDate());
//default 0 show close.jpg
//        1 hidden close.jpg
var close_window = 0

//calendar position in windows
var window_x = 20;
var window_y = 55;


//count the first day
	if(wk_1.getDay() == 1)
	{
		//set week firt dat
		wk_1_y = wk_1.getFullYear();
		wk_1_m = wk_1.getMonth()+1;
		wk_1_d = wk_1.getDate();

		SetCookie("jk_wk_1",wk_1_y+"/"+wk_1_m+"/"+wk_1_d);
	}
	else
	{
		for(i=0;i<8;i++)
		{
			wk_1.setDate(wk_1.getDate()+1);
			//alert("星期:"+wk_1.getDay()+" 幾號:"+wk_1.getDate());
			if(wk_1.getDay() == 1)
			{
				wk_1.setDate(wk_1.getDate()-7);
				break;
			}
		}
		//set week firt dat
		wk_1_y = wk_1.getFullYear();
		wk_1_m = wk_1.getMonth()+1;
		wk_1_d = wk_1.getDate();

		SetCookie("jk_wk_1",wk_1_y+"/"+wk_1_m+"/"+wk_1_d);
	}

/*********************defined by leeraphael  end**************************************/


// variable declarations
var w_d = new Date()
var w_monthname=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
var w_dayname = new Array("日","一","二","三","四","五","六");
var w_StartOfWeek = 1; // Monday

// image title
var prev_month_title = "Previous month";
var next_month_title = "Next month";
var close_title = "Close";


// set the default position
// for the week end days (Staurday,Sunday)
var weekend_pos = new Array(6,0);


var w_min_year = 1930;
var w_max_year = 2017;

var gx = 0;
var gy = 0;




var w_linkedInputText_1 = null;
var w_linkedInputText_2 = null;


var HideWeekCol = false;


//
//
//
function w_funMouseMove(evnt)
{
	gx = evnt.pageX;
	gy = evnt.pageY;
	//alert(evnt.pageX+""+evnt.pageY);
	return true;
}

//
// handle mousemove
//
if ((navigator.appName.indexOf("Netscape") != -1) || (navigator.appName.indexOf("Opera") != -1))
{
    if (document.onmousemove == undefined)
	    document.onmousemove = w_funMouseMove;
}

//
//
//
function w_changeMonth(id)
{
    var box = document.getElementById(id);
    var mm = box.options[box.selectedIndex].value;
    w_d.setMonth(mm);
    w_renderCalendar(0);
}

//
//
//
function w_changeYear(id)
{
    var box = document.getElementById(id);
    var yy = box.options[box.selectedIndex].value;
    w_d.setFullYear(yy);
    w_renderCalendar(0);
}

//
//
//
function w_getWeek(year,month,day){
    //Find JulianDay
    month += 1; //use 1-12
    var a = Math.floor((14-(month))/12);
    var y = year+4800-a;
    var m = (month)+(12*a)-3;

    var jd = day + Math.floor(((153*m)+2)/5) +
                 (365*y) + Math.floor(y/4) - Math.floor(y/100) +
                 Math.floor(y/400) - 32045;      // (gregorian calendar)

/*
    var jd = (day+1)+Math.round(((153*m)+2)/5)+(365+y) +
                     Math.round(y/4)-32083;    // (julian calendar)
*/

    //now calc weeknumber according to JD
    var d4 = (jd+31741-(jd%7))%146097%36524%1461;
    var L = Math.floor(d4/1460);
    var d1 = ((d4-L)%365)+L;
    NumberOfWeek = Math.floor(d1/7) + 1;
    return NumberOfWeek;
}

function w_writeDayNumber(d)
{
	var dd = new Date(d);
	var temp = new Date(d);

	// reset data array
	for (i=0;i<6;i++)
	{
 		for (j=0;j<7;j++)
 		{
			document.getElementById("w_c" +i+""+j).innerHTML= "";
			document.getElementById("w_c" +i+""+j).className = "day_out";
 	    }
        document.getElementById("week_" +i).innerHTML = '';
	}

	// set to the first day of the month
	dd.setDate(1);

	// fill data array
	i = 0;
	j = 0;

  // previous month's days
  j = dd.getDay() - w_StartOfWeek;
  if (j<0)
      j = 7 + j;

  if (j > 0)
  {
      temp.setDate(dd.getDate()-1);
      for (k=j-1; k>=0; k--)
      {
		document.getElementById("w_c" +i+""+k).innerHTML= temp.getDate();
	    if ((weekend_pos[0] == k) || (weekend_pos[1] == k))
	        document.getElementById("w_c" +i+""+k).className = "weekends_out";
	    else
		    document.getElementById("w_c" +i+""+k).className = "day_out";

          temp.setDate(temp.getDate()-1);
      }
  }

	var week = -1;
    var iStartWeek = -1;
    var iEndWeek = -1;
    var weekEl;
    var dayval;

	do
	{
    // get the position according to
    // StartOfWeek
    j = dd.getDay() - w_StartOfWeek;
    if (j<0)
        j = 7 + j;

    if (iStartWeek==-1)
        iStartWeek = j;
      iEndWeek = j;

	  dayval = dd.getDate();



    // get the week number
    if (week < 0)
        week = w_getWeek(w_d.getFullYear(), w_d.getMonth(), dayval);

		document.getElementById("w_c" +i+""+j).innerHTML= dayval;

		// set week ends layout
		if ((weekend_pos[0] == j) || (weekend_pos[1] == j))
		    document.getElementById("w_c" +i+""+j).className = "weekends";
		else
		    document.getElementById("w_c" +i+""+j).className = "day";
    {
   	  // set today layout
   	  var today = new Date();

  		if ((today.getDate() ==  dayval) && (today.getMonth() == w_d.getMonth()) && (today.getFullYear() == w_d.getFullYear()) )
  		{
  			//alert((today.getFullYear())+"/"+(today.getMonth()+1)+"/"+today.getDate()+"VS"+(w_d.getFullYear())+"/"+(w_d.getMonth()+1)+"/"+w_d.getDate())
  			document.getElementById("w_c" +i+""+j).className = "today";
  			document.getElementById("w_c" +i+""+j).style.background = "#FFFF80";
  			if(close_window == 1)
  			{
  				SetCookie("jk_schedule_d", today.getFullYear()+"/"+(today.getMonth()+1)+"/"+today.getDate());
  				SetCookie("jk_schedule_d_box", "w_c" +i+""+j);
				}
  		}
	  	else if((weekend_pos[0] == j) || (weekend_pos[1] == j))
	  	{
	  		document.getElementById("w_c" +i+""+j).style.background = "#FFCCCC";
	  	}
	  	else
			{
	  		document.getElementById("w_c" +i+""+j).style.background = "#FFFFFF";
	  	}
  	}

        ////////
        // dinamically set the onclick event
        // only on the day of the selected month
        ////////

        var object = document.getElementById("w_c" +i+""+j);
        object.rownumber = i;
        object.colnumber = j;

        if(window.addEventListener){ // Mozilla, Netscape, Firefox
	        object.addEventListener('click', w_setDate, false);
        }
        else { // IE
	        object.attachEvent('onclick', w_setDate);
					object.attachEvent('onmouseover', w_anime_over);
					object.attachEvent('onmouseout', w_anime_out);
        }

        ///////


	    if (week < 0)
	        document.getElementById("week_" +i).innerHTML = '';
	    else if (w_StartOfWeek != 1)
	        document.getElementById("week_" +i).innerHTML = "&lt;";
	    else
	        document.getElementById("week_" +i).innerHTML = week;

        weekEl = document.getElementById("week_" +i);

        // if HideWeekCol change the class
        // hide the week col and its header
        if (HideWeekCol)
        {
            weekEl.className = "weekhidden";
            document.getElementById("weekHeader").className = "weekhidden";
        }
        else
        {
            document.getElementById("weekHeader").className = "week";
            weekEl.className = "weeksel";
        }

		if (j == 6)
		{
            ////////
            // dinamically set the onclick event
            // on the week number
            ////////
            weekEl.startweek = iStartWeek;
            weekEl.endweek = iEndWeek;
            weekEl.rowweek = i;

            if(window.addEventListener){ // Mozilla, Netscape, Firefox
                weekEl.addEventListener('click', w_SetWeekDate, false);
            } else { // IE
                weekEl.attachEvent('onclick', w_SetWeekDate);
            }
            ///////

		    week = -1;
		    iStartWeek = -1;
		    iEndWeek = -1;
		    i++;
		}

		dd.setDate(dd.getDate() + 1);

	} while (dd.getDate() != 1);

	if ((iStartWeek!=-1) && (iEndWeek!=-1))
	{
        weekEl = document.getElementById("week_" +i);

        ////////
        // dinamically set the onclick event
        // on the week number
        ////////
        weekEl.startweek = iStartWeek;
        weekEl.endweek = iEndWeek;
        weekEl.rowweek = i;

        if(window.addEventListener){ // Mozilla, Netscape, Firefox
            weekEl.addEventListener('click', w_SetWeekDate, false);
        } else { // IE
            weekEl.attachEvent('onclick', w_SetWeekDate);
        }
        ///////
    }

    // next month's days
    if ((j < 7))
    {
        temp = dd;
        for (k=j+1; k<7; k++)
        {
			document.getElementById("w_c" +i+""+k).innerHTML= temp.getDate();
	        if ((weekend_pos[0] == k) || (weekend_pos[1] == k))
	            document.getElementById("w_c" +i+""+k).className = "weekends_out";
	        else
			    document.getElementById("w_c" +i+""+k).className = "day_out";
            temp.setDate(temp.getDate()+1);
        }
    }


}


//
// render calendar accordint to the selected
// month (k)
//
function w_renderCalendar(k)
{
    var monthsel_html='';

	w_d.setMonth(w_d.getMonth() + k);

    monthsel_html += '<select class="nav" id="w_sel_month" onchange="w_changeMonth(\'w_sel_month\')">';
    for (im=0; im < 12; im++)
    {
        monthsel_html += '<option value="' + im + '" ' + ((im == w_d.getMonth())?'selected ':'')+ '>'+ w_monthname[im] + '</option>';
    }
    monthsel_html += '</select>';
    monthsel_html += ' ';


    monthsel_html += '<select class="nav" id="w_sel_year" onchange="w_changeYear(\'w_sel_year\')">';
    for (im = w_min_year; im <= w_max_year; im++)
    {
        monthsel_html += '<option value="' + im + '" ' + ((im == w_d.getFullYear())?'selected ':'')+ '>'+ im + '</option>';
    }
    monthsel_html += '</select>';
    monthsel_html += ' ';

	document.getElementById('w_month_year').innerHTML = monthsel_html;

    // write days number
    w_writeDayNumber(w_d);
 }



//
// set clicked date
//
function w_setDate(evt)
{
	var m="";
	var g="";
	var mMonth;
	var mDay;
	var i,j;


	var e_out;
	var ie_var = "srcElement";
	var moz_var = "target";
	var prop_var = "rownumber";

	// "target" for Mozilla, Netscape, Firefox et al. ; "srcElement" for IE
	evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	i = e_out;
	prop_var = "colnumber";
	evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	j = e_out;

		mMonth = (w_d.getMonth()+1);
		mDay = document.getElementById("w_c"+i+j).innerHTML;
		//draw box
	if(close_window == 1)
	{
		if(GetCookie("jk_schedule_d_box").substring(4, 5)==5||GetCookie("jk_schedule_d_box").substring(4, 5)==6)
			document.getElementById(GetCookie("jk_schedule_d_box")).className = "weekends";
		else
			document.getElementById(GetCookie("jk_schedule_d_box")).className = "day";
		document.getElementById("w_c" +i+""+j).className = "today";
		SetCookie("jk_schedule_d_box", "w_c" +i+""+j);
	}
	if(mMonth<10)
		m = "0" + mMonth
	else
		m = mMonth

	if (mDay<10)
		g = "0" + mDay
	else
		g = mDay

	// for search Day
	wk_1.setMonth(w_d.getMonth());
	wk_1.setDate(mDay);
	wk_1.setFullYear(w_d.getFullYear());

	schedule_d.setMonth(w_d.getMonth());
	schedule_d.setDate(mDay);
	schedule_d.setFullYear(w_d.getFullYear());

  // set the selected date
  try
  {
		if(close_window == 0)
			document.getElementById(w_linkedInputText_1).value = w_d.getFullYear()+ "/" +m + "/" + g  ;

		//document.getElementById(w_linkedInputText_2).value = '';

	}
	catch(e){}

	//alert(w_d.getFullYear() + "/" + m + "/" + g + "       星期"+wk_1.getDay());
	if(close_window == 1)
	{
		if(wk_1.getDay() == 1)
		{
			//set week firt dat
			wk_1_y = wk_1.getFullYear();
			wk_1_m = wk_1.getMonth()+1;
			wk_1_d = wk_1.getDate();
			//set schedule day
			schedule_d_y = schedule_d.getFullYear();
			schedule_d_m = schedule_d.getMonth()+1;
			schedule_d_d = schedule_d.getDate();

			SetCookie("jk_wk_1",wk_1_y+"/"+wk_1_m+"/"+wk_1_d);
			SetCookie("jk_schedule_d", schedule_d_y+"/"+schedule_d_m+"/"+schedule_d_d);
			//	alert("星期一");
		}
		else
		{
			for(i=0;i<8;i++)
			{
				wk_1.setDate(wk_1.getDate()+1);
				//alert("星期:"+wk_1.getDay()+" 幾號:"+wk_1.getDate());
				if(wk_1.getDay() == 1)
				{
					wk_1.setDate(wk_1.getDate()-7);
					break;
				}
			}
			//set week firt dat
			wk_1_y = wk_1.getFullYear();
			wk_1_m = wk_1.getMonth()+1;
			wk_1_d = wk_1.getDate();
			//set schedule day
			schedule_d_y = schedule_d.getFullYear();
			schedule_d_m = schedule_d.getMonth()+1;
			schedule_d_d = schedule_d.getDate();

			SetCookie("jk_wk_1",wk_1_y+"/"+wk_1_m+"/"+wk_1_d);
			SetCookie("jk_schedule_d", schedule_d_y+"/"+schedule_d_m+"/"+schedule_d_d);


		}
	reload_fun()

	}
	if(close_window == 0)
	w_hiddenCalendar();
}

//
// set week start and end date
// in the selected month
//
function w_SetWeekDate(evt)
{
	var m="";
	var g="";
	var mMonth;
	var mDay;
	var result = '';
	var startW = '';
	var endW = '';


	var e_out;
	var ie_var = "srcElement";
	var moz_var = "target";
	var prop_var = "startweek";
    var istartWeek, iendWeek;
    var rowWeek;

	// "target" for Mozilla, Netscape, Firefox et al. ; "srcElement" for IE
	evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	istartWeek = e_out;
	prop_var = "endweek";
	evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	iendWeek = e_out;

	prop_var = "rowweek";
	evt[moz_var] ? e_out = evt[moz_var][prop_var] : e_out = evt[ie_var][prop_var];
	rowWeek = e_out;


    mMonth = (w_d.getMonth()+1);

    if(mMonth<10)
        m = "0" + mMonth
    else
        m = mMonth

    mDay = document.getElementById("w_c"+rowWeek+istartWeek).innerHTML;
    if (mDay<10)
	    g = "0" + mDay
    else
	    g = mDay

    startW = m + "/" + g + "/" + w_d.getFullYear();

    mDay = document.getElementById("w_c"+rowWeek+iendWeek).innerHTML;
    if (mDay<10)
	    g = "0" + mDay
    else
	    g = mDay

    endW = m + "/" + g + "/" + w_d.getFullYear();

    // set the selected date
    try
    {
    document.getElementById(w_linkedInputText_1).value = startW;
    document.getElementById(w_linkedInputText_2).value = endW;
    }
    catch(e)
    {};

    w_hiddenCalendar();
}

//
// display date picker
// hide the col week
//
function w_displayDatePicker(linkedId1)
{

	w_linkedInputText_1 = linkedId1;
	w_linkedInputText_2 = null;
	close_window = 0;

	if(close_window == 1)
	{
		document.getElementById('close_window').innerText = '';
	}
	else
	{
		document.getElementById('client_calendar').className = "client_calendar";
	}
	HideWeekCol = true;
    w_displayCal();
}

//
// display calendar
//
function w_displayCalendar(linkedId1, linkedId2)
{
	w_linkedInputText_1 = linkedId1;
	w_linkedInputText_2 = linkedId2;
	close_window = 1;

	if(close_window == 1)
	{
		document.getElementById('close_window').innerText = '';
	}
	else
	{
		document.getElementById('client_calendar').className = "client_calendar";
	}
	HideWeekCol = true;
    w_displayCal();
}


function w_displayCal()
{

	w_renderCalendar(0);
	if(navigator.userAgent.indexOf("MSIE") != -1)
	{
		if(close_window == 1)
		{
			weeklyCalendar.style.left=window_x+document.body.scrollLeft;
			weeklyCalendar.style.top=window_y+document.body.scrollTop;
		}
		else
		{
			weeklyCalendar.style.left=window.event.x+document.body.scrollLeft;
			weeklyCalendar.style.top=window.event.y+document.body.scrollTop;
		}
		//alert("x="+window.event.x+" y="+window.event.y)


	}
	else if ((navigator.appName.indexOf("Netscape") != -1) || (navigator.appName.indexOf("Opera") != -1))
	{
		document.getElementById('weeklyCalendar').style.left=gx + 5;
		document.getElementById('weeklyCalendar').style.top=gy + 5;
	}
	document.getElementById('weeklyCalendar').style.visibility = "visible";
}

//
// hidden calendar
//
function w_hiddenCalendar()
{
	document.getElementById('weeklyCalendar').style.visibility='hidden';


    // remove the attached events
    var i, j;
    var week;
    var daycol;

    for (i = 0; i < 7; i++)
    {
        // detach event from week element
        try
        {
            week = document.getElementById("week_" +i);
            if(window.removeEventListener()){ // Mozilla, Netscape, Firefox
	            week.removeEventListener('click', w_SetWeekDate, false);
            } else { // IE
	            week.detachEvent('onclick', w_SetWeekDate);
            }
        }
        catch(e){};

        // detach event from each day col
        try
        {
            for (j=0; j <7; j++)
            {
                daycol = document.getElementById("w_c" +i+""+j);
                if(window.removeEventListener()){ // Mozilla, Netscape, Firefox
	                daycol.removeEventListener('click', w_setDate, false);
                } else { // IE
	                daycol.detachEvent('onclick', w_setDate);
                }
            }
        }
        catch(e){};
    }

}


function w_writeDayname()
{
    var mDay;
    document.write('<tr>');
    for(wd =0; wd < 7; wd++)
    {
        mDay = wd + w_StartOfWeek;

        if (mDay > 6)
            mDay = mDay-7;
        document.write('<td class="wd">' + w_dayname[mDay] + '</td>');

        // set week ends postion
        if (mDay == 6)
            weekend_pos[0] = wd;
        if (mDay == 0)
            weekend_pos[1] = wd;

    }

    document.write('<td class="week" id="weekHeader">Week</td>');

    document.write('</tr>');
	//document.write('<tr><td colspan="7"><hr></td></tr>');

}

///
///
///
function buildWeeklyCalendar(WeekStart)
{
    if (WeekStart != undefined)
        w_StartOfWeek = WeekStart;

    document.write('<div id="weeklyCalendar" class="calendar">');
    document.write('<table class="calendar" >');
    document.write('<tr><td colspan="8">');
    // header table
    document.write('<table width="100%" cellpading="0" cellspacing="0">');

    document.write('<tr id="client_calendar" class="firstrow"><td></td>');
    document.write('<td></td>');
    document.write('<td colspan="4" id="w_month_year" align="center">');

    document.write('<select id="w_sel_month">');

    for (im=0; im < 12; im++)
    {
        document.write('<option value="' + im + '" ' + ((im == w_d.getMonth())?'selected ':'')+ '>'+ w_monthname[im] + '</option>');
    }
    document.write('</select>');
    document.write(' ');
    document.write('<select id="w_sel_year">');

    for (im = w_min_year; im <= w_max_year; im++)
    {
        document.write('<option value="' + im + '" ' + ((im == w_d.getFullYear())?'selected ':'')+ '>'+ im + '</option>');
    }
    document.write('</select>');

    document.write('</td>');


    document.write('<td id="close_window" align="center" onClick="w_hiddenCalendar()"><img src="./calendar_src/close.jpg" title="' + close_title + '" border="0"></td>');

    document.write('</tr>');

    document.write('</table>');
    // end header table

    document.write('</td></tr>');

    w_writeDayname();

    // init day/week number
    for (i=0;i<6;i++)
    {
	    document.write('  <tr>');

	    for (j=0;j<7;j++)
	    {
//	            document.write('<td onClick="w_setDate('+i+','+j+')" class="day_out" id="w_c' + i + j + '">&nbsp;</td>');
	            document.write('<td  class="day_out" onmouseover="return escape(\'This is area 1\')" id="w_c' + i + j + '">&nbsp;</td>');
	    }

//	    document.write('<td class="weeksel" id="week_'+ i + '" onClick="w_SetWeekDate(' + i + ')">&nbsp;Select&nbsp;</td>');
	    document.write('<td class="weeksel" id="week_'+ i + '">&nbsp;Select&nbsp;</td>');
	    document.write('  </tr>');
    }
    document.write('</table></div>');

}


