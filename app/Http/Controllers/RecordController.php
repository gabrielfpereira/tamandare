<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Models\{Item, Record, Student};
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request , Response};

class RecordController extends Controller
{
    public function index(): View
    {
        $records = Record::query()
                        ->when(request('search'), function ($query, $search) {
                            $students = Student::where('name', 'LIKE', "%{$search}%")->get();

                            if ($students->isNotEmpty()) {
                                $query->whereIn('student_id', $students->pluck('id'));
                            }

                            return $query;
                        })
                        ->when(request('search_class'), function ($query, $class) {
                            $students = Student::where('class', 'LIKE', "%{$class}%")->get();

                            if ($students->isNotEmpty()) {
                                $query->whereIn('student_id', $students->pluck('id'));
                            }

                            return $query;
                        })
                        ->when(request('search_date'), function ($query, $date) {
                            return $query->whereDate('created_at', $date);
                        })
                        ->paginate();

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

    public function destroy(Record $record): RedirectResponse
    {
        $this->authorize('delete', $record);

        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted');
    }

    public function print(Record $record): Response
    {
        $pdf = Pdf::loadView('records.print.record', compact('record'));

        return $pdf->stream();
    }

    public function update(Record $record, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required',
        ]);
        
        $record->update($data);

        return redirect()->route('records.index');
    }
}
