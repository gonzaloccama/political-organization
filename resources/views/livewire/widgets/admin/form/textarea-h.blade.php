@if(isset($name) && !empty($name))
    <div class="form-group row">
        <label for="{{ $name }}" class="col-md-4 col-form-label">{{ $text }}
            {!! $required?'<i class="text-danger">*</i>':'' !!}
        </label>
        <div class="col-md-8 @error($name) error-validate @enderror">
            <div @if(!isset($no_ignore)  && empty($no_ignore)) wire:ignore  @endif>
                <textarea class="form-control scrollbar scroller" id="{{ $name }}" rows="5"
                          style="height: 95px; !important;"
                          wire:model="{{ $name }}" placeholder="{{ $text }}"></textarea>
            </div>
            @include('livewire.widgets.admin.form.error')
        </div>
    </div>
@endif


