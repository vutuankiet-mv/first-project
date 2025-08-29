<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tool;

class Tools extends Component
{
    public $name, $description;

    public $toolId;

    public $nameTool;

    public $nameToolDelete;

    public function render()
    {
        $tools = Tool::all();
        return view(
            'livewire.tools',
            [
                'tools' => $tools
            ]
        );
    }

    public function addTool()
    {
        $this->resetErrorBag();
        $this->name = '';
        $this->description = '';
        $this->dispatch('showToolModal');
    }

    public function createTool()
    {
        $this->validate([
            'name' => 'required|unique:tools,name',
            'description' => 'required',
        ]);

        Tool::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('hideToolModal');
    }

    public function deleteTool($id)
    {
        $this->nameTool = '';
        $this->resetErrorBag();
        $tool = Tool::find($id);
        $this->toolId = $tool->id;
        $this->nameToolDelete = $tool->name;

        $this->dispatch('showDeleteModal');
    }

    public function deleteConfirm()
    {

        $this->validate([
            'nameTool' => 'required',
        ]);
        $tool = Tool::find($this->toolId);
        $oldTool = $tool->name;
        $newTool = $this->nameTool;

        if ($oldTool === $newTool) {
            $tool->delete();
            $this->dispatch('hideDeleteModal');
        } else {
            $this->addError('nameTool', 'Tool does not match');
        }
    }
}
