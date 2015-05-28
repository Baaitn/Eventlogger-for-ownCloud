# Eventlogger
An app for ownCloud that allow logging of various events to console and/or database using hooks.

## Installation
Upload this to **owncloud/apps/logger** and navigate to the 'Apps' page. Choose the category 'Not enabled'. Then click the 'Enable' button of 'Eventlogger'.

## Publish to App Store
First get an account for the [App Store](http://apps.owncloud.com/) then run:

    make appstore

**ocdev** will ask for your App Store credentials and save them to ~/.ocdevrc which is created afterwards for reuse.

If the <ocsid> field in **appinfo/info.xml** is not present, a new app will be created on the appstore instead of updated. You can look up the ocsid in the app page URL, e.g.: **http://apps.owncloud.com/content/show.php/News?content=168040** would use the ocsid **168040**

## Running tests
After [Installing PHPUnit](http://phpunit.de/getting-started.html) run:

    phpunit -c phpunit.xml

## Adding additional actions/events
To add logging of additional actions you connect the hook in appinfo/app.php and provide a handler in lib/hooks.php.
You also need to add html to enable and disable the logging of your action to templates/admin.settings.php. 

Data is taken from this template when saving any changes to the adminsettings. Note that without adding your new action somehow to $events they will not get displayed or logged.
The easiest way to do this is to delete the current stored $events setting from oc_appconfig in the database and change $defaultevents in both lib/hooks.php and settings.admin.php so it includes your new action.
