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
?>

<div id="logger" class="section">
    <h2><?php p($l->t('Eventlogger')); ?></h2>
    <table id="events" class="grid">
        <thead>
            <tr>
                <th class="small group" data-select-group="pre"><?php p($l->t('Before')); ?></th>
                <th class="small group" data-select-group="post"><?php p($l->t('After')); ?></th>
                <th><span class="msg"></span></th>
            </tr>
        </thead>
        <tbody>
            <?php $events = (array) json_decode(OCP\Config::getAppValue('logger', 'events', null));  
            while (list($key, $val) = each($events)): ?>
                <?php if ($val->name === 'Login'): ?>
                    <tr name="Login">
                        <td class="small"><label for="preLogin"><input type="checkbox" id="preLogin" name="preLogin" class="pre Login" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postLogin"><input type="checkbox" id="postLogin" name="postLogin" class="post Login" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Login"><?php p($l->t('Login')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Logout'): ?>
                    <tr name="Logout">
                        <td class="small"></td>
                        <td class="small"><label for="postLogout"><input type="checkbox" id="postLogout" name="postLogout" class="post Logout" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Logout"><?php p($l->t('Logout')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Create'): ?>
                    <tr name="Create">
                        <td class="small"><label for="preCreate"><input type="checkbox" id="preCreate" name="preCreate" class="pre Create" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postCreate"><input type="checkbox" id="postCreate" name="postCreate" class="post Create" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Create"><?php p($l->t('Create')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Read'): ?>
                    <tr name="Read">
                        <td class="small"></td>
                        <td class="small"><label for="postRead"><input type="checkbox" id="postRead" name="postRead" class="post Read" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Read"><?php p($l->t('Read')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Update'): ?>
                    <tr name="Update">
                        <td class="small"><label for="preUpdate"><input type="checkbox" id="preUpdate" name="preUpdate" class="pre Update" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postUpdate"><input type="checkbox" id="postUpdate" name="postUpdate" class="post Update" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Update"><?php p($l->t('Update')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Delete'): ?>
                    <tr name="Delete">
                        <td class="small"><label for="preDelete"><input type="checkbox" id="preDelete" name="preDelete" class="pre Delete" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postDelete"><input type="checkbox" id="postDelete" name="postDelete" class="post Delete" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Delete"><?php p($l->t('Delete')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Rename'): ?>
                    <tr name="Rename">
                        <td class="small"><label for="preRename"><input type="checkbox" id="preRename" name="preRename" class="pre Rename" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postRename"><input type="checkbox" id="postRename" name="postRename" class="post Rename" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Rename"><?php p($l->t('Rename')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Restore'): ?>
                    <tr name="Restore">
                        <td class="small"><label for="preRestore"><input type="checkbox" id="preRestore" name="preRestore" class="pre Restore" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postRestore"><input type="checkbox" id="postRestore" name="postRestore" class="post Restore" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Restore"><?php p($l->t('Restore')); ?></td>
                    </tr>
                <?php endif; ?>   
                <?php if ($val->name === 'Share'): ?>
                    <tr name="Share">
                        <td class="small"></td>
                        <td class="small"><label for="postShare"><input type="checkbox" id="postShare" name="postShare" class="post Share" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Share"><?php p($l->t('Share')); ?></td>
                    </tr>
                <?php endif; ?>                   
                <?php if ($val->name === 'Unshare'): ?>
                    <tr name="Unshare">
                        <td class="small"></td>
                        <td class="small"><label for="postUnshare"><input type="checkbox" id="postUnshare" name="postUnshare" class="post Unshare" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Unshare"><?php p($l->t('Unshare')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->name === 'Event'): ?>
                    <tr name="<?php p($val->name) ?>">
                        <td class="small"><label for="post<?php p($val->name) ?>"><input type="checkbox" id="post<?php p($val->name) ?>" name="post<?php p($val->name) ?>" class="post <?php p($val->name) ?>" <?php if ($val->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="post<?php p($val->name) ?>"><input type="checkbox" id="post<?php p($val->name) ?>" name="post<?php p($val->name) ?>" class="post <?php p($val->name) ?>" <?php if ($val->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="<?php p($val->name) ?>"><?php p($l->t($val->name)); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endwhile; ?> 
            
            <?php 
            //<editor-fold defaultstate="collapsed" desc="demo: list($key, $val) = each($arrays)">
            //$arrays = (array) json_decode(OCP\Config::getAppValue('logger', 'events', null), true);
            ////foreach ($arrays as $array) { 
            ////    var_dump($array['name']);
            ////    var_dump($array['settings']['pre']); 
            ////    var_dump($array['settings']['post']);
            ////} 
            //while (list($key, $val) = each($arrays)) {
            //    var_dump('$key : ' . $key);
            //    var_dump('$val : ' . $val); //$array
            //    var_dump($val['name']);
            //    if ($val['name'] === 'Login') {
            //        echo 'Login';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Logout') {
            //        echo 'Logout';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Create') {
            //        echo 'Create';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Read') {
            //        echo 'Read';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Update') {
            //        echo 'Update';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Delete') {
            //        echo 'Delete';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Rename') {
            //        echo 'Rename';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Restore') {
            //        echo 'Restore';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Share') {
            //        echo 'Share';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //    if ($val['name'] === 'Unshare') {
            //        echo 'Unshare';
            //        var_dump($val['settings']['pre']); 
            //        var_dump($val['settings']['post']);
            //    }
            //}
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="demo: list($key, $val) = each($objects)">
            //$objects = (array) json_decode(OCP\Config::getAppValue('logger', 'events', null), false);  
            ////foreach ($objects as $object) { 
            ////    var_dump($object->name);
            ////    var_dump($object->settings->pre); 
            ////    var_dump($object->settings->post);  
            ////}
            //while (list($key, $val) = each($objects)) {
            //    var_dump('$key : ' . $key);
            //    var_dump('$val : ' . $val); //$object
            //    var_dump($val->name);
            //    if ($val->name === 'Login') {
            //        echo 'Login';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Logout') {
            //        echo 'Logout';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Create') {
            //        echo 'Create';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Read') {
            //        echo 'Read';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Update') {
            //        echo 'Update';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Delete') {
            //        echo 'Delete';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Rename') {
            //        echo 'Rename';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Restore') {
            //        echo 'Restore';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Share') {
            //        echo 'Share';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //    if ($val->name === 'Unshare') {
            //        echo 'Unshare';
            //        var_dump($val->settings->pre); 
            //        var_dump($val->settings->post);
            //    }
            //}
            //</editor-fold>
            ?>
            <?php foreach ($events as $event): ?>
            <!-- 
            Why not use a foreach?
            It won't work if the description is more advanced than just the event's name, unless you use some kind of dictionary with the name as key and description as value.
            Also, some events need only a checkbox on the 'post' since a 'pre' does not exist, in other words: you'll need to check for non-existing events.
            -->
                <tr name="<?php p($event->name) ?>">
                    <td class="small"><label for="post<?php p($event->name) ?>"><input type="checkbox" id="post<?php p($event->name) ?>" name="post<?php p($event->name) ?>" class="post <?php p($event->name) ?>" <?php if ($event->settings->pre === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                    <td class="small"><label for="post<?php p($event->name) ?>"><input type="checkbox" id="post<?php p($event->name) ?>" name="post<?php p($event->name) ?>" class="post <?php p($event->name) ?>" <?php if ($event->settings->post === 'true'): ?> checked="checked"<?php endif; ?>/></label></td>
                    <td class="group" data-select-group="<?php p($event->name) ?>"><?php p($l->t($event->name)); ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <br/>
    <input id="logger_console" name="logger_console" type="checkbox" <?php if ($_['logger_console'] === 'true') { print_unescaped(' checked="checked"'); } ?>/>
    <label for="logger_console"><?php p($l->t('Console')); ?></label><br/>
    <input id="logger_database" name="logger_database" type="checkbox" <?php if ($_['logger_database'] === 'true') { print_unescaped(' checked="checked"'); } ?>/>
    <label for="logger_database"><?php p($l->t('Database')); ?></label><br/>
    <br/>
    <span class="msg"></span>
</div>
