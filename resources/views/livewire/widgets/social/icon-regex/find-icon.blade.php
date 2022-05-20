<?php
//$pattern = '/:%icon=([\w -]+)%:/'; this page has expired due to inactivity. Would you like to refresh the page

$pattern = '/:\%icon=(.*?)\%:/s';
$replacement = '<img src="/assets/images/icon/media/${1}.svg" alt="" width="'.$width.'">';

echo preg_replace($pattern, $replacement, $icon);
?>
{{--<img src="{{ asset($img) }}" alt="" width="30">--}}
