<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profile $profile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="profiles form content">
            <?= $this->Form->create($profile) ?>
            <legend><?= __('Add Profile') ?></legend>
            <?= $this->Form->file('profilesphoto'); ?>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
            <?= $this->Html->link("Zurück", ['controller' => 'Profiles', 'action' => 'index']) ?>
        </div>
    </div>
</div>