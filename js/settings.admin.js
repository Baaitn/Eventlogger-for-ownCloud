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

        $('input[name*=logger]').change(ChangeEventHandler); //[name*=logger][type=checkbox]

        function ChangeEventHandler(event) {
            //alert(event.target.type + '.change()');

            //var console = $('#logger_console').prop('checked');
            //var database = $('#logger_database').prop('checked');
            
            //$('#logger .msg').html(t('logger', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#logger .msg');
            //$.post(
            //    OC.filePath('logger', 'ajax', 'settings.admin.php'),
            //    {console: console, database: database},
            //    function (result) {
            //        if (result.status === 'success') {
            //            $('#logger .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#logger .msg', result);
            //        } else {
            //            $('#logger .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#logger .msg', result);
            //        }
            //    }
            //);
    
            Save();
        }

	$('#logger #events input[type=checkbox]').change(function(){
            Save();
	});
        
	$('#logger #events .group').click(function(){
            var selectGroup = '#logger .' + $(this).attr('data-select-group');
            var checkedBoxes = $(selectGroup + ':checked').length;
            $(selectGroup).attr('checked', true);
            if (checkedBoxes === $(selectGroup + ':checked').length) {
                $(selectGroup).attr('checked', false); // All values were already selected, so invert it
            }
            Save();
	});
        
        function Save() {
            //alert('settings.save()');
            
            var console = $('#logger_console').prop('checked');
            var database = $('#logger_database').prop('checked');
            
            var events1 = [];
            $('#events input[type=checkbox]').each(function() {
                var name = this.name;
                var value = (this.checked ? true : false); //$(this).prop('checked') = true //$(this).val() = "on"
                events1.push({name: name, value: value});
            });
            var stringify1 = JSON.stringify(events1);  // [{"name":"preLogin","value":false},{"name":"postLogin","value":true},{"name":"postLogout","value":false},...]
            
            var events2 = [];
            $('#events tbody tr').each(function() {
                var row = $(this);
                var name = row.attr('name');
                var pre = row.children('td:nth-child(1)').children().children().prop('checked');
                var post = row.children('td:nth-child(2)').children().children().prop('checked');
              //events2.push({name:                 {pre: pre, post: post}});
                events2.push({name: name, settings: {pre: pre, post: post}});
            });
            var stringify2 = JSON.stringify(events2); // [{"name":"Login","settings":{"pre":false,"post":true}},{"name":"Logout","settings":{"post":false}},...]
            
            alert(stringify1);
            alert(stringify2);
            
            $('#logger .msg').html(t('logger', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#logger .msg');
            $.post(
                OC.filePath('logger', 'ajax', 'settings.admin.events.php'),
                {console: console, database: database, events: stringify2},
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
