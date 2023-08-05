<?php

use App\Models\Record;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should be able see records list', function () {
   $user = User::factory()->create();
   $records = Record::factory(5)->create();

   actingAs($user);

   $response = get(route('records.index'));

   foreach ($records as $record) {
       $response->assertSee($record->student->name);
   }
});