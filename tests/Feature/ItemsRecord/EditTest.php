<?php

use App\Models\{Item, User};

use function Pest\Laravel\{actingAs, get, put};

it('should be able edit a item of record', function () {
    $user = User::factory()->create();
    $item = Item::factory()->create();

    actingAs($user);

    put(route('items.update', $item), [
        'name' => 'Test',
    ])->assertRedirect(route('items.index'));

    $item->refresh();

    expect($item->name)->toBe('Test');
});

it('should be able see form to edit a item of record', function () {
    $user = User::factory()->create();
    $item = Item::factory()->create();

    actingAs($user);

    get(route('items.edit', $item))->assertOk();
});

it('should not be able to edit a item with invalid data', function () {
    $user = User::factory()->create();
    $item = Item::factory()->create(['name' => 'My Item']);

    actingAs($user);

    put(route('items.update', $item), [
        'name' => '',
    ])->assertSessionHasErrors(['name' => 'The name field is required.']);

    $item->refresh();

    expect($item->name)->toBe('My Item');
});
