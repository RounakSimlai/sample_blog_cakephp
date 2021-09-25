<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $User
 */
?>
<div class="card">
    <div class="card-body">
        <h2 class="main-title">Account Details</h2>
        <table style="line-height: 4rem">
            <tr>
                <th><?= __('Id:- ') ?></th>
                <td><?= h($User->id) ?></td>
            </tr>
            <tr>
                <th><?= __('First Name:- ') ?></th>
                <td><?= h($User->first_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Last Name:- ') ?></th>
                <td><?= h($User->last_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Email:-') ?></th>
                <td><?= h($User->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Role:- ') ?></th>
                <td><?= h($User->role_id) ?></td>
            </tr>
        </table>
        <?= $this->Html->image($User->image, [
            'class' => 'profile rounded-circle border border-primary',
            'width' => 195,
            'height' => 258,
        ]) ?>
        <?= $this->Html->link('Change Profile Picture', [
            'controller' => 'Users',
            'action' => 'profilePic',
            $User->id,
        ], ['class' => 'profile-button btn btn-primary']) ?>

        <?= $this->Html->link('Change Password', [
            'controller' => 'Users',
            'action' => 'password',
            $User->id,
        ], ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Edit Account Details', [
            'controller' => 'Users',
            'action' => 'edit',
            $User->id,
        ], ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Back', ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>


