<?php
/*  */
OCP\App::checkAppEnabled('logger');
OCP\User::checkAdminUser();
script('logger', 'settings.admin');
style('logger', 'settings.admin');
$template = new OCP\Template('logger', 'settings.admin');
$template->assign('logger_console', OCP\Config::getAppValue('logger', 'console', 'true'));
$template->assign('logger_database', OCP\Config::getAppValue('logger', 'database', 'true'));
return $template->fetchPage();
