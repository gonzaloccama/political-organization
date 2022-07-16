<h4>Misión y Visión</h4>

<div class="separator mt-4 mb-4"></div>


<?php
$dt = [
    'name' => 'mission',
    'text' => 'Misión',
    'required' => 1,
    'no_ignore' => 1,
];
?>
@include('livewire.widgets.admin.form.textarea-h', $dt)

<?php
$dt = [
    'name' => 'vision',
    'text' => 'Misión',
    'required' => 1,
    'no_ignore' => 1,
];
?>
@include('livewire.widgets.admin.form.textarea-h', $dt)

<?php
$dt = [
    'name' => 'objectives',
    'text' => 'Objetivos',
    'required' => 1,
    'no_ignore' => 1,
];
?>
@include('livewire.widgets.admin.form.textarea-h', $dt)
