<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class IncidentController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return[
            new Middleware('permission:view incidents', only: ['index']),
        ];
    }
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
