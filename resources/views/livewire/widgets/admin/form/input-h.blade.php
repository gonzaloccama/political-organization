@if(isset($name) && !empty($name))
    <?php
    $txt = '';
    if (isset($dimensions) && !empty($dimensions)) {
        $txt = '<span class="text-danger font-10">(resolución: <b>' . $dimensions . '</b>)</span>';
    }
    ?>

    <div class="form-group row">
        <label for="{{ $name }}"
               class="col-md-4 col-form-label">{!! $text !!} {!! $required ? $txt . '<i class="text-danger">*</i>':'' !!}</label>
        <div class="col-md-8 @error($name) error-validate @enderror">

            @if(in_array($type, ['text', 'password']))
                <input type="{{ $type }}" class="form-control" id="{{ $name }}" wire:model="{{ $name }}"
                       {{ isset($readonly) && !empty($readonly) ? 'readonly' : '' }} placeholder="{{ $text }}"
                       @if(isset($keyup) && !empty($keyup)) wire:keyup="{{ $keyup }}" @endif
                       autocomplete="off">
            @elseif($type == 'checkbox')
                <div class="custom-switch custom-switch-primary mb-1">
                    <input class="custom-switch-input" id="{{ $name }}" type="{{ $type }}"
                           wire:model="{{ $name }}">
                    <label class="custom-switch-btn" for="{{ $name }}"></label>
                </div>
            @elseif($type == 'file')
                <?php
                $acc = isset($accept) && !empty($accept) ? $accept == 'image' ? 'image/jpeg, image/png, image/png' : 'application/pdf' : '';
                ?>
                <div class="input-group mb-0">
                    <?php
                    $filename = '<span style="color: #8d8d8d">Elejir archivo</span>';
                    $status = '<span style="color: #8d8d8d">Cargar</span>';
                    if (isset($file) && !empty($file) && !isset($multiple)) {
                        $status = '<span style="color: #2eac63"><i class="fas fa-check"></i> Cargado</span>';
                        $filename = '<span style="color: #8d8d8d">' . $file->getClientOriginalName() . '</span>';
                    }elseif (!isset($multiple) && isset($preview)){
                        $filename = '<span style="color: #8d8d8d">' . $preview . '</span>';
                    }
                    ?>
                    <div class="input-group-prepend">
                        <span class="input-group-text">{!! $status !!}</span>
                    </div>
                    <div class="custom-file">
                        <input type="{{ $type }}" class="custom-file-input" id="{{ $name }}" wire:model="{{ $name }}"
                               accept="{{ $acc }}" {{ isset($multiple) && !empty($multiple) ? 'multiple' : '' }}>

                        <label class="custom-file-label" for="{{ $name }}">
                            {!! $filename !!}
                        </label>
                    </div>
                </div>
                <div class="" wire:loading wire:target="{{ $name }}">Cargando...</div>

            @elseif($type == 'radio')
                {{--                <div class="radio-check">--}}
                {{--                    <input type="radio" value="{{ $val1[0] }}" id="{{ $val1[2] }}"--}}
                {{--                           wire:model="{{ $name }}">--}}
                {{--                    <input type="radio" value="{{ $val2[0] }}" id="{{ $val2[2] }}"--}}
                {{--                           wire:model="{{ $name }}">--}}
                {{--                    <label for="{{ $val1[2] }}" class="option option-1">--}}
                {{--                        <span>{{ $val1[1] }}</span>--}}
                {{--                    </label>--}}
                {{--                    <label for="{{ $val2[2] }}" class="option option-2">--}}
                {{--                        <span>{{ $val2[1] }}</span>--}}
                {{--                    </label>--}}
                {{--                </div>--}}

                <div class="radio-button">

                    <input type="radio" id="{{ $val1[2] }}" value="{{ $val1[0] }}" wire:model="{{ $name }}">
                    <label for="{{ $val1[2] }}">{{ $val1[1] }}</label>

                    <input type="radio" id="{{ $val2[2] }}" value="{{ $val2[0] }}" wire:model="{{ $name }}">
                    <label for="{{ $val2[2] }}">{{ $val2[1] }}</label>

                    <div id="flap">
                        <span class="content">
                            {{ $var_model == $val1[0] ? $val1[1] :  $val2[1] }}
                        </span>
                    </div>

                </div>

            @endif


            @include('livewire.widgets.admin.form.error')

            @if($type == 'file' && $accept == 'image')
                <div class="container_fluid">
                    @if(isset($file) && !empty($file))
                        @if(isset($multiple) && !empty($multiple))
                            @foreach($file as $f)
                                <img src="{{ $f->temporaryUrl() }}"
                                     class="list-thumbnail mt-2 border-0 shadow-sm"
                                     alt="" style="width: 80px !important; height: 80px !important;">
                            @endforeach
                        @else
                            <img src="{{ $file->temporaryUrl() }}"
                                 class="img-thumbnail mt-1 border-0 shadow-lg" width="164" alt="">
                        @endif
                    @elseif(isset($preview) && !empty($preview))
                        @if(isset($multiple) && !empty($multiple))
                            @foreach($preview as $p)
                                <img src="{{ asset('assets/') . '/' . $image_path . '/'. $p }}"
                                     class="list-thumbnail mt-2 border-0 shadow-sm" alt=""
                                     style="width: 80px !important; height: 80px !important;">
                            @endforeach
                        @else
                            <img src="{{ asset('assets/') . '/' . $image_path . '/'. $preview }}"
                                 class="img-thumbnail mt-1 border-0 shadow-lg" width="164" alt="">
                        @endif
                    @endif
                </div>
            @endif


        </div>
    </div>

@endif
