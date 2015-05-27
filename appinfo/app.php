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

namespace OCA\Logger\AppInfo;

use OCP\Util;
use OCP\App;

/** 
 * Connect hooks
 * 
 * INFO: OCP\Util::connectHook(string $signalClass, string $signalName, string $slotClass, string $slotName);
 * $signalClass     Class name of emitter
 * $signalName      Name of signal
 * $slotClass       Class name of slot
 * $slotName        Name of the method that will be called when registered signal is emitted 
 */
\OC::$CLASSPATH['hooks'] = 'logger/lib/hooks.php';
    //Usermanagement
Util::connectHook('OC_User', 'pre_login', 'hooks', 'bLogin');
Util::connectHook('OC_User', 'post_login', 'hooks', 'aLogin');
Util::connectHook('OC_User', 'logout', 'hooks', 'Logout');
    //Filesystem
Util::connectHook('OC_Filesystem', 'touch', 'hooks', 'bTouch');
Util::connectHook('OC_Filesystem', 'post_touch', 'hooks', 'aTouch');
Util::connectHook('OC_Filesystem', 'create', 'hooks', 'bCreate');
Util::connectHook('OC_Filesystem', 'post_create', 'hooks', 'aCreate');
Util::connectHook('OC_Filesystem', 'read', 'hooks', 'Read');
Util::connectHook('OC_Filesystem', 'write', 'hooks', 'bWrite');
Util::connectHook('OC_Filesystem', 'post_write', 'hooks', 'aWrite');
Util::connectHook('OC_Filesystem', 'update', 'hooks', 'bUpdate');
Util::connectHook('OC_Filesystem', 'post_update', 'hooks', 'aUpdate');
Util::connectHook('OC_Filesystem', 'delete', 'hooks', 'bDelete');
Util::connectHook('OC_Filesystem', 'post_delete', 'hooks', 'aDelete');
Util::connectHook('OC_Filesystem', 'rename', 'hooks', 'bRename');
Util::connectHook('OC_Filesystem', 'post_rename', 'hooks', 'aRename');
Util::connectHook('OC_Filesystem', 'copy', 'hooks', 'bCopy');
Util::connectHook('OC_Filesystem', 'post_copy', 'hooks', 'aCopy');
    //Trashbin
Util::connectHook('\OCA\Files_Trashbin\Trashbin', 'restore', 'hooks', 'bRestore');
Util::connectHook('\OCA\Files_Trashbin\Trashbin', 'post_restore', 'hooks', 'aRestore');
    //Sharing
Util::connectHook('OCP\Share', 'post_shared', 'hooks', 'Share');
Util::connectHook('OCP\Share', 'post_unshare', 'hooks', 'Unshare');

/** 
 *  Register the configuration screens that should appear in the admin & personal section.
 */
App::registerAdmin('logger', 'settings.admin');

/** 
 *  Add an entry to the navigation
 */
//App::addNavigationEntry([
//    // the string under which your app will be referenced in owncloud
//    'id' => 'logger',
//    // sorting weight for the navigation. The higher the number, the higher
//    // will it be listed in the navigation
//    'order' => 10,
//    // the route that will be shown on startup
//    'href' => \OCP\Util::linkToRoute('logger.page.index'),
//    // the icon that will be shown in the navigation
//    // this file needs to exist in img/
//    'icon' => \OCP\Util::imagePath('logger', 'app.svg'),
//    // the title of your application. This will be used in the
//    // navigation or on the settings page of your app
//    'name' => \OC_L10N::get('logger')->t('Logger')
//]);
