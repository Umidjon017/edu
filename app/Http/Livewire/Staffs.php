<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Staff;
use Livewire\WithPagination;

class Staffs extends Component
{
    use WithPagination;
    
    public $organizations;
    public $organization_id;

    public function render()
    {
        $staffs=Staff::school();

        if(isset($this->organization_id)){
            $staffs->where('organization_id', $this->organization_id);
        }
        $staffs=$staffs->latest()->paginate(10);
        return view('livewire.staffs',compact('staffs'));
    }
}