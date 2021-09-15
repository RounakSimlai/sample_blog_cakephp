<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $messages = json_decode($message, true);
    foreach ($messages as $msg) {
        foreach ($msg as $m) {
            $message = h($m);
        }
    }
}
?>
<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>
