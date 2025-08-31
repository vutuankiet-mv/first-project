<?php

namespace App\Livewire;

use App\Models\Location;
use Livewire\Component;

class Locations extends Component
{
    public $name, $address, $phone;

    public $locationId;

    public $nameLocation;

    public $nameLocationDelete;

    public $isLocationMode;

    public function render()
    {
        $locations = Location::all();
        return view(
            'livewire.locations',
            [
                'locations' => $locations
            ]
        );
    }

    public function addLocation()
    {
        $this->dispatch('showLocationModal');
        $this->resetErrorBag();
        $this->name = $this->address = $this->phone = '';
    }

    public function createLocation()
    {
        $this->validate([
            'name' => 'required|unique:locations,name',
            'address' => 'required',
            'phone' => 'required',
        ]);
        Location::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);
        $this->dispatch('hideLocationModal');
    }

    public function deleteLocation($id)
    {
        $this->nameLocation = '';
        $location = Location::find($id);
        $this->nameLocationDelete = $location->name;
        $this->locationId = $location->id;
        $this->resetErrorBag();
        $this->dispatch('showDeleteModal');
    }

    public function deleteConfirm()
    {
        $this->validate([
            'nameLocation' => 'required'
        ]);

        $location = Location::find($this->locationId);
        $oldName = $location->name;
        $nameName = $this->nameLocation;

        if ($oldName === $nameName) {
            $location->delete();
            $this->dispatch('hideDeleteModal');
        } else {
            $this->addError('nameLocation','Name location does not match');
        }
    }

    public function editLocation($id)
    {
        $isLocationMode = true;
    }
}
