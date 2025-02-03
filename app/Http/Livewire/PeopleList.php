<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PeopleList extends Component
{
    public $site;
    public $people;
    public $type;

    public function mount($site, $people, $type)
    {
        $this->site = $site;
        $this->people = $people;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.people-list');
    }
}
