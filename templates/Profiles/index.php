<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profile $profile
 */
?>
<div class="profile" align="center">
    <?= $img?>
    <br>
    <?= $edit?>
    <br>
<div>
        <div class="profile-position">
        <p><b>Minecraft Server Whitelist</b></p>
            <?= $this->Form->create();?>
            <legend><?= __('Add to Whitelist') ?></legend>
            <?= $this->Form->Control('Ingame Name',array('label' => false, 'default'=> 'Ingame Name'))?>
            <?= $this->Form->button(__('Hinzufügen')) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="profile-position">
            <p><b>Social Media</b></p>
            <?= $this->Form->create()?>
            <legend><?= __('Add Youtube') ?></legend>
            <?= $this->Form->Control('youtube')?>
            <?= $this->Form->button(__('Hinzufügen')) ?>
            <?= $this->Form->end() ?>
        <div class="profile-position">
            <legend><?= __('Add Twitch') ?></legend>
            <?= $this->Form->Control('twitch')?>
            <?= $this->Form->button(__('Hinzufügen')) ?>
            <?= $this->Form->end() ?>
        </div>
        </div>

</div>
    <?= $this->Html->link("Fertig", array('controller' => 'Site', 'action' => 'index')) ?>
<?= clearstatcache();?>
</div>