<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(StoreStudentRequest $request)
    {
        Student::query()->create($request->validated());

        return back();
    }
}
