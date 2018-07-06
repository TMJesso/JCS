<?php
// connect to mysql database server either local or online
if ($_SERVER["SERVER_NAME"] == "localhost") {
	defined('DB_SERVER')	? null : define('DB_SERVER', 'localhost');
	defined('DB_USER')		? null : define('DB_USER', 'jkOP89x33');
	defined('DB_PASS')		? null : define('DB_PASS', 'Va3ILdAfsQWe2sQb');
	defined('DB_NAME')		? null : define('DB_NAME', '07012018_636c6164');
	defined('DB_PORT')		? null : define('DB_PORT', 3306);
	defined('DB_SOCKET')	? null : define('DB_SOCKET', null);
} elseif ($_SERVER["SERVER_NAME"] == "theraljessop.net" || $_SERVER["SERVER_NAME"] == "theraljessopnet.ipage.com") {
	defined('DB_SERVER')	? null : define('DB_SERVER', 'theraljessopnet.ipagemysql.com');
	defined('DB_USER')		? null : define('DB_USER', 'm9EeWXBlqjMDk0uR');
	defined('DB_PASS')		? null : define('DB_PASS', 'pJytASz8Cv94pGEk');
	defined('DB_NAME')		? null : define('DB_NAME', 'jcs');
	defined('DB_PORT')		? null : define('DB_PORT', 3306);
	defined('DB_SOCKET')	? null : define('DB_SOCKET', null);
}





?>
