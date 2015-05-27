<?php

OCP\JSON::checkAppEnabled('logger');
OCP\JSON::checkAdminUser();
OCP\JSON::callCheck();

$console = filter_input(INPUT_POST, 'console');
$database = filter_input(INPUT_POST, 'database');
$events = filter_input(INPUT_POST, 'events');

$l = OCP\Util::getL10N('logger'); //$l = OC::$server->getL10N('logger'); //$l=OC_L10N::get('logger');
if(OCP\Config::setAppValue('logger', 'console', $console) && OCP\Config::setAppValue('logger', 'database', $database) && OCP\Config::setAppValue('logger', 'events', $events)) {
    OCP\JSON::success(array('data' => array('message' => $l->t('Settings saved'))));
} else {
    OCP\JSON::error(array('data' => array('message' => $l->t('Could not save settings'))));
}
