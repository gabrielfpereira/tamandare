<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate();

        return view('students.index', compact('students'));
    }

    public function store(StoreStudentRequest $request)
    {
        Student::query()->create($request->validated());

        return back();
    }
}
