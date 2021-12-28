<?php
//--------------------------------------
//initial && setting the CGI parameter
//--------------------------------------
	if (isset ($HTTP_SERVER_VARS))
	{
		$_SERVER = &$HTTP_SERVER_VARS;
	}
	    
	if (isset ($HTTP_GET_VARS))
	{
		$_GET = &$HTTP_GET_VARS;
	}
	
	if (isset ($HTTP_POST_VARS))
	{
	    	$_POST = &$HTTP_POST_VARS;
	}
	
	if (isset ($HTTP_COOKIE_VARS))
	{
	    	$_COOKIE = &$HTTP_COOKIE_VARS;
	}
	
	if (isset ($HTTP_POST_FILES))
	{
	    	$_FILES = &$HTTP_POST_FILES;
	}
	
	if (isset ($HTTP_ENV_VARS))
	{
	    	$_ENV = &$HTTP_ENV_VARS;
	}
	
	if (isset ($HTTP_SESSION_VARS))
	{
	    	$_SESSION = &$HTTP_SESSION_VARS;
	}
//--------------------------------------
//initial the global variables
//--------------------------------------	
	
	$n="<BR>";	

//--------------------------------------
//Mysql connection utility
//--------------------------------------
function ConnectMysql($p_type)
{	
	if ($p_type==TRUE)
	{
		$connection = new PDO('mysql:host=localhost;dbname=walktoschool;charset=utf8', 'root', 'root');
		return $connection;
	}
}

function DisconnectMysql($p_type,$connection)
{
	if ($p_type==TRUE)
	{
		$connection = null;
		return $connection;	
	}	
}
//--------------------------------------
//function TestDuplicate declaration 
//--------------------------------------
//return TRUE	: data Duplicate
//return FALSE	: NOT Duplicate (New)
//--------------------------------------
function TestDuplicate($p_conn,$p_sql)
{
	$result = $p_conn->query($p_sql);
	if ($result!=FALSE)
	{
		$data_arr=$result->fetch();
		if ($data_arr[0]>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}			
	}
	else
	{
		return FALSE; 
	}	
}
//--------------------------------------
//function DoTransaction declaration 
//--------------------------------------
//return TRUE	: Do Transaction Done and Commit
//return FALSE	: Do Transaction Fail and Rollback
//--------------------------------------
function DoTransaction($p_conn,$p_cmd_count,$p_sql_array)
{
	$p_conn->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
	
	for($i=0;$i<$p_cmd_count;$i++)
	{
		$result = $p_conn->query($p_sql_array[$i]);
		if (!$result)
		{
			$p_conn->rollBack();
			return FALSE;
		}
	}	
//	$p_conn->commit();
	return TRUE;	
}
?>