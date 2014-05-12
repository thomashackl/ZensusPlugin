STUDIP.UnizensusPlugin = {

    init: function() {
        $('button[name="submit"]').bind('click', function(event) {
            var success = true;
            var nameInput = $('input[name="name"]');
            if (nameInput.val().trim() == '') {
                nameInput.after('<span class="error">Bitte geben Sie einen Namen f�r die Vorlage an!</span>');
                success = false;
            }
            var subjectInput = $('input[name="subject"]');
            if (subjectInput.val().trim() == '') {
                subjectInput.after('<span class="error">Bitte geben Sie einen Betreff f�r die Vorlage an!</span>');
                success = false;
            }
            var msgInput = $('input[name="message"]');
            if (msgInput.val().trim() == '') {
                msgInput.after('<span class="error">Bitte geben Sie einen Nachrichtentext f�r die Vorlage an!</span>');
                success = false;
            }
            if (!success) {
                event.preventDefault();
            }
            return success;
        });
    }

}
