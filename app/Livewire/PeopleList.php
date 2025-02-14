<?php

namespace App\Livewire;

use App\Models\Site;
use Illuminate\Support\Collection;
use Livewire\Component;

class PeopleList extends Component
{
    public Site $site;
    public string $type;
    public Collection $staffList;

    public function mount(Site $site, string $type, Collection|array $staffList = [])
    {
        $this->site = $site;
        $this->type = $type;
        $this->staffList = is_array($staffList) ? collect($staffList) : $staffList;
    }

    public function render()
    {
        return view('livewire.people-list', [
            'people' => $this->staffList
        ]);
    }
}
