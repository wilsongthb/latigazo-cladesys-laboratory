<?php

namespace App\Http\Controllers\Laboratory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaboratoryViewsController extends Controller
{
    public function index(){
        return view('laboratory.index', [
            'job_descriptions' => config('laboratory.job_descriptions'),
            'doctor_names' => config('laboratory.doctor_names'),
            'job_status' => config('laboratory.job_status')
        ]);
    }
}
