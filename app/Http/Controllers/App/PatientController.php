<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        // depois você busca do banco e passa no props
        return Inertia::render('Patients/Index', [
            // 'patients' => Patient::...;
        ]);
    }
}
