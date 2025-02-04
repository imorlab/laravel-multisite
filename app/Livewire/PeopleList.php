<?php

namespace App\Livewire;

use App\Models\Person;
use App\Models\Site;
use App\Traits\WithTranslations;
use Livewire\Component;
use Livewire\Attributes\On;

class PeopleList extends Component
{
    use WithTranslations;

    public Site $site;
    public string $type;

    public function mount(Site $site, string $type)
    {
        $this->site = $site;
        $this->type = $type;
        $this->mountWithTranslations();
    }

    public function getTranslationKeys(): array
    {
        return [
            'staff' => 'content.staff',
            'cast' => 'content.cast',
            'creative_team' => 'content.creative_team',
            'view_profile' => 'content.view_profile',
            'no_people' => 'content.no_people',
            'back' => 'content.back'
        ];
    }

    #[On('language-changed')]
    public function refreshPeople()
    {
        $this->refreshTranslations();
    }

    public function render()
    {
        $people = Person::query()
            ->where('site_id', $this->site->id)
            ->where('type', $this->type)
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($person) {
                return [
                    'id' => $person->id,
                    'name' => $person->getName(),
                    'role' => $person->getRole(),
                    'character_name' => $person->getCharacterName(),
                    'bio' => $person->getBio(),
                    'photo' => $person->photo,
                    'slug' => $person->slug
                ];
            });

        return view('livewire.people-list', [
            'people' => $people,
            'site' => $this->site
        ]);
    }
}
