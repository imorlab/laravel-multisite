<?php

namespace App\Livewire;

use App\Models\Staff;
use App\Models\Site;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class StaffList extends Component
{
    public $staff = [];
    public $translations = [];
    public Site $site;

    public function mount(Site $site)
    {
        $this->site = $site;
        $this->loadStaff();
        $this->loadTranslations();
    }

    public function loadTranslations()
    {
        $this->translations = [
            'our_staff' => __('Nuestro Staff'),
            'view_profile' => __('Ver perfil'),
        ];
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        Log::info('Language changed in StaffList');
        $this->loadTranslations();
        $this->dispatch('$refresh');
    }

    public function loadStaff()
    {
        $this->staff = Staff::where('site_id', $this->site->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function render()
    {
        return view('livewire.staff-list', [
            'site' => $this->site
        ]);
    }
}
