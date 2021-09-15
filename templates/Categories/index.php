<?php
/**
 * @var \App\Model\Entity\Category $category
 * @var \Cake\Datasource\ResultSetInterface $categories
 * @var App\Model\Entity\User $user
 */
?>
<div class="container">
    <h2 class="main-title">Categories</h2>
    <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>
    <br><br>
    <?php
    if (count($categories) == 0){
        echo "<p>No Categories!</p>";
    }
    else{
    ?>
    <table class="table table-responsive-sm">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?= $this->Number->format($category->id) ?></td>
            <td><?= h($category->parent_id) ?></td>
            <td><?= h($category->name) ?></td>
            <td><?= h($category->description) ?></td>
            <td><?= h($category->created) ?></td>
            <td><?= h($category->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $category->id,], ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ['class' => 'btn btn-warning']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['class' => 'btn btn-danger'], ['confirm' => 'Are you sure you want to delete this category?']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        <?php } ?>
    </div>
</div>