<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::with('user')
            ->where('company_id', auth()->user()->company_id)
            ->latest()
            ->paginate(5);

        return view('panel.incident-reporting.index', [
            'incidents' => $incidents,
        ]);
    }

}
