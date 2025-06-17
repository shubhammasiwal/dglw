<?php

namespace App\Http\Controllers\LGD;

use App\Models\LGDDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LGDDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $l_g_d_districts = LGDDistrict::orderByDesc('created_at')->get();
        return view('pages.LGDDistrict.index', compact('l_g_d_districts'));
    }

    
}
