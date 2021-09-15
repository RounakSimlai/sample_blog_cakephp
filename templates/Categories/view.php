<?php
/**
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="card">
    <div class="card-body" style="line-height: 4rem;">
        <h3><u>Category Details!</u></h3>
        <table>
            <tr>
                <th><?= __('Category Id:- ') ?></th>
                <td><?= h($category->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Parent Id:- ') ?></th>
                <?php if ($category->parent_id == null) { ?>
                    <td>No Parent</td>
                <?php } ?>
                <td><?= h($category->parent_id) ?></td>
            </tr>
            <tr>
                <th><?= __('Name:- ') ?></th>
                <td><?= h($category->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Description:- ') ?></th>
                <td><?= h($category->description) ?></td>
            </tr>
            <tr>
                <th><?= __('Created:-') ?></th>
                <td><?= h($category->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified:- ') ?></th>
                <td><?= h($category->modified) ?></td>
            </tr>
        </table>
        <?= $this->Html->link('Back', $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
