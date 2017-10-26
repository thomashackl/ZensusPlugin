<form class="default" action="" method="post">
    <?= MessageBox::info(sprintf(_('Wollen Sie die Textvorlage "%s" wirklich löschen?'), htmlReady($tpl->name))) ?>
    <?= CSRFProtection::tokenTag(); ?>
    <input type="hidden" name="tpl" value="<?= $tpl->id ?>"/>
    <?= Studip\Button::createAccept(_('Löschen'), 'do_delete') ?>
    <?= Studip\LinkButton::createCancel(_('Abbrechen'), PluginEngine::getLink($plugin, array(), 'templates')) ?>
</form>
