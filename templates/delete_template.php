<form class="studip_form" action="" method="post">
    <?= MessageBox::info(sprintf(_('Wollen Sie die Textvorlage "%s" wirklich l�schen?'), htmlReady($tpl->name))) ?>
    <?= CSRFProtection::tokenTag(); ?>
    <input type="hidden" name="tpl" value="<?= $tpl->id ?>"/>
    <?= Studip\Button::createAccept(_('L�schen'), 'do_delete') ?>
    <?= Studip\LinkButton::createCancel(_('Abbrechen'), PluginEngine::getLink($plugin, array(), 'templates')) ?>
</form>