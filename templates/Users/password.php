<?php
/**
 * @var \App\Model\Entity\User $User
 * @var \App\View\AppView $this
 */
//dd($user);
?>
<div class="card">
    <div class="card-body">
        <h2 class="main-title">Change Password</h2>
        <?php echo $this->Form->create(null,[
            'class' => 'signup-form form'
        ]) ?>
        <div class="form-group">
            <label for="first-name">Current Password</label>
            <?php echo $this->Form->control('currentPass', [
                'type' => 'password',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="last-name">New Password</label>
            <?php echo $this->Form->control('newPass', [
                'type' => 'password',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="email">Confirm Password</label>
            <?php echo $this->Form->control('confirmPass', [
                'type' => 'password',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <?=$this->Form->end()?>
        <?= $this->Html->link('Back',  $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

