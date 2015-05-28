<?php
/*  */
OCP\App::checkAppEnabled('logger');
OCP\User::checkAdminUser();
script('logger', 'settings.admin');
style('logger', 'settings.admin');
$template = new OCP\Template('logger', 'settings.admin');
$defaultevents = '[{"action":"Login","settings":{"pre":false,"post":false}},{"action":"Logout","settings":{"post":false}},{"action":"Create","settings":{"pre":false,"post":true}},{"action":"Read","settings":{"post":true}},{"action":"Update","settings":{"pre":false,"post":true}},{"action":"Rename","settings":{"pre":false,"post":true}},{"action":"Copy","settings":{"pre":false,"post":false}},{"action":"Trash","settings":{"pre":true,"post":true}},{"action":"PermaDelete","settings":{"pre":false,"post":true}},{"action":"Share","settings":{"post":false}},{"action":"Unshare","settings":{"post":false}}]';
$template->assign('logger_events', OCP\Config::getAppValue('logger', 'events', $defaultevents));
$template->assign('logger_console', OCP\Config::getAppValue('logger', 'console', 'false'));
$template->assign('logger_database', OCP\Config::getAppValue('logger', 'database', 'true'));
return $template->fetchPage();
