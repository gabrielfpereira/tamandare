<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        return view('records.index');
    }

    public function store(StoreRecordRequest $request)
    {
        $user = auth()->user();

        Record::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => $user->id]
            )
        );

        return redirect()->route('records.index');
    }
}
