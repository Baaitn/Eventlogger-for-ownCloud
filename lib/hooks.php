<?php

class hooks {

    //Helpers
    static private function log($message, $action, $type, $path, $newpath, $with, $user, $ip, $owner) {
        if (self::toConsole()) {
            OCP\Util::writeLog('logger', $message, OCP\Util::INFO);
        }
        if (self::toDatabase()) {
            $time = date('c'); //Use 'U' with int(11) [unix timestamp], 'c' with datetime, change this in /appinfo/database.xml
            $query = OCP\DB::prepare('INSERT INTO `*PREFIX*logs` (`time`, `message`, `action`, `type`, `path`, `newpath`, `with`, `user`, `ip`, `owner`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query->execute(array($time, $message, $action, $type, $path, $newpath, $with, $user, $ip, $owner));
        }
    }
    static private function toConsole() {
        if (\OCP\Config::getAppValue('logger', 'console', 'true') === 'true') {
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
    static public function bLogin($params) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $pass = $params['password'];
        $user = $params['uid'];
        $message = $user . ' attempted to log into ownCloud from ' . $ip;
        self::log($message, 'preLogin', null, null, null, null, $user, $ip, null);
    }
    static public function aLogin($params) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $pass = $params['password'];
        $user = $params['uid']; //OCP\User::getUser();
        $message = $user . ' logged into ownCloud from ' . $ip;
        self::log($message, 'postLogin', null, null, null, null, $user, $ip, null);
    }
    static public function  Logout($params) {
        $user = OCP\User::getUser();
        $message = $user . ' logged out of ownCloud';
        self::log($message, 'Logout', null, null, null, null, $user, null, null);
    }
    static public function bTouch($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to touch ' . $path;
        self::log($message, 'preTouch', null, $path, null, null, $user, null, null);
    }
    static public function aTouch($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' touched ' . $path;
        self::log($message, 'postTouch', null, $path, null, null, $user, null, null);
    }
    static public function bCreate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to create ' . $path;
        self::log($message, 'preCreate', null, $path, null, null, $user, null, null);
    }
    static public function aCreate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' created ' . $path;
        self::log($message, 'postCreate', null, $path, null, null, $user, null, null);
    }
    static public function  Read($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' read ' . $path;
        self::log($message, 'Read', null, $path, null, null, $user, null, null);
    }
    static public function bWrite($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to write to ' . $path;
        self::log($message, 'preWrite', null, $path, null, null, $user, null, null);
    }
    static public function aWrite($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' wrote to ' . $path;
        self::log($message, 'postWrite', null, $path, null, null, $user, null, null);
    }
    static public function bUpdate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to update ' . $path;
        self::log($message, 'preUpdate', null, $path, null, null, $user, null, null);
    }
    static public function aUpdate($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' updated ' . $path;
        self::log($message, 'postUpdate', null, $path, null, null, $user, null, null);
    }
    static public function bDelete($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to delete ' . $path;
        self::log($message, 'preDelete', null, $path, null, null, $user, null, null);
    }
    static public function aDelete($params) {
        $path = $params['path'];
        $user = OCP\User::getUser();
        $message = $user . ' deleted ' . $path;
        self::log($message, 'postDelete', null, $path, null, null, $user, null, null);
    }
    static public function bRename($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to rename ' . $oldpath . ' to ' . $newpath;
        self::log($message, 'preRename', null, $oldpath, $newpath, null, $user, null, null);
    }
    static public function aRename($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = $user . ' renamed ' . $oldpath . ' to ' . $newpath;
        self::log($message, 'postRename', null, $oldpath, $newpath, null, $user, null, null);
    }
    static public function bCopy($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to copy ' . $oldpath . ' to ' . $newpath;
        self::log($message, 'preCopy', null, $oldpath, $newpath, null, $user, null, null);
    }
    static public function aCopy($params) {
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        $user = OCP\User::getUser();
        $message = $user . ' copied ' . $oldpath . ' to ' . $newpath;
        self::log($message, 'postCopy', null, $oldpath, $newpath, null, $user, null, null);
    }
    static public function bRestore($params) {
        $filepath = $params['filePath'];
        $trashpath = $params['trashPath'];
        $user = OCP\User::getUser();
        $message = $user . ' attempted to restore ' . $filepath . ' to ' . $trashpath;
        self::log($message, 'preRestore', null, $filepath, $trashpath, null, $user, null, null);
    }
    static public function aRestore($params) {
        $filepath = $params['filePath'];
        $trashpath = $params['trashPath'];
        $user = OCP\User::getUser();
        $message = $user . ' restored ' . $filepath . ' to ' . $trashpath;
        self::log($message, 'postRestore', null, $filepath, $trashpath, null, $user, null, null);
    }
    static public function  Share($params) {
        $type = $params['itemType'];
        $path = $params['fileTarget'];
        $with = $params['shareWith'];
        $owner = $params['uidOwner'];
        $user = OCP\User::getUser();
        $message = $type . ' \'' . substr($path, 1) . '\' has been shared with ' . $with . ' by ' . $user;
        self::log($message, 'Share', $type, $path, null, $with, $user, null, $owner);
    }
    static public function  Unshare($params) {
        $type = $params['itemType'];
        $path = $params['fileTarget'];
        $with = $params['shareWith'];
        $owner = $params['uidOwner'];
        $user = OCP\User::getUser();
        $message = 'The ' . $type . ' \'' . substr($path, 1) . '\' has been unshared with ' . $with . ' by ' . $user;
        self::log($message, 'Unshare', $type, $path, null, $with, $user, null, $owner);
    }

}
