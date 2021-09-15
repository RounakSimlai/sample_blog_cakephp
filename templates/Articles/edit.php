<?php
/**
* @var \App\Model\Entity\Article $article
*/
?>
<div class="card">
    <div class="card-body">
        <h2 class="main-title">Edit Article</h2>
        <?php echo $this->Form->create($article,[
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
                <label for="body">Category</label>
                <?php echo $this->Form->control('category_id', [
                    'type' => 'select',
                    'class' => 'form-input',
                    'label' => false,
                ]) ?>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        <?=$this->Form->end()?>
        <?= $this->Html->link('Back', $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
