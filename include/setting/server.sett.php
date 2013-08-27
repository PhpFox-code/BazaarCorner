<?php

/**

 * [PHPFOX_HEADER]

 * 

 * @copyright		[PHPFOX_COPYRIGHT]

 * @author			natio

 * @package 		PhpFox

 * @version 		$Id: server.sett.php.new 2619 2011-05-20 19:03:14Z Raymond_Benc $

 */



defined('PHPFOX') or exit('NO DICE!');



/**

 * Database Driver

 * Support: mysql, mysqli, mssql, postgres or sqlite

 * 

 * @example mysql

 */

$_CONF['db']['driver'] = 'mysql';

$_CONF['db']['host'] = 'localhost'; 

//$_CONF['db']['user'] = 'bazaar_main';
$_CONF['db']['user'] = 'root';


$_CONF['db']['pass'] = 'not4anyone';
//$_CONF['db']['pass'] = '';

$_CONF['db']['name'] = 'bazaar_main2';

$_CONF['db']['prefix'] = 'phpfox_';

$_CONF['db']['port'] = '';



$_CONF['db']['slave'] = false;

$_CONF['db']['slave_servers'] = array();



$_CONF['balancer']['enabled'] = false;

$_CONF['balancer']['servers'] = array();



//$_CONF['core.host'] = 'bazaarcorner.com';
$_CONF['core.host'] = 'edbiler.bazaarcorner.com';



$_CONF['core.folder'] = '/';



//$_CONF['core.url_rewrite'] = '1';
$_CONF['core.url_rewrite'] = '2';



$_CONF['core.salt'] = '47d77926c5ee09470148117256489ea4';



// Storage Engine (file, memcache)

$_CONF['core.cache_storage'] = 'file';



// Add salt

$_CONF['core.cache_add_salt'] = false;



// Cache suffix (file only)

$_CONF['core.cache_suffix'] = '.php';



// Memcache Hosts

$_CONF['core.memcache_hosts'] = array();



// Memcahe persistent

$_CONF['core.memcache_persistent'] = false;



// Should we skip the cache check and display live content

$_CONF['core.cache_skip'] = false;



// Check we run to find out if the script has been installed

$_CONF['core.is_installed'] = true;



// Check we run when the database tables have been installed

$_CONF['core.db_table_installed'] = false;



// AdminCP time out in minutes

$_CONF['core.admincp_timeout'] = '60';



// Define if AdminCP should have a time out

$_CONF['core.admincp_do_timeout'] = false;



?>
