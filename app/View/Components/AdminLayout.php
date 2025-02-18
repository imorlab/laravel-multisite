<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        
        if (!$user || !($user instanceof User)) {
            return Redirect::route('login');
        }
        
        return view('layouts.admin', [
            'user' => $user
        ]);
    }
}
