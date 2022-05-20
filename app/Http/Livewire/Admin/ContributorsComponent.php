<?php

namespace App\Http\Livewire\Admin;

use App\Models\CashContribution;
use App\Models\Contributor;
use App\Models\MaterialContribution;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
use Log;

class ContributorsComponent extends BaseComponent
{
    use WithFileUploads;

    public $user_id;

    public $contributor;

    /** Contributions **/
    public $contributor_id;
    public $type_file;
    public $attachment_file;
    public $note;

    /** Cash Contribution **/
    public $amount;

    /*** Materials Contribution ***/
    public $material;
    public $quantity;
    public $unit;

    /** frame Contribution **/
    public $putContribution;

    /*** delete contribution ***/
    public $deleteIdContribution;
    public $deleteShowContribution;

    public $modal;
    public $showFile;

    public $headers = [
//        'id' => 'ID',
        'user_dni' => 'DNI',
        'fullname' => 'Nombres',
        'phone' => 'Celular',
        'status' => 'Aportante',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'user_id' => '<b><ins>Aportante</ins></b>',

        'contributor_id' => '<b><ins>Aportante</ins></b>',
        'type_file' => '<b><ins>Tipo de archivo</ins></b>',
        'attachment_file' => '<b><ins>Archivo</ins></b>',
        'note' => '<b><ins>Nota</ins></b>',

        'amount' => '<b><ins>Monto</ins></b>',

        'material' => '<b><ins>Material</ins></b>',
        'quantity' => '<b><ins>Cantidad</ins></b>',
        'unit' => '<b><ins>Unidad de medida</ins></b>',
    ];

    protected $rules = [
        'user_id' => 'required',

        'contributor_id' => 'required',
        'type_file' => 'required',
        'attachment_file' => 'required|mimes:jpg,jpeg,png,pdf|max:1520',
        'note' => 'nullable',

        'amount' => 'required|numeric',

        'material' => 'required|min:3',
        'quantity' => 'required|numeric',
        'unit' => 'required',
    ];

    public function mount()
    {
        $this->limit = 10;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';
        $this->putContribution = null;
        $this->modal = null;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname', 'phone', 'user_dni']);
        $findIn = [];
        $table = 'contributors';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }
        $findIn[] = 'users.phone';
        $findIn[] = 'users.user_dni';

