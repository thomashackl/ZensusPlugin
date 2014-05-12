STUDIP.UnizensusPlugin = {

    init: function() {
        $('button[name="submit"]').bind('click', function(event) {
            var success = true;
            var error = [];
            var nameInput = $('input[name="name"]');
            if (nameInput.val() == '') {
                error[0] = 'Bitte geben Sie einen Namen für die Vorlage an!';
                success = false;
            }
            var subjectInput = $('input[name="subject"]');
            if (subjectInput.val() == '') {
                error[1] = 'Bitte geben Sie einen Betreff für die Vorlage an!';
                success = false;
            }
            var msgInput = $('textarea[name="message"]');
            if (msgInput.val() == '') {
                error[2] = 'Bitte geben Sie einen Nachrichtentext für die Vorlage an!';
                success = false;
            }
            if (!success) {
                $('div#error').addClass('messagebox').addClass('messagebox_error').html(error.join('<br>'));
            }
            return success;
        });
    }

}
