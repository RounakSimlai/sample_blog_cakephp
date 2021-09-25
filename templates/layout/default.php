<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 * @var \Cake\Controller\Controller $controller
 * @var App\Model\Entity\User $user
 */
$cakeDescription = 'New Blog site!';
?>
<!DOCTYPE html>
<html lang="en">
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

    <?= $this->Html->css(['style.css', 'style.min.css']) ?>
</head>
<body>
<div class="page-flex">
    <aside class="sidebar">
        <div class="sidebar-start">
            <div class="sidebar-head">
                <a href="/" class="logo-wrapper" title="Home">
                    <span class="sr-only">Home</span>
                    <span class="icon logo" aria-hidden="true"></span>
                    <div class="logo-text">
                        <span class="logo-title">Blog!</span>
                    </div>

                </a>
                <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                    <span class="sr-only">Toggle menu</span>
                    <span class="icon menu-toggle" aria-hidden="true"></span>
                </button>
            </div>
            <div class="sidebar-body">
                <ul class="sidebar-body-menu">
                    <li>
                        <a href="/dashboard"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                    </li>
                    <li>
                        <a class="show-cat-btn" href="##">
                            <span class="icon document" aria-hidden="true"></span>Articles
                            <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                        </a>
                        <ul class="cat-sub-menu">
                            <li>
                                <?= $this->Html->link('All Articles', [
                                    'controller' => 'Articles',
                                    'action' => 'index',
                                ]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('Add new Article', [
                                    'controller' => 'Articles',
                                    'action' => 'add',
                                ]) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="show-cat-btn" href="##">
                            <span class="icon folder" aria-hidden="true"></span>Categories
                            <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                        </a>
                        <ul class="cat-sub-menu">
                            <li>
                                <?= $this->Html->link('All Categories', [
                                    'controller' => 'Categories',
                                    'action' => 'index',
                                ]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('Add new Category', [
                                    'controller' => 'Categories',
                                    'action' => 'add',
                                ]) ?>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="sidebar-body-menu">
                    <li>
                        <?= $this->Html->link("Log out!", [
                            'controller' => 'Users',
                            'action' => 'logout',
                            $user->id,
                        ],
                            [
                                'class' => 'btn btn-danger justify-content-center',
                            ]) ?>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <a href="/users/view/<?= $user->id ?>" class="sidebar-user">
            <span class="sidebar-user-img">
             <?= $this->Html->image($user->image, [
                 'width' => '50',
                 'height' => '50',
             ]) ?>

            </span>
                <div class="sidebar-user-info">
                    <span class="sidebar-user__title"><?= $user->first_name . " " . $user->last_name ?></span>
                </div>
            </a>
        </div>
    </aside>
    <div class="main-wrapper">
        <nav class="main-nav--bg">
            <div class="container main-nav">
                <div class="main-nav-start">
                </div>
                <div class="main-nav-end">
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                    </button>
                    <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                        <span class="sr-only">Switch theme</span>
                        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </nav>
        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
    </div>
</div>
</main>
<?= $this->Html->script(['chart.min.js', 'feather.min.js', 'script.js']) ?>
<script>
    function otherBox(that) {
        let text = that.options[that.selectedIndex].text;
        if (text == 'Other') {
            document.getElementById("newcategory").style.display = 'block';
        } else {
            document.getElementById("newcategory").style.display = 'none';
        }
    }
</script>
</body>
</html>
