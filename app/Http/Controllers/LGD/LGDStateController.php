<?php

namespace App\Http\Controllers\LGD;

use App\Models\LGDState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LGDStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $l_g_d_states = LGDState::orderByDesc('created_at')->get();
        return view('pages.LGDState.index', compact('l_g_d_states'));
    }
}
