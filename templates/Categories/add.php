<?php
/**
 * @var App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface $categories
 * @var \Cake\Datasource\ResultSetInterface $parentCategories
 */
?>

<div class="card">
    <div class="card-body">
        <h2 class="main-title">Add Article</h2>
        <?php echo $this->Form->create(null, [
            'url' => [
                'controller' => 'Categories',
                'action' => 'add'
            ],
            'class' => 'signup-form form',
            'style'=>'line-height:2.5rem'
        ]) ?>
        <div class="form-group">
            <label for="title">Parent(Optional)</label>
            <?php echo $this->Form->control('parent_id', [
                'options' => $parentCategories,
                'class' => 'form-input',
                'empty' => 'No parent category',
                'label'=>false,
            ]); ?>
            <label for="title">Name</label>
            <?php echo $this->Form->control('name', [
                'type' => 'text',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="body">Description(Optional)</label>
            <?php echo $this->Form->control('description', [
                'type' => 'textarea',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?= $this->Form->end() ?>
        <?= $this->Html->link('Back', $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
