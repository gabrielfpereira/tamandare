<?php

use App\Models\{Record, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

it('should update the status of a record', function () {
    $user   = User::factory()->create();
    $record = Record::factory()->for($user)->create(['status' => 'pending']);

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

it('should update the status of a record only if the user is authorized', function () {
    $userOwner = User::factory()->create();
    $record    = Record::factory()->for($userOwner)->create();

    $userUnknown = User::factory()->create();

    actingAs($userUnknown);

    put(route('records.update', $record), [
        'status' => 'accepted',
    ])->assertForbidden();

    actingAs($userOwner);

    put(route('records.update', $record), [
        'status' => 'accepted',
    ])->assertRedirect(route('records.index'));

});
