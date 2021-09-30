<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $User
 * @var \Cake\Datasource\ResultSetInterface $img
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
        <div>
            <?= $img ?>
        </div>
    </div>
</div>
