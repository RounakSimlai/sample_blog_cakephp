<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \Cake\Datasource\ResultSetInterface $articles
 * @var App\Model\Entity\User $user
 */
$this->initialize();
?>
<div class="container">
    <h2 class="main-title">Articles</h2>
    <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>
    <?php
    if (count($articles) > 0) {
        ?>
        <?= $this->Html->link(__('Export to CSV'), ['action' => 'csv'], ['class' => 'btn btn-primary float-left']) ?>
    <?php } ?>
    <br><br>
    <?php
    if (count($articles) == 0){
        echo "<p>No Articles to Show!</p>";
    }
    else{
    ?>
    <table class="table table-responsive-sm">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('User') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= h($article->title) ?></td>
                <td><?= h($article->user_id) ?></td>
                <td><?= h($article->category_id) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->id,], ['class' => 'btn btn-success']) ?>
                    <?php if ($article->user_id == $user->id || $user->role_id == 1) { ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id], ['class' => 'btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['class' => 'btn btn-danger'], ['confirm' => 'Are you sure you want to delete this article?']) ?>
                    <?php } ?>
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
