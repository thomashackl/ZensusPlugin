STUDIP.UnizensusPlugin = {

    init: function() {
        $('form[name="edit_template_form"]').bind('submit', function(event) {
            var success = true;
            var nameInput = $('input[name="name"]');
            if (nameInput.val() == '') {
                nameInput.after('<span class="messagebox_error">Bitte geben Sie einen Namen für die Vorlage an!</span>');
                success = false;
            }
            var subjectInput = $('input[name="subject"]');
            if (subjectInput.val() == '') {
                subjectInput.after('<span class="messagebox_error">Bitte geben Sie einen Betreff für die Vorlage an!</span>');
                success = false;
            }
            var msgInput = $('input[name="message"]');
            if (msgInput.val() == '') {
                msgInput.after('<span class="messagebox_error">Bitte geben Sie einen Nachrichtentext für die Vorlage an!</span>');
                success = false;
            }
            return success;
        });
    }

}