        $data['results'] = Contributor::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(user_firstname, ' ', user_lastname)"), 'LIKE', '%' . $this->keyWord . '%');
            })
            ->select($table . '.*')
            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname, users.phone, users.user_dni')
            ->leftJoin('users', 'users.id', $table . '.user_id')
            ->paginate($this->limit);

        $data['_title'] = 'Aportantes';

        $this->emit('refreshContent');

        return view('livewire.admin.contributors-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function updatePutContribution($frame = null)
    {
        $this->putContribution = 'put-' . $frame;
        $this->type_file = 'document';
        $this->contributor_id = $this->itemId;
    }

    public function saveContribution()
    {
        if ($this->putContribution == 'put-cash') {

            $rules = $this->rules;

            unset($rules['user_id'], $rules['material'], $rules['quantity'], $rules['unit']);
            $this->validate($rules, [], $this->attributes);

            if ($this->attachment_file) {
                $fileSourceName = Carbon::now()->timestamp . '.' . $this->attachment_file->extension();
                $this->attachment_file->storeAs('uploads/contributions/', $fileSourceName);
            }

            $data = new CashContribution();

            $data->contributor_id = $this->contributor_id;
            $data->amount = $this->amount;
            $data->type_file = $this->type_file;
            $data->attachment_file = $fileSourceName;
            $data->note = $this->note;

            if ($data->save()) {
                $this->updateStatus('Aporte en efectivo agregada exitosamente');
            }

        } elseif ($this->putContribution == 'put-materials') {

            $rules = $this->rules;
            unset($rules['user_id'], $rules['amount']);

            $this->validate($rules, [], $this->attributes);

            if ($this->attachment_file) {
                $fileSourceName = Carbon::now()->timestamp . '.' . $this->attachment_file->extension();
                $this->attachment_file->storeAs('uploads/contributions/', $fileSourceName);
            }

            $data = new MaterialContribution();

            $data->contributor_id = $this->contributor_id;
            $data->type_file = $this->type_file;
            $data->attachment_file = $fileSourceName;
            $data->note = $this->note;
            $data->material = $this->material;
            $data->quantity = $this->quantity;
            $data->unit = $this->unit;

            if ($data->save()) {
                $this->updateStatus('Aporte de material agregada exitosamente');
            }
        }
    }

    private function updateStatus($mssg = '')
    {
        $dt = Contributor::find($this->itemId);
        $dt->status = 1;
        $dt->save();

        $this->emit('notification', [$mssg]);
        $this->cleanPutContribution();
    }

    public function openFile($id, $show)
    {
        $this->modal = 'show_modal';

        if ($id) {
            if ($show == 'cash') {
                $this->showFile = CashContribution::find($id);
            } elseif ($show == 'materials') {
                $this->showFile = MaterialContribution::find($id);
            }
        }

        $this->emit('showModal');
    }

    public function show($id = 0)
    {
        $this->itemId = $id;

        $this->contributor = Contributor::find($this->itemId);

        $this->frame = 'edit';
    }

    public function updateData()
    {
//        if ($this->itemId) {
//            $this->validate($this->rules, [], $this->attributes);
//            $data = Contributor::find($this->itemId);
//
//
//            if ($data->save()) {
//                $this->emit('notification', ['Se guardó la nota exitosamente']);
//                $this->closeFrame();
//            }
//        }
    }

    public function openFrame()
    {
        $this->frame = 'add';
    }

    public function saveData()
    {
        $rules = $this->rules;
        unset(
            $rules['contributor_id'],
            $rules['type_file'],
            $rules['attachment_file'],
            $rules['note'],
            $rules['amount'],
            $rules['material'],
            $rules['quantity'],
            $rules['unit']
        );

        $this->validate($rules, [], $this->attributes);

        $data = new Contributor();

        $data->user_id = $this->user_id;

        if ($data->save()) {
            $this->emit('notification', ['Nuevo aportante creado exitosamente']);
            $this->cleanItems();
            $this->show($data->id);
        }
    }

    public function closeFile()
    {
        $this->modal = null;
        $this->showFile = [];
    }

    public function cleanPutContribution()
    {
        $this->putContribution = null;

        $this->contributor_id = null;
        $this->type_file = 'document';
        $this->attachment_file = null;
        $this->note = null;
        $this->amount = null;
        $this->material = null;
        $this->quantity = null;
        $this->unit = null;

        $this->deleteIdContribution = null;
        $this->deleteShowContribution = null;
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->contributor = null;

        $this->cleanItems();
        $this->cleanPutContribution();
    }

    public function cleanItems()
    {
        $this->user_id = null;
        $this->itemId = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function deleteCustomConfirm($id, $show)
    {
        $this->deleteIdContribution = $id;
        $this->deleteShowContribution = $show;
        $this->emit('deleteCustom');
    }

//1648535636.pdf
    public function deleteCustom()
    {
        if ($this->deleteIdContribution && $this->deleteShowContribution) {

            if ($this->deleteShowContribution == 'cash') {
                $data = CashContribution::findOrFail($this->deleteIdContribution);
            } elseif ($this->deleteShowContribution == 'materials') {
                $data = MaterialContribution::findOrFail($this->deleteIdContribution);
            }

            $file = $data->attachment_file;

            $contributor = Contributor::find($data->contributor->id);

            if ($data->delete()) {

                if (!$contributor->cashContribution->count() && !$contributor->materialContribution->count()) {
                    $contributor->status = 0;
                    $contributor->save();
                }

                $this->cleanPutContribution();
                $this->emit('onlyRefresh');
                File::delete(
                    public_path('assets/uploads/contributions/' . $file),
                );
            }
        }
    }

    public function delete()
    {
        $data = Contributor::findOrFail($this->deleteId);
        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
