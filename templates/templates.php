<table class="default" width="100%">
    <caption><?= _('Textvorlagen für Nachrichten und Ankündigungen') ?></caption>
    <thead>
        <tr>
            <th width="20%"><?= _('Name') ?></th>
            <th width="25%"><?= _('Betreff') ?></th>
            <th><?= _('Text') ?></th>
            <th width=40"><?= _('Aktionen') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (UnizensusTextTemplate::getAll() as $t) { ?>
        <tr>
            <td valign="top"><?= htmlReady($t['name']) ?></td>
            <td valign="top"><?= htmlReady($t['subject']) ?></td>
            <td valign="top"><?= nl2br(htmlReady($t['message'])) ?></td>
            <td valign="top">
                <a class="lightbox" href="<?= PluginEngine::getLink($plugin, array('tpl' => $t['template_id']), 'edit_template').'" title="'._('Vorlage bearbeiten') ?>">
                    <?= Assets::img('icons/16/blue/edit.png') ?>
                </a>
                <a href="<?= PluginEngine::getLink($plugin, array('tpl' => $t['template_id']), 'delete_template').'" title="'._('Vorlage löschen') ?>">
                    <?= Assets::img('icons/16/blue/trash.png') ?>
                </a>
            </td>
        <tr>
        <?php } ?>
    </tbody>
</table>
