<?php

namespace App\Http\Livewire\Admin;

use App\Models\Expense;
use Carbon\Carbon;
use File;
use Illuminate\Database\Eloquent\Model;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpensesComponent extends BaseComponent
{
    use WithFileUploads;

    public $reference;
    public $description;
    public $amount;
    public $is_recurrent;
    public $through;
    public $status;

    public $attachment_file;
    public $editFile;

    public $headers = [
        'id' => 'ID',
        'reference' => 'Referencia',
        'amount' => 'Monto',
        'is_recurrent' => 'Recurrente',
        'fullname' => 'Mediante',
        'status' => 'Estado',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'reference' => '<b><ins>Referencia</ins></b>',
        'description' => '<b><ins>Descripción</ins></b>',
        'amount' => '<b><ins>Monto</ins></b>',
        'is_recurrent' => '<b><ins>Recurrente</ins></b>',
        'through' => '<b><ins>A través</ins></b>',
        'status' => '<b><ins>Estado</ins></b>',

        'attachment_file' => '<b><ins>Evidencia</ins></b>',
//        'attachment_file_edit' => '<b><ins>Evidencia</ins></b>',
    ];

    protected $rules = [
        'reference' => 'required|min:3',
        'description' => 'required|min:10|max:2048',
        'amount' => 'required|numeric|min:0',
        'is_recurrent' => 'nullable',
        'through' => 'nullable',
        'status' => 'nullable',

        'attachment_file' => 'nullable|mimes:png,jpg,jpeg|max:1024',
//        'attachment_file_edit' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';
        $this->image_path = 'uploads/expenses';

        $this->is_recurrent = 0;
        $this->status = 1;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'expenses';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Expense::orderBy($this->fieldSort, $this->sort)
            ->select($table . '.*')
            ->search($findIn, $this->keyWord, 'users', ['user_firstname', 'user_lastname'])
            ->concatJoinId('users', ['user_firstname', 'user_lastname'], 'fullname', 'through')
            ->paginate($this->limit);

        $data['_title'] = 'Egresos';

        $this->emit('refreshContent');

        return view('livewire.admin.expenses-component', $data)->layout('layouts.base');
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
            $data = new Expense();

            if ($this->attachment_file) {
                $file = $data->attachment_file = $this->resizeImage($this->attachment_file);
            }

            $data->reference = $this->reference;
            $data->description = $this->description;
            $data->amount = $this->amount;
            $data->is_recurrent = $this->is_recurrent;
            $data->through = $this->through;
            $data->status = $this->status;

            if ($data->save()) {
                $this->emit('notification', ['Nuevo egreso ha sido agregado exitosamente']);
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
        $data = Expense::where('id', $this->itemId)->first();

        $this->reference = $data->reference;
        $this->description = $data->description;
        $this->amount = $data->amount;
        $this->is_recurrent = $data->is_recurrent;
        $this->through = $data->through;
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
                $data = Expense::find($this->itemId);

                if ($this->attachment_file) {
                    $file = $data->attachment_file = $this->resizeImage($this->attachment_file);
                }

                $data->reference = $this->reference;
                $data->description = $this->description;
                $data->amount = $this->amount;
                $data->is_recurrent = $this->is_recurrent;
                $data->through = $this->through;
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
        $fileName = Carbon::now()->timestamp . '.' . $file->extension();
        $photo_resize = Image::make($file->getRealPath());
        $photo_resize->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $photo_resize->save('assets/uploads/expenses/' . $fileName);

        return $fileName ?? null;
    }

    private function deleteFile($file, $delete)
    {
        if ($file) {
            File::delete(
                public_path('assets/uploads/expenses/' . $delete)
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
        $this->reference = null;
        $this->description = null;
        $this->amount = null;
        $this->is_recurrent = 0;
        $this->through = null;
        $this->attachment_file = null;
        $this->editFile = null;
        $this->status = 1;

        $this->itemId = null;
        $this->image_path = 'uploads/expenses';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Expense::find($this->deleteId);
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
