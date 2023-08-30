<?php

use App\Models\{Item, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, delete};

it('should delete an item', function () {
    $user = User::factory()->create();
    $item = Item::factory()->create();

    actingAs($user);

    delete(route('items.destroy', $item))->assertRedirect(route('items.index'));

    assertDatabaseCount('items', 0);
});
