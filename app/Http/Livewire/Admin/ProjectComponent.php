<?php

namespace App\Http\Livewire\Admin;

use App\Models\Project;
use App\Models\ProjectBug;
use App\Models\ProjectDiscussion;
use App\Models\ProjectFile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectComponent extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $note;

    public $summary;
    public $description;
    public $responsible;
    public $team;
    public $priority;
    public $estimated_hours;
    public $start_date;
    public $end_date;

    /*** discussion ***/
    public $project_id;
    public $user_id;

    public $discussion;

    public $bug_note;

//    public $title;
//    public $note;
    public $attachment_file;

    public $type_file;

    public $loadMore;
    public $writeNote;
    public $deleteIdNote;

    /*** status project ***/
    public $progress;
    public $status;

    public $tab;
    public $users;

    public $project;

    /*** modal ***/
    public $modal;
    public $showFile;

    public $headers = [
//        'id' => '#',
        'title' => 'Nombre del trabajo',
        'fullname' => 'Responsable',
        'start_date' => 'Inicio',
        'end_date' => 'Fin',
        'progress' => 'Progreso',
        'status' => 'Estado',

        'not' => '',
    ];

    protected $attributes = [
        'title' => '<b><ins>Nombre</ins></b>',
        'summary' => '<b><ins>Resumen</ins></b>',
        'description' => '<b><ins>Description</ins></b>',
        'responsible' => '<b><ins>Responsable</ins></b>',
        'team' => '<b><ins>Equipo</ins></b>',
        'priority' => '<b><ins>Prioridad</ins></b>',
        'estimated_hours' => '<b><ins>Horas estimadas</ins></b>',
        'start_date' => '<b><ins>Fecha de Inicio</ins></b>',
        'end_date' => '<b><ins>Fecha de Culminación</ins></b>',
        'progress' => '<b><ins>Progreso</ins></b>',
        'note' => '<b><ins>Nota</ins></b>',
        'status' => '<b><ins>Estado</ins></b>',
    ];
    protected $rules = [
        'title' => 'required|min:3',
        'summary' => 'required|max:180',
        'description' => 'required',
        'responsible' => 'required',
        'team' => 'nullable',
        'priority' => 'required',
        'estimated_hours' => 'required|numeric',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d',
        'progress' => 'nullable',
        'note' => 'nullable',
        'status' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'projects';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Project::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->select($table . '.*')
            ->join('users', 'users.id', $table . '.responsible')
            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
            ->paginate($this->limit);

        $data['_title'] = 'Trabajos';

        $this->emit('refreshContent');

        return view('livewire.admin.project-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    // BEGIN DYNAMIC METHODS

    public function openFrame()
    {
        $this->frame = 'add';
        $this->emit('refreshSection');
    }

    public function saveData()
    {
        $this->validate($this->rules, [], $this->attributes);

        $data = new Project();

        $data->title = $this->title;
        $data->summary = $this->summary;
        $data->description = $this->description;
        $data->responsible = $this->responsible;
        $data->team = json_encode($this->team);
        $data->priority = $this->priority;
        $data->estimated_hours = $this->estimated_hours;
        $data->start_date = $this->start_date;
        $data->end_date = $this->end_date;
        $data->note = $this->note;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo trabajo exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';

        $this->itemId = $id;
        $data = Project::where('id', $this->itemId)->first();



        $this->title = $data->title;
        $this->summary = $data->summary;
        $this->description = $data->description;
        $this->responsible = $data->responsible;
        $this->team = json_decode($data->team);
        $this->priority = $data->priority;
        $this->estimated_hours = $data->estimated_hours;
        $this->start_date = Carbon::parse($data->start_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($data->end_date)->format('Y-m-d');
        $this->note = $data->note;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = Project::find($this->itemId);

            $data->title = $this->title;
            $data->summary = $this->summary;
            $data->description = $this->description;
            $data->responsible = $this->responsible;
            $data->team = json_encode($this->team);
            $data->priority = $this->priority;
            $data->estimated_hours = $this->estimated_hours;
            $data->start_date = $this->start_date;
            $data->end_date = $this->end_date;
            $data->note = $this->note;

            if ($data->save()) {
                $this->emit('notification', ['Trabajo actualizado exitosamente']);
                $this->closeFrame();
            }
        }
    }

    public function show($id)
    {
        $this->itemId = $id;
        $this->project = Project::find($this->itemId);
        $this->users = User::all();

        $this->progress[] = $this->project->progress;
        $this->status = $this->project->status;
        $this->priority = $this->project->priority;

        $this->frame = 'show';
        $this->openTab('overview');

        $this->emit('refreshSection');
        $this->emit('noviSlider');
    }

    public function saveStatus()
    {
        $data = Project::find($this->itemId);

        $data->progress = $this->progress[0];
        $data->status = $this->status;

        if ($data->save()) {
            $this->emit('notification', ['Estados actualizados exitosamente']);
        }
    }

    /*****/
    public function openTab($tab)
    {
        $this->tab = $tab;
        $this->loadMore = 5;
        $this->writeNote = null;
        $this->type_file = 'document';
    }

    public function updateLoadMore()
    {
        $this->loadMore += 3;
    }

    public function updateWriteNote($mode = null)
    {
        if ($mode == 'open') {
            $this->writeNote = true;
            $this->emit('refreshTab');
        } else {
            $this->writeNote = false;
        }
    }

    public function deleteCustomConfirm($id)
    {
        $this->deleteIdNote = $id;
        $this->emit('deleteCustom');
    }

    public function deleteCustom()
    {
        if ($this->tab == 'discussion') {
            $data = ProjectDiscussion::findOrFail($this->deleteIdNote);

            if ($data->delete()) {
                $this->emit('onlyRefresh');
            }
        } elseif ($this->tab == 'bug') {
            $data = ProjectBug::findOrFail($this->deleteIdNote);

            if ($data->delete()) {
                $this->emit('onlyRefresh');
            }
        } elseif ($this->tab == 'file') {
            $data = ProjectFile::findOrFail($this->deleteIdNote);
            $file = $data->attachment_file;

            if ($data->delete()) {
                $this->emit('onlyRefresh');
                File::delete(
                    public_path('assets/uploads/projects/' . $file),
                );
            }
        }

    }

    public function updateTab()
    {
        if ($this->tab == 'discussion') {
            $this->validate(['discussion' => 'required'], [], ['discussion' => 'Debate']);
            $data = new ProjectDiscussion();

            $data->project_id = $this->itemId;
            $data->user_id = auth()->user()->id;
            $data->discussion = $this->discussion;

            if ($data->save()) {
                $this->emit('notification', ['Nueva nota añadida exitosamente', 'refresh']);
                $this->writeNote = null;
                $this->closeTab();
            }


        } elseif ($this->tab == 'bug') {
            $this->validate(['bug_note' => 'required'], [], ['bug_note' => 'Insidencia']);
            $data = new ProjectBug();

            $data->project_id = $this->itemId;
            $data->user_id = auth()->user()->id;
            $data->bug_note = $this->bug_note;

            if ($data->save()) {
                $this->emit('notification', ['Nueva inididencia añadida exitosamente', 'refresh']);
                $this->writeNote = null;
                $this->closeTab();
            }


        } elseif ($this->tab == 'file') {
            $this->validate(
                ['attachment_file' => 'required', 'title' => 'required', 'note' => 'nullable'],
                [],
                ['attachment_file' => 'Archivo', 'title' => 'Título', 'note' => 'Nota']);

            if ($this->attachment_file) {
                $fileSourceName = Carbon::now()->timestamp . '.' . $this->attachment_file->extension();
                $this->attachment_file->storeAs('uploads/projects/', $fileSourceName);
            }

            $data = new ProjectFile();

            $data->project_id = $this->itemId;
            $data->user_id = auth()->user()->id;
            $data->title = $this->title;
            $data->type_file = $this->type_file;
            $data->attachment_file = $fileSourceName;
            $data->note = $this->note;

            if ($data->save()) {
                $this->emit('notification', ['Nueva inididencia añadida exitosamente', 'refresh']);
                $this->writeNote = null;
                $this->closeTab();
            }
        }
    }

    public function openFile($id, $show)
    {
        $this->modal = 'show-modal';

        if ($id) {
            if ($show == 'file') {
                $this->showFile = ProjectFile::find($id);
            }
        }

        $this->emit('showModal');
    }

    public function closeFile()
    {
        $this->modal = null;
        $this->showFile = [];
    }

    public function closeTab()
    {
        $this->project_id = null;
        $this->user_id = null;
        $this->discussion = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    /*****/
    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->title = null;
        $this->summary = null;
        $this->description = null;
        $this->responsible = null;
        $this->team = null;
        $this->priority = null;
        $this->estimated_hours = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->note = null;

        $this->progress = null;

        $this->itemId = null;
        $this->project = null;
        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Project::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
