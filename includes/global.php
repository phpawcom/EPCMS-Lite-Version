<?PHP
/********************************************************************************
*                                 EPCMS Lite Version                            *
*                                   version: beta 1                             *
*                             Written By Abdulaziz Al Rashdi                    *
*                   http://www.alrashdi.co  |  https://github.com/phpawcom      *
*********************************************************************************/
ob_start();
@date_default_timezone_set('Asia/Muscat');
include('config.php');
include('class.main.php');
include('class.mysqli.php');
include('Mobile_Detect.php');
$detect = new Mobile_Detect;
$db = new database($configDatabase['server'], 
                   $configDatabase['username'], 
				   $configDatabase['password'], 
				   $configDatabase['dbname'], 
				   $configDatabase['prefix']);
$script = new main($db);
$script->buildScriptVars();
include('languages/'.$script->setLanguage());
$configSettings['path'] = $script->script_path();
$script->buildScriptVars();


?>