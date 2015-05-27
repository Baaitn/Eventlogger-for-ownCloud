<?php
/*  */
OCP\App::checkAppEnabled('logger');
OCP\User::checkAdminUser();
script('logger', 'settings.admin');
style('logger', 'settings.admin');
$template = new OCP\Template('logger', 'settings.admin');
$defaultevents = '[{"name":"Login","settings":{"pre":false,"post":false}},{"name":"Logout","settings":{"post":false}},{"name":"Create","settings":{"pre":false,"post":true}},{"name":"Read","settings":{"post":true}},{"name":"Update","settings":{"pre":false,"post":true}},{"name":"Delete","settings":{"pre":false,"post":true}},{"name":"Rename","settings":{"pre":false,"post":false}},{"name":"Restore","settings":{"pre":false,"post":false}},{"name":"Share","settings":{"post":false}},{"name":"Unshare","settings":{"post":false}}]';
$template->assign('logger_events', OCP\Config::getAppValue('logger', 'events', $defaultevents));
$template->assign('logger_console', OCP\Config::getAppValue('logger', 'console', 'false'));
$template->assign('logger_database', OCP\Config::getAppValue('logger', 'database', 'true'));
return $template->fetchPage();
