<?php

namespace App\Http\Livewire\Admin;

use App\Models\CashContribution;
use App\Models\Income;
use Carbon\Carbon;
use File;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class IncomeComponent extends BaseComponent
{
    use WithFileUploads;

    public $income;
    public $note;
    public $amount;
    public $is_recurrent;
    public $origin;
    public $representative;
    public $status;

    public $attachment_file;
    public $editFile;

    public $headers = [
        'id' => 'ID',
        'income' => 'Ingreso',
        'amount' => 'Monto',
        'is_recurrent' => 'Recurrente',
        'origin' => 'Origen',
        'representative' => 'Represante',
        'status' => 'Estado',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'income' => '<b><ins>Ingreso</ins></b>',
        'note' => '<b><ins>Nota</ins></b>',
        'amount' => '<b><ins>Monto</ins></b>',
        'is_recurrent' => '<b><ins>Recurrente</ins></b>',
        'origin' => '<b><ins>Origen</ins></b>',
        'representative' => '<b><ins>Representante</ins></b>',
        'attachment_file' => '<b><ins>Evidencia</ins></b>',
        'status' => '<b><ins>Estado</ins></b>',
    ];

    protected $rules = [
        'income' => 'required|min:3',
        'note' => 'required|max:2048',
        'amount' => 'required|numeric|min:0',
        'is_recurrent' => 'nullable',
        'origin' => 'nullable',
        'representative' => 'nullable',
        'status' => 'nullable',

        'attachment_file' => 'nullable|mimes:png,jpg,jpeg|max:1024',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';
        $this->image_path = 'uploads/incomes';

        $this->is_recurrent = 0;
        $this->status = 1;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not']);
        $findIn = [];
        $table = 'incomes';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Income::orderBy($this->fieldSort, $this->sort)
            ->select($table . '.*')
            ->search($findIn, $this->keyWord)
            ->paginate($this->limit);

        $data['_title'] = 'Ingresos';

        $this->emit('refreshContent');

        return view('livewire.admin.income-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function openFrame()
    {
        $this->frame = 'add';
        $this->emit('refreshSection');
    }

    public function saveData()
    {
        $this->validate($this->rules, [], $this->attributes);
        $file = null;

        try {
            $data = new Income();

            if ($this->attachment_file) {
                $file = $data->attachment_file = $this->resizeImage($this->attachment_file);
            }

            $data->income = $this->income;
            $data->note = $this->note;
            $data->amount = $this->amount;
            $data->is_recurrent = $this->is_recurrent;
            $data->origin = $this->origin;
            $data->representative = $this->representative;
            $data->status = $this->status;

            if ($data->save()) {
                $this->emit('notification', ['Nuevo ingreso ha sido agregado exitosamente']);
                $this->closeFrame();
            }
        } catch (\Exception $e) {
            $this->deleteFile($file, $file);
            $this->emit('notification', ['No se pudo guardar el nuevo ingreso', 'rgba(255,2,52,0.56)']);
        }
    }

    public function edit($id = 0)
    {
        $this->cleanItems();

        $this->itemId = $id;
        $data = Income::where('id', $this->itemId)->first();

        $this->income = $data->income;
        $this->note = $data->note;
        $this->amount = $data->amount;
        $this->is_recurrent = $data->is_recurrent;
        $this->origin = $data->origin;
        $this->representative = $data->representative;
        $this->status = $data->status;

        $this->editFile = $data->attachment_file;

        $this->frame = 'edit';
        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);
            $file = null;

            try {
                $data = Income::find($this->itemId);

                if ($this->attachment_file) {
                    $file = $data->attachment_file = $this->resizeImage($this->attachment_file);
                }

                $data->income = $this->income;
                $data->note = $this->note;
                $data->amount = $this->amount;
                $data->is_recurrent = $this->is_recurrent;
                $data->origin = $this->origin;
                $data->representative = $this->representative;
                $data->status = $this->status;

                if ($data->save()) {
                    $this->deleteFile($this->attachment_file, $this->editFile);

                    $this->emit('notification', ['Nuevo egreso ha sido agregado exitosamente']);
                    $this->closeFrame();
                }
            } catch (\Exception $e) {
                $this->deleteFile($file, $file);
                $this->emit('notification', ['No se pudo guardar el nuevo ingreso', 'rgba(255,2,52,0.56)']);
            }
        }
    }

    private function resizeImage($file, $width = 720)
    {
//        if (!is_dir('assets/' . $this->image_path)) {
//            mkdir('assets/' . $this->image_path, 0755, true);
//        }

        $fileName = Carbon::now()->timestamp . '.' . $file->extension();
        $photo_resize = Image::make($file->getRealPath());
        $photo_resize->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $photo_resize->save('assets/' . $this->image_path . '/' . $fileName);

        return $fileName ?? null;
    }

    private function deleteFile($file, $delete)
    {
        if ($file) {
            File::delete(
                public_path('assets/' . $this->image_path . '/' . $delete)
            );
        }
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->income = null;
        $this->note = null;
        $this->amount = null;
        $this->is_recurrent = 0;
        $this->origin = null;
        $this->representative = null;
        $this->attachment_file = null;
        $this->status = 1;

        $this->itemId = null;
        $this->editFile = null;
        $this->image_path = 'uploads/incomes';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Income::find($this->deleteId);
        $file = $data->attachment_file;

        if ($data->delete()) {
            $this->deleteFile($file, $file);
            $this->closeFrame();
        }
    }

    public function deleteConfirm($id)
    {
        $this->deleteId = $id;
        $this->emit('deleteAlert');
    }
}
