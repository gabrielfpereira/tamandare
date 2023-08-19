<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::query()
            ->when(request('search'), fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->when(request('search_class'), fn ($query, $class) => $query->where('class', $class))
            ->paginate();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        Student::query()->create($request->validated());

        return to_route('students.index')->with('success', 'Student created successfully');
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(Student $student, StoreStudentRequest $request): RedirectResponse
    {
        $student->update($request->validated());

        return to_route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return to_route('students.index')->with('success', 'Student deleted successfully');
    }
}
