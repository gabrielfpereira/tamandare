<?php

use App\Models\{Record, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

it('should update the status of a record', function () {
    $user   = User::factory()->create();
    $record = Record::factory()->create(['status' => 'pending']);

    actingAs($user);

    put(route('records.update', $record), [
        'status' => 'accepted',
    ])->assertRedirect(route('records.index'));

    $record->refresh();

    expect($record->status)->toBe('accepted');

    assertDatabaseHas('records', [
        'id'     => $record->id,
        'status' => 'accepted',
    ]);

});
