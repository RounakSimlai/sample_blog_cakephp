<?php
/**
 * @var \Cake\Datasource\ResultSetInterface $articles
 * @var \Cake\Datasource\ResultSetInterface $users
 * @var \Cake\Datasource\ResultSetInterface $categories
 */
?>
<div class="container">
    <div class="card bg-primary text-white">
        <div class="card-body">
            <h2 class="main-title text-white">Dashboard</h2>
        </div>
        <div class="p-5 justify-content-center">
            Number of Users:-
            <?php
            echo count($users);
            ?>
        </div>
        <div class="p-5 justify-content-center">
            Number of Articles:-
            <?php
            echo count($articles);
            ?>
        </div>
        <div class="p-5 justify-content-center">
            Number of Categories:-
            <?php
            echo count($categories);
            ?>
        </div>
    </div>
</div>
