<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Models\{Item, Record, Student};
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RecordController extends Controller
{
    public function index(): View
    {
        $records = Record::with('student')->paginate();

        return view('records.index', compact('records'));
    }

    public function create(): View
    {
        $items = Item::all();

        return view('records.create', compact('items'));
    }

    public function store(StoreRecordRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $student = Student::firstOrCreate([
            'name'  => $data['name_student'],
            'class' => $data['class_student'],
        ]);

        $user = auth()->user();

        $data['user_id']    = $user->id;
        $data['student_id'] = $student->id;
        // dd($data);
        $record = Record::query()->create($data);
        $record->items()->attach($data['items']);

        return redirect()->route('records.index');
    }

    public function show(Record $record): View
    {
        $record = Record::query()
        ->with('student')
            ->with('items')
            ->find($record->id);

        return view('records.show', compact('record'));

    }
}
