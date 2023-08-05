<?php

use App\Models\Item;
use App\Models\Student;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able create a record', function () {
    $user = User::factory()->create();
    Item::factory(10)->create();
    Student::factory()->create();

    actingAs($user);

    post(route('records.store'), [
        'type' => 'Medida',
        'student_id' => 1,
        'items' => [1,2,3],
    ])->assertRedirect(route('records.index'));

    assertDatabaseHas('students', ['id' => 1]);

    assertDatabaseCount('records', 1);

    assertDatabaseHas('items', ['id' => 1]);
    assertDatabaseHas('items', ['id' => 2]);
    assertDatabaseHas('items', ['id' => 3]);

});