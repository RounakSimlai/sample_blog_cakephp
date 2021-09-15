<?php
/**
 * @var App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface $categories
 */
?>

<div class="card">
    <div class="card-body">
        <h2 class="main-title">Add Article</h2>
        <?php echo $this->Form->create(null, [
            'url' => [
                'controller' => 'Articles',
                'action' => 'add'
            ],
            'class' => 'signup-form form'
        ]) ?>
        <div class="form-group">
            <label for="title">Title</label>
            <?php echo $this->Form->control('title', [
                'type' => 'text',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <?php echo $this->Form->control('body', [
                'type' => 'textarea',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <?php echo $this->Form->select('category_id', $categories, [
                'empty' => 'Choose Category',
                'class' => 'form-input',
                'onchange' => 'otherBox(this)',
            ]) ?>
        </div>
        <?php echo $this->Form->control('newCategory', [
            'type' => 'text',
            'class' => 'form-input',
            'label' => false,
            'style'=>'display:none'
        ]) ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?= $this->Form->end() ?>
        <?= $this->Html->link('Back',  $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
