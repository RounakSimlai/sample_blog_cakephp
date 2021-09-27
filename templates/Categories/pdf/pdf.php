<?php
/**
 * @var \Cake\Datasource\ResultSetInterface $categories
 * @var \App\Model\Entity\Category $category
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Categories Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['style.css', 'style.min.css']) ?>
</head>
<body>
<table class="table table-responsive-sm">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">parent_id</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">created</th>
        <th scope="col">modified</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?= $this->Number->format($category->id) ?></td>
            <?php if ($category->parent_id == null) { ?>
                <td>No Parent</td>
            <?php } else { ?>
                <td><?= h($category->parent_id) ?></td>
            <?php } ?>
            <td><?= h($category->name) ?></td>
            <td><?= h($category->description) ?></td>
            <td><?= h($category->created) ?></td>
            <td><?= h($category->modified) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
