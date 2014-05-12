STUDIP.UnizensusPlugin = {

    init: function() {
        $('button[name="submit"]').bind('click', function(event) {
            var success = true;
            var nameInput = $('input[name="name"]');
            if (nameInput.val() == '') {
                nameInput.before('<div class="message_error">Bitte geben Sie einen Namen für die Vorlage an!</div>');
                success = false;
            }
            var subjectInput = $('input[name="subject"]');
            if (subjectInput.val() == '') {
                subjectInput.before('<div class="message_error">Bitte geben Sie einen Betreff für die Vorlage an!</div>');
                success = false;
            }
            var msgInput = $('textarea[name="message"]');
            if (msgInput.val() == '') {
                msgInput.before('<div class="message_error">Bitte geben Sie einen Nachrichtentext für die Vorlage an!</div>');
                success = false;
            }
            if (!success) {
                event.preventDefault();
            }
            return success;
        });
    }

}
