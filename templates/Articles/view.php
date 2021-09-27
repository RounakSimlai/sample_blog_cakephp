<?php
/**
 * @var \App\Model\Entity\Article $article
 * @var  \CodeItNow\BarcodeBundle\Utils\QrCode $qr
 */
?>
<div class="card">
    <div class="card-body" style="line-height: 4rem;">
        <h3><?= h($article->title) ?></h3>
        <table>
            <tr>
                <th><?= __('Article Id:- ') ?></th>
                <td><?= h($article->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Category Id:- ') ?></th>
                <td><?= h($article->category_id) ?></td>
            </tr>
            <tr>
                <th><?= __('Created:-') ?></th>
                <td><?= h($article->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified:- ') ?></th>
                <td><?= h($article->modified) ?></td>
            </tr>
        </table>
        <div class="text">
            <strong><?= __('Body') ?></strong>
            <blockquote>
                <?= $this->Text->autoParagraph(h($article->body)); ?>
            </blockquote>
            <?= $this->Html->link('Back', $this->request->referer(), ['class' => 'btn btn-primary']) ?>
        </div>
        <div class='qrCodeHeader'>
            <strong><?= __('Scan QR Code for details on phone') ?></strong>
            <br>
            <div class='qrCode'>
                <?= $qr ?>
            </div>
        </div>
    </div>
</div>
