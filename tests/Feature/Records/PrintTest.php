<?php

use App\Models\{Record, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to print records', function () {
    $user   = User::factory()->create();
    $record = Record::factory()->create();

    actingAs($user);

    get(route('records.print', $record))->assertSuccessful();
});
