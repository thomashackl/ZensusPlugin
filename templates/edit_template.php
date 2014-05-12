<?php use Studip\Button; ?>
<form class="studip_form" action="<?= PluginEngine::getLink($plugin, array('tpl' => $t['template_id']), 'templates') ?>" method="post"/>
    <div>
        <label class="caption" for="name">
            <?= _('Name') ?>
        </label>
        <input type="text" name="name" size="75" maxlength="255" value="<?= $tpl->name ?>" placeholder="<?= _('Geben Sie hier einen Namen für die Vorlage ein.') ?>" required="required"/>
    </div>
    <div>
        <label class="caption" for="subject">
            <?= _('Betreff') ?>
        </label>
        <input type="text" name="subject" size="75" maxlength="255" value="<?= $tpl->subject ?>" placeholder="<?= _('Geben Sie hier eine Betreffzeile ein.') ?>" required="required"/>
    </div>
    <div>
        <label class="caption" for="message">
            <?= _('Nachrichtentext') ?>
        </label>
        <textarea name="message" cols="90" rows="15" placeholder="<?= _('Geben Sie hier einen Text für die zu verschickende Nachricht bzw. zu erstellende Ankündigung ein.') ?>" required="required"><?= $tpl->message ?></textarea>
    </div>
    <div class="submit_wrapper">
        <?php if ($tpl) { ?>
        <input type="hidden" name="tpl" value="<?= $tpl->template_id ?>"/>
        <?php } ?>
        <?= Button::createAccept(_('Vorlage speichern'), 'submit') ?>
        <?= Button::createCancel(_('Abbrechen'), 'cancel') ?>
    </div>
</form>
