<?php

use App\Models\Record;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\put;

it('should update the status of a record', function () {
    $user = User::factory()->create();
    $record = Record::factory()->create(['status' => 'pending']);

    actingAs($user);

    put(route('records.update', $record), [
        'status' => 'accepted',
    ])->assertRedirect(route('records.index'));

    $record->refresh();

    expect($record->status)->toBe('accepted');
    
    assertDatabaseHas('records', [
        'id' => $record->id,
        'status' => 'accepted',
    ]);
    
});