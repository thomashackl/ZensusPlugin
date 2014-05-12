STUDIP.UnizensusPlugin = {

    init: function() {
        $('button[name="save_template"]').bind('click', function(event) {
            var success = true;
            var error = [];
            var nameInput = $('input[name="name"]');
            if (nameInput.val() == '') {
                error.push('Bitte geben Sie einen Namen f�r die Vorlage an!');
                success = false;
            }
            var subjectInput = $('input[name="subject"]');
            if (subjectInput.val() == '') {
                error.push('Bitte geben Sie einen Betreff f�r die Vorlage an!');
                success = false;
            }
            var msgInput = $('textarea[name="message"]');
            if (msgInput.val() == '') {
                error.push('Bitte geben Sie einen Nachrichtentext f�r die Vorlage an!');
                success = false;
            }
            if (!success) {
                $('div#error_message').
                    addClass('messagebox').
                    addClass('messagebox_error').
                    html(error.join('<br/>'));
            }
            return success;
        });
    }

}
