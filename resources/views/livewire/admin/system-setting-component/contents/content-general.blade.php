<h4>General</h4>

<div class="separator mt-4 mb-4"></div>

<?php
$dt = [
    'name' => 'name',
    'text' => 'Nombre',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'description',
    'text' => 'Descripción',
    'required' => 1,
    'no_ignore' => 1,
];
?>
@include('livewire.widgets.admin.form.textarea-h', $dt)

<?php
$dt = [
    'name' => 'executive',
    'text' => 'Ejecutivo',
    'required' => 1,
    'object' => 'fullname',
    'options' => \App\Models\User::select('users.*')
        ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
        ->get()
];
?>
@include('livewire.widgets.admin.form.select-h', $dt)

<?php
$dt = [
    'name' => 'phones.0',
    'text' => 'Telefono',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'phones.1',
    'text' => '',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'phones.2',
    'text' => '',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'emails.0',
    'text' => 'Email',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'emails.1',
    'text' => '',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'emails.2',
    'text' => '',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'addresses.0',
    'text' => 'Dirección',
    'required' => 1,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'addresses.1',
    'text' => '',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'addresses.2',
    'text' => '',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

<?php
$dt = [
    'name' => 'campus',
    'text' => 'SEDE',
    'required' => 0,
    'type' => 'text',
];
?>
@include('livewire.widgets.admin.form.input-h', $dt)

