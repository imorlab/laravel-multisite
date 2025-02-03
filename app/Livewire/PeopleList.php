<?php

namespace App\Livewire;

use App\Models\Person;
use App\Models\Site;
use Livewire\Component;

class PeopleList extends Component
{
    public Site $site;
    public string $type;

    public function mount(Site $site, string $type)
    {
        $this->site = $site;
        $this->type = $type;
    }

    protected function getTranslatedField($value)
    {
        if (empty($value)) {
            return null;
        }

        $locale = app()->getLocale();

        // Si es un string simple, devolverlo tal cual
        if (is_string($value) && !str_starts_with($value, '{')) {
            return $value;
        }

        // Intentar decodificar JSON
        try {
            if (is_string($value)) {
                $data = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE && isset($data[$locale])) {
                    return $data[$locale];
                }
            }
        } catch (\Exception $e) {
            // Si hay error al decodificar, devolver el valor original
            return $value;
        }

        // Si es un array, intentar obtener el valor del idioma actual
        if (is_array($value) && isset($value[$locale])) {
            return $value[$locale];
        }

        // Si todo falla, devolver el valor original
        return $value;
    }

    public function render()
    {
        $rawPeople = Person::query()
            ->where('site_id', $this->site->id)
            ->where('type', $this->type)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $people = $rawPeople->map(function ($person) {
            $translated = [
                'id' => $person->id,
                'name' => $this->getTranslatedField($person->name),
                'role' => $this->getTranslatedField($person->role),
                'character_name' => $this->getTranslatedField($person->character_name),
                'bio' => $this->getTranslatedField($person->bio),
                'photo' => $person->photo,
                'slug' => $person->slug
            ];
            
            return $translated;
        });

        return view('livewire.people-list', [
            'people' => $people,
            'site' => $this->site
        ]);
    }
}
