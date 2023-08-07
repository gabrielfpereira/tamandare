<?php

use App\Models\{Record, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseMissing, delete};

it('should delete a record', function () {
    $user   = User::factory()->create();
    $record = Record::factory()->for($user)->create();

    actingAs($user);

    delete(route('records.destroy', $record))
        ->assertRedirect(route('records.index'));

    expect($record->fresh())->toBeNull();
});

it('should not delete a record', function () {
    $owner     = User::factory()->create();
    $unkannown = User::factory()->create();
    $record    = Record::factory()->for($owner)->create();

    actingAs($unkannown);

    delete(route('records.destroy', $record))
        ->assertForbidden();

    assertDatabaseCount('records', 1);

    actingAs($owner);

    delete(route('records.destroy', $record))
         ->assertRedirect(route('records.index'));

    assertDatabaseMissing('records', ['id' => $record->id]);

});
