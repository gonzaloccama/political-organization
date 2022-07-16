<h4>General</h4>

<div class="separator mt-4 mb-4"></div>

<?php
$dt = [
    'name' => 'logo',
    'text' => 'Logo',
    'required' => 0,
    'type' => 'file',
    'accept' => 'image',
    'file' => $logo,
    'editFile' => $edit_logo,
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'logo_white',
    'text' => 'Logo blanco',
    'required' => 0,
    'type' => 'file',
    'accept' => 'image',
    'file' => $logo_white,
    'editFile' => $edit_logo_white,
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'favicon',
    'text' => 'favicon',
    'required' => 0,
    'type' => 'file',
    'accept' => 'image',
    'file' => $favicon,
    'editFile' => $edit_favicon,
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)
