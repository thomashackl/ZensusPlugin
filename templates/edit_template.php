<h1><?= $tpl ? _('Textvorlage bearbeiten') : _('Neue Textvorlage anlegen') ?></h1>
<?php use Studip\Button; ?>
<?= MessageBox::info('Folgende Marker können verwendet werden:',
    array(
        '<b>EVALUATION_START</b>: '._('Beginn des Evaluationszeitraums (pro Veranstaltung)'),
        '<b>EVALUATION_END</b>: '._('Ende des Evaluationszeitraums (pro Veranstaltung)'),
        '<b>COURSENAME</b>: '._('Name der Veranstaltung'),
        '<b>COURSETYPE</b>: '._('Typ der Veranstaltung'),
        '<b>COURSENUMBER</b>: '._('Veranstaltungsnummer'),
        '<b>COURSELINK</b>: '._('Stud.IP-interner Link zur Evaluation innerhalb der Veranstaltung'))) ?>
<div id="error_message"></div>
<form name="edit_template_form" class="default" action="<?= PluginEngine::getLink($plugin, array('tpl' => $t['template_id']), 'templates') ?>" method="post"/>
    <div>
        <label class="caption" for="name">
            <?= _('Name') ?>
        </label>
        <input type="text" name="name" size="90" maxlength="255" value="<?= $tpl->name ?>" placeholder="<?= _('Geben Sie hier einen Namen für die Vorlage ein.') ?>"/>
    </div>
    <div>
        <label class="caption" for="subject">
            <?= _('Betreff') ?>
        </label>
        <input type="text" name="subject" size="90" maxlength="255" value="<?= $tpl->subject ?>" placeholder="<?= _('Geben Sie hier eine Betreffzeile ein.') ?>"/>
    </div>
    <div>
        <label class="caption" for="message">
            <?= _('Nachrichtentext') ?>
        </label>
        <textarea name="message" cols="90" rows="15" placeholder="<?= _('Geben Sie hier einen Text für die zu verschickende Nachricht bzw. zu erstellende Ankündigung ein.') ?>"><?= $tpl->message ?></textarea>
    </div>
    <div class="submit_wrapper">
        <?php if ($tpl) { ?>
        <input type="hidden" name="tpl" value="<?= $tpl->template_id ?>"/>
        <?php } ?>
        <?= CSRFProtection::tokenTag(); ?>
        <?= Button::createAccept(_('Vorlage speichern'), 'save_template') ?>
        <?= Button::createCancel(_('Abbrechen'), 'cancel') ?>
    </div>
</form>
<script type="text/javascript">
//<!--
    STUDIP.UnizensusPlugin.init();
//-->
</script>
