/**
 * ownCloud - Logger
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bert Maerten <maerten.bert@outlook.com>
 * @copyright Bert Maerten 2015
 */

(function ($, OC) {

    $(document).ready(function () {
        //alert('document.ready()');

	$('#logger input[type=checkbox]').change(function(){ //[name*=logger][type=checkbox]
            Save();
	});
        
	$('#logger #events .group').click(function(){
            var boxgroup = '#logger .' + $(this).attr('data-select-group');
            var boxcount = $(boxgroup + ':checked').length;
            $(boxgroup).attr('checked', true);
            if (boxcount === $(boxgroup + ':checked').length) {
                $(boxgroup).attr('checked', false); // All values were already selected, so invert it
            }
            Save();
	});
        
        function Save() {
            //alert('settings.save()');
            
            var console = $('#logger_console').prop('checked');
            var database = $('#logger_database').prop('checked');
            
            var events = [];
            $('#logger #events tbody tr').each(function() {
                var row = $(this);
                var name = row.attr('name');
                var pre = row.children('td:nth-child(1)').children().children().prop('checked');
                var post = row.children('td:nth-child(2)').children().children().prop('checked');
                events.push({name: name, settings: {pre: pre, post: post}});
            });
            var stringified = JSON.stringify(events);
            
            $('#logger .msg').html(t('logger', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#logger .msg');
            $.post(
                OC.filePath('logger', 'ajax', 'settings.admin.php'),
                {console: console, database: database, events: stringified},
                function (result) {
                    if (result.status === 'success') {
                        $('#logger .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#logger .msg', result);
                    } else {
                        $('#logger .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#logger .msg', result);
                    }
                }
            );
        }

    });

})(jQuery, OC);
