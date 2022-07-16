<h4>Redes Sociales</h4>

<div class="separator mt-4 mb-4"></div>

<?php
$dt = [
    'name' => 'facebook_page',
    'text' => 'Página Facebook',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'media_social.facebook',
    'text' => 'Facebook',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'media_social.youtube',
    'text' => 'YouTube',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'media_social.instagram',
    'text' => 'Instagram',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'media_social.twitter',
    'text' => 'Twitter',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'media_social.whatsapp',
    'text' => 'WhatsApp',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)
