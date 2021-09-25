<?php
/**
 * @var \App\View\AppView $this
 */
$cakeDescription = 'New Blog site!';
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css('style.min.css') ?>
</head>
<body>
<?= $this->Flash->render() ?>
<main class="page-center">
    <label class="sign-up">
        <h1 class="sign-up__title">Register!</h1>
        <?php echo $this->Form->create(null, [
            'url' => [
                'controller' => 'Users',
                'action' => 'add'
            ],
            'class' => 'signup-form form',
            'type'=>'file',
        ]) ?>
        <label class="form-label-wrapper">
            <p class="form-label">Name</p>
            <?php echo $this->Form->control('first_name', [
                'type' => 'text',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Last Name</p>
            <?php echo $this->Form->control('last_name', [
                'type' => 'text',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Email</p>
            <?php echo $this->Form->control('email', [
                'type' => 'email',
                'class' => 'form-input',
                'label' => false,
            ]) ?>
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Password</p>
            <?php echo $this->Form->control('password', [
                'type' => 'password',
                'class' => 'form-control',
                'label' => false,
            ]) ?>
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Profile Picture</p>
            <?php echo $this->Form->control('image_file', [
                'class'=>'form-control',
                'type' => 'file',
                'label' => false,
                'style'=>'width: 16em;',
            ]) ?>
        </label>
        <?php echo $this->Form->button('Register!', [
            'class' => "form-btn primary-default-btn transparent-btn"
        ]) ?>
        <?php echo $this->Form->end() ?>
    </label>
    <?= $this->Html->link('Back', $this->request->referer(), ['class' => 'btn btn-primary']) ?>
</main>
<?= $this->Html->script(['chart.min.js', 'feather.min.js', 'script.js']) ?>
</body>
</html>
