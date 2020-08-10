<div>
    <?= $img?>
    <br>
    <?= $edit?>
    <br>
<div>
        <p><b>Minecraft Server Whitelist</b></p>
            <?= $this->Form->create();?>
            <legend><?= __('Add to Whitelist') ?></legend>
            <?= $this->Form->Control('Ingame Name')?>
            <?= $this->Form->button(__('Hinzufügen')) ?>
            <?= $this->Form->end() ?>
</div>
    <?= $this->Html->link("Fertig", array('controller' => 'Site', 'action' => 'index')) ?>
<?= clearstatcache();?>
</div>