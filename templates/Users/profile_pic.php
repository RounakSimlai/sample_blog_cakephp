<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $User
 */
?>
<div class="card">
    <div class="card-body">
        <h2 class="main-title">Change Profile Picture</h2>
        <?php echo $this->Form->create(null, [
            'class' => 'signup-form form',
            'type' => 'file',
        ]) ?>

        <?php echo $this->Form->control('image_file', [
            'class' => 'form-control',
            'type' => 'file',
            'label' => false,
            'style' => 'width: 16em;',
        ]) ?>
        <?php echo $this->Form->button('Save!', [
            'class' => "btn btn-primary mt-5"
        ]) ?>
        <?php echo $this->Form->end() ?>
        <?= $this->Html->link('Back', $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

