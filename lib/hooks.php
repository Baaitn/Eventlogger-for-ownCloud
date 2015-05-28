<?php

class hooks {

    /**A class to handle and process each hook.
     * 
     * How it works:
     * After a hook is emitted that is registered in appinfo/app.php, the corresponding handler in lib/hooks.php gets executed.
     * Properties get collected and log() is called. Here we check if it is a hook that should be logged according to settings. If it should, everything gets passed on to write(). 
     * There we write to the console and/or database, depending on what is enabled in the adminsettings.
     */
    
    //Helpers
    static private function log($prefix, $action, $message, $type, $path, $newpath, $sharedwith, $owner, $user, $ip) {
        $defaultevents = '[{"action":"Login","settings":{"pre":false,"post":false}},{"action":"Logout","settings":{"post":false}},{"action":"Create","settings":{"pre":false,"post":true}},{"action":"Read","settings":{"post":true}},{"action":"Update","settings":{"pre":false,"post":true}},{"action":"Rename","settings":{"pre":false,"post":true}},{"action":"Copy","settings":{"pre":false,"post":false}},{"action":"Trash","settings":{"pre":true,"post":true}},{"action":"PermaDelete","settings":{"pre":false,"post":true}},{"action":"Share","settings":{"post":false}},{"action":"Unshare","settings":{"post":false}}]';
        $events = (array) json_decode(OCP\Config::getAppValue('logger', 'events', $defaultevents));
        foreach ($events as $key => $val) {
            if ($val->action === $action && $val->settings->$prefix) {
                self::write($prefix.$action, $message, $type, $path, $newpath, $sharedwith, $owner, $user, $ip);
            }
        }
    }
    static private function write($event, $message, $type, $path, $newpath, $sharedwith, $owner, $user, $ip) {
        if (self::toConsole()) {
            OCP\Util::writeLog('logger', $message, OCP\Util::INFO);
        }
        if (self::toDatabase()) {
            $time = date('c'); //Use 'U' with int(11) [unix timestamp], 'c' with datetime, change this in /appinfo/database.xml
            $query = OCP\DB::prepare('INSERT INTO `*PREFIX*logs` (`time`, `event`, `message`, `type`, `path`, `newpath`, `with`, `owner`, `user`, `ip`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query->execute(array($time, $event, $message, $type, $path, $newpath, $sharedwith, $owner, $user, $ip));
        }
    }
    static private function toConsole() {
        if (\OCP\Config::getAppValue('logger', 'console', 'false') === 'true') {
            return true;
        } else {
            return false;
        }
    }
    static private function toDatabase() {
        if (\OCP\Config::getAppValue('logger', 'database', 'true') === 'true') {
            return true;
        } else {
            return false;
        }
    }

    //Handlers
    static public function preLogin($params) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $pass = $params['password'];
        $user = $params['uid'];
        $message = $user . ' attempted to log into ownCloud from ' . $ip;
        self::log('pre', 'Login', $message, null, null, null, null, null, $user, $ip);
    }
    static public function postLogin($params) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $pass = $params['password'];
        $user = $params['uid']; //OCP\User::getUser();
        $message = $user . ' logged into ownCloud from ' . $ip;
        self::log('post', 'Login', $message, null, null, null, null, null, $user, $ip);
    }
    static public function postLogout($params) {
        $user = OCP\User::getUser();
        $message = $user . ' logged out of ownCloud';
        self::log('post', 'Logout', $message, null, null, null, null, null, $user, null);
    }
    static public function preTouch($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Touch', $message, null, $path, null, null, null, $user, null);
    }
    static public function postTouch($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('post', 'Touch', $message, null, $path, null, null, null, $user, null);
    }
    static public function preCreate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Create', $message, null, $path, null, null, null, $user, null);
    }
    static public function postCreate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' has created or uploaded \'' . substr($path, 1) . '\'';
        self::log('post', 'Create', $message, null, $path, null, null, null, $user, null);
    }
    static public function postRead($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' has downloaded or read \'' . substr($path, 1) . '\'';
        self::log('post', 'Read', $message, null, $path, null, null, null, $user, null);
    }
    static public function preWrite($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Write', $message, null, $path, null, null, null, $user, null);
    }
    static public function postWrite($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('post', 'Write', $message, null, $path, null, null, null, $user, null);
    }
    static public function preUpdate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Update', $message, null, $path, null, null, null, $user, null);
    }
    static public function postUpdate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' has modified \'' . substr($path, 1) . '\'';
        self::log('post', 'Update', $message, null, $path, null, null, null, $user, null);
    }
    static public function preDelete($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Delete', $message, null, $path, null, null, null, $user, null);
    }
    static public function postDelete($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' has deleted \'' . substr($path, 1) . '\'';
        self::log('post', 'Delete', $message, null, $path, null, null, null, $user, null);
    }
    static public function preRename($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Rename', $message, null, $oldpath, $newpath, null, null, $user, null);
    }
    static public function postRename($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = $user . ' has renamed \'' . substr($oldpath, 1) . '\' to \'' . substr($newpath, 1) . '\'';
        self::log('post', 'Rename', $message, null, $oldpath, $newpath, null, null, $user, null);
    }
    static public function preCopy($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'Copy', $message, null, $oldpath, $newpath, null, null, $user, null);
    }
    static public function postCopy($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = $user . ' has copied \'' . substr($oldpath, 1) . '\' to \'' . substr($newpath, 1) . '\'';
        self::log('post', 'Copy', $message, null, $oldpath, $newpath, null, null, $user, null);
    }
    static public function preRestore($params) {
        //Reserved for 'restoring previous versions'
    }
    static public function postRestore($params) {
        //Reserved for 'restoring previous versions'
    }
    static public function preTrash($params){
        $filepath = $params['filePath'];
        $trashpath = $params['trashPath'];
        $user = OCP\User::getUser();
        $message = $user . ' has moved \'' . substr($filepath, 1) . '\' to the trashbin';;
        self::log('pre', 'Trash', $message, null, $filepath, $trashpath, null, null, $user, null);
    }
    static public function postTrash($params){
        $filepath = $params['filePath'];
        $trashpath = $params['trashPath'];
        $user = OCP\User::getUser();
        $message = $user . ' has restored \'' . substr($filepath, 1) . '\' from the trashbin';
        self::log('post', 'Trash', $message, null, $filepath, $trashpath, null, null, $user, null);
    }
    static public function prePermaDelete($params){
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = null;
        self::log('pre', 'PermaDelete', $message, null, $path, null, null, null, $user, null);
    }
    static public function postPermaDelete($params){
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' has permanently deleted \'' . substr($path, 1) . '\'';
        self::log('post', 'PermaDelete', $message, null, $path, null, null, null, $user, null);
    }
    static public function postShare($params) {
        $type = $params['itemType'];
        $path = $params['fileTarget'];
        $with = $params['shareWith'];
        $owner = $params['uidOwner'];
        $user = OCP\User::getUser();
        $message = 'The ' . $type . ' \'' . substr($path, 1) . '\' has been shared with ' . $with . ' by ' . $user;
        self::log('post', 'Share', $message, $type, $path, null, $with, $owner, $user, null);
    }
    static public function postUnshare($params) {
        $type = $params['itemType'];
        $path = $params['fileTarget'];
        $with = $params['shareWith'];
        $owner = $params['uidOwner'];
        $user = OCP\User::getUser();
        $message = 'The ' . $type . ' \'' . substr($path, 1) . '\' has been unshared with ' . $with . ' by ' . $user;
        self::log('post', 'Unshare', $message, $type, $path, null, $with, $owner, $user, null);
    }
    
}
