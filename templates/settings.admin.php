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
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $events = (array) json_decode($_['logger_events']); //json_decode(OCP\Config::getAppValue('logger', 'events', null));
            foreach ($events as $key => $val): //while (list($key, $val) = each($events)): ?>
                <?php if ($val->action === 'Login'): ?>
                    <tr name="Login">
                        <td class="small"><label for="preLogin"><input type="checkbox" id="preLogin" name="preLogin" class="pre Login" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postLogin"><input type="checkbox" id="postLogin" name="postLogin" class="post Login" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Login"><?php p($l->t('Login')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Logout'): ?>
                    <tr name="Logout">
                        <td class="small"></td>
                        <td class="small"><label for="postLogout"><input type="checkbox" id="postLogout" name="postLogout" class="post Logout" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Logout"><?php p($l->t('Logout')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Create'): ?>
                    <tr name="Create">
                        <td class="small"><label for="preCreate"><input type="checkbox" id="preCreate" name="preCreate" class="pre Create" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postCreate"><input type="checkbox" id="postCreate" name="postCreate" class="post Create" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Create"><?php p($l->t('Create')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Read'): ?>
                    <tr name="Read">
                        <td class="small"></td>
                        <td class="small"><label for="postRead"><input type="checkbox" id="postRead" name="postRead" class="post Read" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Read"><?php p($l->t('Read')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Update'): ?>
                    <tr name="Update">
                        <td class="small"><label for="preUpdate"><input type="checkbox" id="preUpdate" name="preUpdate" class="pre Update" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postUpdate"><input type="checkbox" id="postUpdate" name="postUpdate" class="post Update" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Update"><?php p($l->t('Update')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Delete'): ?>
                    <tr name="Delete">
                        <td class="small"><label for="preDelete"><input type="checkbox" id="preDelete" name="preDelete" class="pre Delete" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postDelete"><input type="checkbox" id="postDelete" name="postDelete" class="post Delete" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Delete"><?php p($l->t('Delete')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Rename'): ?>
                    <tr name="Rename">
                        <td class="small"><label for="preRename"><input type="checkbox" id="preRename" name="preRename" class="pre Rename" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postRename"><input type="checkbox" id="postRename" name="postRename" class="post Rename" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Rename"><?php p($l->t('Rename')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Copy'): ?>
                    <tr name="Copy">
                        <td class="small"><label for="preCopy"><input type="checkbox" id="preCopy" name="preCopy" class="pre Copy" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postCopy"><input type="checkbox" id="postCopy" name="postCopy" class="post Copy" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Copy"><?php p($l->t('Copy')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Restore'): ?>
                    <tr name="Restore">
                        <td class="small"><label for="preRestore"><input type="checkbox" id="preRestore" name="preRestore" class="pre Restore" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postRestore"><input type="checkbox" id="postRestore" name="postRestore" class="post Restore" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Restore"><?php p($l->t('Restore')); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($val->action === 'Trash'): ?>
                    <tr name="Trash">
                        <td class="small"><label for="preTrash"><input type="checkbox" id="preTrash" name="preTrash" class="pre Trash" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postTrash"><input type="checkbox" id="postTrash" name="postTrash" class="post Trash" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Trash"><?php p($l->t('Trash')); ?></td>
                    </tr>
                <?php endif; ?>  
                <?php if ($val->action === 'PermaDelete'): ?>
                    <tr name="PermaDelete">
                        <td class="small"><label for="prePermaDelete"><input type="checkbox" id="prePermaDelete" name="prePermaDelete" class="pre PermaDelete" <?php if ($val->settings->pre): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="small"><label for="postPermaDelete"><input type="checkbox" id="postPermaDelete" name="postPermaDelete" class="post PermaDelete" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="PermaDelete"><?php p($l->t('Delete (Permanent)')); ?></td>
                    </tr>
                <?php endif; ?>  
                <?php if ($val->action === 'Share'): ?>
                    <tr name="Share">
                        <td class="small"></td>
                        <td class="small"><label for="postShare"><input type="checkbox" id="postShare" name="postShare" class="post Share" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Share"><?php p($l->t('Share')); ?></td>
                    </tr>
                <?php endif; ?>                   
                <?php if ($val->action === 'Unshare'): ?>
                    <tr name="Unshare">
                        <td class="small"></td>
                        <td class="small"><label for="postUnshare"><input type="checkbox" id="postUnshare" name="postUnshare" class="post Unshare" <?php if ($val->settings->post): ?> checked="checked"<?php endif; ?>/></label></td>
                        <td class="group" data-select-group="Unshare"><?php p($l->t('Unshare')); ?></td>
                    </tr>
                <?php endif; ?>
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
