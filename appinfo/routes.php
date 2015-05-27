<?php
/**
 * ownCloud - Logger
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bert Maerten <maerten.bert@outlook.com>
 * @copyright Bert Maerten 2015
 */

/**
 * Routing for AJAX calls
 */
$this->create('logger_ajax_settings_admin', 'ajax/settings.admin.php')->actionInclude('logger/ajax/settings.admin.php');
$this->create('logger_ajax_settings_admin_events', 'ajax/settings.admin.events.php')->actionInclude('logger/ajax/settings.admin.events.php');

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Logger\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
        ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
        ['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
    ]
];
