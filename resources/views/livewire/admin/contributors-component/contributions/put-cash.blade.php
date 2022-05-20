<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border">
            <div class="card-body">
                <div class="position-absolute card-top-buttons mr-1">
                    <button class="btn btn-danger icon-button" id="cash" wire:click.prevent="cleanPutContribution">
                         <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line></svg>
                             </span>
                    </button>
                </div>
                <h5 class="card-title">Agregar en Efectivo</h5>
                {{--                @if(count($errors))--}}
                {{--                    @foreach ($errors->all() as $error)--}}
                {{--                        <div class="text-danger col-md-12 text-errors mb-3 font-italic">{!! $error !!}</div>--}}
                {{--                    @endforeach--}}
                {{--                @endif--}}



                <div class="row">
                    <div class="col-md-6">
                        <?php
                        $dt = [
                            'name' => 'amount',
                            'text' => 'Monto en (S/)',
                            'required' => 1,
                            'type' => 'text',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)

                        <?php
                        $dt = [
                            'name' => 'note',
                            'text' => 'Nota',
                            'required' => 0,

                        ];
                        ?>
                        @include('livewire.widgets.admin.form.textarea-h', $dt)
                    </div>
                    <div class="col-md-6">

                        <?php
                        $dt = [
                            'name' => 'type_file',
                            'text' => 'Archivo',
                            'val1' => ['document', '(PDF)', 'one'],
                            'val2' => ['image', '(Imagen)', 'two'],
                            'required' => 1,
                            'type' => 'radio',
                            'var_model' => $type_file,
                        ];
                        ?>

                        @include('livewire.widgets.admin.form.input-h', $dt)


                        <div wire:loading.remove wire:target="type_file">
                            <?php
                            $dt = [
                                'name' => 'attachment_file',
                                'text' => 'Evidencia',
                                'required' => 1,
                                'type' => 'file',
                                'accept' => $type_file,
                            ];
                            ?>
                            @include('livewire.widgets.admin.form.input-h', $dt)
                        </div>
                        <div class="form-group row">
                            <div class="offset-3 col-sm-9">
                                @if($attachment_file)
                                    <div class="mb-3">{{ $attachment_file->getClientOriginalName() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 d-flex">
                        <button type="submit" class="btn btn-secondary btn-sm ml-auto"
                                wire:click.prevent="saveContribution">
                            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
