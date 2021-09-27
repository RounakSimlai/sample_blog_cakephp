<?php
/**
 * @var \Cake\Datasource\ResultSetInterface $articles
 * @var \App\Model\Entity\Article $article
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Articles Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['style.css', 'style.min.css']) ?>
</head>
<body>
<table class="table table-responsive-sm">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">User</th>
        <th scope="col">category_id</th>
        <th scope="col">created</th>
        <th scope="col">modified</th>
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
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
