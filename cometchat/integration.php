<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','1');	// Set to 1 if you do not want to destroy session on logout
define('ADD_LAST_ACTIVITY',	'1'	);		// Do not touch
define('SWITCH_ENABLED','1');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

define('PHPFOX', false);
define('PHPFOX_DS', DIRECTORY_SEPARATOR);
define('PHPFOX_DIR', dirname(dirname(__FILE__)) . PHPFOX_DS);
define('PHPFOX_NO_SESSION', true);

require_once (dirname(dirname(__FILE__))."/include/setting/server.sett.php");

// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',					$_CONF['db']['host']					);
define('DB_PORT',					'3306'									);
define('DB_USERNAME',				$_CONF['db']['user']					);
define('DB_PASSWORD',				$_CONF['db']['pass']					);
define('DB_NAME',					$_CONF['db']['name']					);
define('TABLE_PREFIX',				$_CONF['db']['prefix']					);
define('DB_USERTABLE',				'user'									);
define('DB_USERTABLE_NAME',			'full_name'					  	 		);
define('DB_USERTABLE_USERID',		'user_id'								);
define('DB_USERTABLE_LASTACTIVITY',	'cclastactivity'						);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
	$userid = 0;

	require_once PHPFOX_DIR . 'include' . PHPFOX_DS . 'init.inc.php';	
	$id = Phpfox::getUserBy('user_id');

	if (!empty($id)) {
		$userid = $id;
	}

	return $userid;
}


function getFriendsList($userid,$time) {
	$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".user_name link, ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX."friend join ".TABLE_PREFIX.DB_USERTABLE." on  ".TABLE_PREFIX."friend.friend_user_id = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX."friend.user_id = '".mysql_real_escape_string($userid)."'  order by username asc");

	if (defined('DISPLAY_ALL_USERS') && DISPLAY_ALL_USERS == 1) {
		$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".user_name link, ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." <> '".mysql_real_escape_string($userid)."' and ('".$time."'-".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY."<'".((ONLINE_TIMEOUT)*2)."')  order by username asc");
	}
 

	return $sql;
}

function getUserDetails($userid) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".user_name link,  ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function updateLastActivity($userid) {
	$sql = ("update `".TABLE_PREFIX.DB_USERTABLE."` set ".DB_USERTABLE_LASTACTIVITY." = '".getTimeStamp()."' where ".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	 return $sql;
}

function getLink($link) {
    return BASE_URL.'../index.php?do=/'.$link.'/';
}

function getAvatar($image) {
	$image = str_replace('%s','_50',$image);
    if (is_file(dirname(dirname(__FILE__)).'/file/pic/user/'.$image)) {
        return BASE_URL.'../file/pic/user/'.$image;
    } else {
        return BASE_URL.'../static/image/misc/noimage_50.png';
    }
}

function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
	$sql = ("insert into ".TABLE_PREFIX."feed (type_id,user_id,item_id,content,time_stamp) values ('user_status','".mysql_real_escape_string($userid)."','2','".mysql_real_escape_string(sanitize_core($statusmessage))."','".getTimeStamp()."')");
	$query = mysql_query($sql);

	$sql = ("update ".TABLE_PREFIX.DB_USERTABLE." set status = '".mysql_real_escape_string(sanitize_core($statusmessage))."' where user_id = '".mysql_real_escape_string($userid)."'");
	$query = mysql_query($sql);
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */
/* Nulled */

$p_ = 4;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////