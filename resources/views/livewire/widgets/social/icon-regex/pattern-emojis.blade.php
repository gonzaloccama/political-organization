<?php
$pattern = '/:\%(.*?)\%:/s';

$replacement = '<img src="/assets/emojis/${1}-face.svg" alt="" width="' . $w . '">';

echo preg_replace($pattern, $replacement, $svg);
?>
