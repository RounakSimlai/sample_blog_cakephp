<?php
/**
 * @var \App\Model\Entity\User $User
 * @var \App\View\AppView $this
 */
//dd($user);
?>
<div class="card">
    <div class="card-body">
        <h2 class="main-title">Edit your Account Details</h2>
        <?php echo $this->Form->create($User,[
            'class' => 'signup-form form'
        ]) ?>
        <div class="form-group">
            <label for="first-name">First Name</label>
            <?php echo $this->Form->control('first_name', [
                'type' => 'text',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <?php echo $this->Form->control('last_name', [
                'type' => 'text',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <?php echo $this->Form->control('email', [
                'type' => 'email',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <?=$this->Form->end()?>
        <?= $this->Html->link('Back',  $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

