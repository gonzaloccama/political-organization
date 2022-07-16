<?php

namespace App\Http\Livewire\Admin;

use App\Models\PlanMention;
use Carbon\Carbon;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class PlanMentionComponent extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $abstract;
    public $content;
    public $population;
    public $region = 21;
    public $province = 165;
    public $town;
    public $location;
    public $file;
    public $files;
    public $type;
    public $representatives;

    public $editFile;
    public $editFiles;

    public $headers = [
        'id' => 'ID',
        'title' => 'Título',
        'town' => 'Distrito',
        'location' => 'Localización',
        'file' => 'Archivo',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'title' => '<b><ins>Título</ins></b>',
        'abstract' => '<b><ins>Resumen</ins></b>',
        'content' => '<b><ins>Contenido</ins></b>',
        'population' => '<b><ins>Población</ins></b>',
        'region' => '<b><ins>Región</ins></b>',
        'province' => '<b><ins>Provincia</ins></b>',
        'town' => '<b><ins>Distrito</ins></b>',
        'location' => '<b><ins>Localización</ins></b>',
        'file' => '<b><ins>Archivo</ins></b>',
        'files' => '<b><ins>Archivos</ins></b>',
        'type' => '<b><ins>Tipo</ins></b>',
        'representatives' => '<b><ins>Representantes</ins></b>',
    ];

    protected $rules = [
        'title' => 'required|min:3',
        'abstract' => 'required|min:10|max:2048',
        'content' => 'required',
        'population' => 'required|numeric',
        'region' => 'nullable',
        'province' => 'nullable',
        'town' => 'nullable',
        'location' => 'required|min:3',
        'file' => 'nullable|mimes:pdf|max:5124',
//        'files' => 'nullable|mimes:png,jpg,jpeg|max:1024',
        'type' => 'nullable',
        'representatives' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';
        $this->image_path = 'uploads/proposal';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not']);
        $findIn = [];
        $table = 'plan_mentions';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = PlanMention::orderBy($this->fieldSort, $this->sort)
            ->search($findIn, $this->keyWord)
            ->leftJoin('towns', 'towns.id', '=', $table . '.town')
            ->select($table . '.*', 'towns.name as town')
//            ->where($table . '.town', 'LIKE', '%%')
            ->paginate($this->limit);

        $data['_title'] = 'Propuestas';

        $this->emit('refreshContent');

        return view('livewire.admin.plan-mention-component', $data)->layout('layouts.base');
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
            $data = new PlanMention();

            if ($this->file) {
                $file = $data->file = Carbon::now()->timestamp . '.' . $this->file->extension();
                $this->file->storeAs($this->image_path . '/', $file);
            }

            if ($this->files) {
                $imagesName = [];
                foreach ($this->files as $key => $fs) {
                    $imgName = Carbon::now()->timestamp . $key . '.' . $fs->extension();
                    $fs->storeAs($this->image_path . '/', $imgName);

                    $imagesName[] = $imgName;
                }
                $data->files = json_encode($imagesName);
            }

            $data->title = $this->title;
            $data->abstract = $this->abstract;
            $data->content = $this->content;
            $data->population = $this->population;
            $data->region = $this->region;
            $data->province = $this->province;
            $data->town = $this->town;
            $data->location = $this->location;
            $data->type = 'proposal';

            if ($data->save()) {
                $this->emit('notification', ['Nuevo propuesta ha sido agregado exitosamente']);
                $this->closeFrame();
            }

        } catch (\Exception $e) {
            $this->deleteFile($file, $file);
            $this->emit('notification', ['No se pudo guardar la nueva propuesta', 'rgba(255,2,52,0.56)']);
        }
    }

    public function edit($id = 0)
    {
        $this->itemId = $id;
        $data = PlanMention::where('id', $this->itemId)->first();

        $this->title = $data->title;
        $this->abstract = $data->abstract;
        $this->content = $data->content;
        $this->population = $data->population;
        $this->region = $data->region;
        $this->province = $data->province;
        $this->town = $data->town;
        $this->location = $data->location;
        $this->editFile = $data->file;
        $this->editFiles = json_decode($data->files);
        $this->type = $data->type;
        $this->representatives = $data->representatives;

        $this->frame = 'edit';

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);
            $file = null;
            $files = null;

            try {
                $data = PlanMention::find($this->itemId);

                if ($this->file) {
                    $file = $data->file = Carbon::now()->timestamp . '.' . $this->file->extension();
                    $this->file->storeAs($this->image_path . '/', $file);
                }

                if ($this->files) {
                    $imagesName = [];
                    foreach ($this->files as $key => $fs) {
                        $imgName = Carbon::now()->timestamp . $key . '.' . $fs->extension();
                        $fs->storeAs($this->image_path . '/', $imgName);

                        $imagesName[] = $imgName;
                    }
                    $files = $data->files = json_encode($imagesName);
                }

                $data->title = $this->title;
                $data->abstract = $this->abstract;
                $data->content = $this->content;
                $data->population = $this->population;
                $data->region = $this->region;
                $data->province = $this->province;
                $data->town = $this->town;
                $data->location = $this->location;

                if ($data->save()) {
                    $this->deleteFile($this->file, $this->editFile);

                    if ($this->editFiles) {
                        foreach ($this->editFiles as $f) {
                            $this->deleteFile($this->files, $f);
                        }
                    }

                    $this->emit('notification', ['La propuesta ha sido actualizado exitosamente']);
                    $this->closeFrame();
                }
            } catch (\Exception $e) {
                $this->deleteFile($file, $file);
                foreach (json_decode($files) as $f) {
                    $this->deleteFile($f, $f);
                }
                $this->emit('notification', ['No se pudo guardar los cambios intenta de nuevo', 'rgba(255,2,52,0.56)']);
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
        $this->title = null;
        $this->abstract = null;
        $this->content = null;
        $this->population = null;
        $this->region = null;
        $this->province = null;
        $this->town = null;
        $this->location = null;
        $this->file = null;
        $this->files = null;
        $this->type = null;
        $this->representatives = null;
        $this->editFile = null;
        $this->editFiles = null;

        $this->image_path = 'uploads/proposal';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = PlanMention::find($this->deleteId);
        $file = $data->file;
        $files = json_decode($data->files);

        if ($data->delete()) {
            $this->deleteFile($file, $file);
            foreach ($files as $f){
                $this->deleteFile($f, $f);
            }
            $this->closeFrame();
        }
    }

    public function deleteConfirm($id)
    {
        $this->deleteId = $id;
        $this->emit('deleteAlert');
    }
}
