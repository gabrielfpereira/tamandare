<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index');
    }

    public function edit(Item $item): View
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        $item->update($request->all());

        return to_route('items.index');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return to_route('items.index');
    }
}
