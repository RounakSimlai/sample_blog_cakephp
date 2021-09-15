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
    <article class="sign-up">
        <?= $this->Flash->render() ?>
        <h1 class="sign-up__title">Login!</h1>
        <?php echo $this->Form->create(null, [
            'url' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'class' => 'sign-up-form form',

        ]); ?>
        <label class="form-label-wrapper">
            <p class="form-label">Email</p>
        </label>
        <?php echo $this->Form->control('email', [
            'type' => 'email',
            'class' => 'form-input',
            'label' => false,
        ]) ?>
        <label class="form-label-wrapper">
            <p class="form-label">Password</p>
        </label>
        <?php echo $this->Form->control('password', [
            'type' => 'password',
            'class' => 'form-input',
            'label' => false,
        ]) ?>
        <?php echo $this->Form->button('Sign in!', [
            'class' => 'form-btn primary-default-btn transparent-btn'
        ]) ?>
        <br>
        <p> Don't have an account?<?= $this->Html->link(' Sign up!', ['action' => 'add']) ?></p>
        <?php echo $this->Form->end() ?>
    </article>
</main>
<?= $this->Html->script(['chart.min.js', 'feather.min.js', 'script.js']) ?>
</body>
</html>
