@if(isset($name) && !empty($name))
    <div class="form-group row">
        <label for="{{ $name }}"
               class="col-md-4 col-form-label">{!! $required ? $text . ' <i class="text-danger">*</i>':'' !!}</label>
        <div class="col-md-8 @error($name) error-validate @enderror" wire:ignore>


            <input type="text" class="form-control" id="{{ $name }}" wire:model="{{ $name }}"
                   {{ isset($readonly) && !empty($readonly) ? 'readonly' : '' }} placeholder="{{ $text }}"
                   @if(isset($keyup) && !empty($keyup)) wire:keyup="{{ $keyup }}" @endif
                   autocomplete="off">

        </div>
    </div>
@endif
