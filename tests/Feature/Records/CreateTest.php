<?php

use App\Models\{Item, Student, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able create a record', function () {
    $user = User::factory()->create();
    Item::factory(10)->create();
    Student::factory()->create();

    actingAs($user);

    post(route('records.store'), [
        'type'          => 'Medida',
        'name_student'  => 'Pedro Silva',
        'class_student' => '7202',
        'items'         => [1, 2, 3],
    ])->assertRedirect(route('records.index'));

    assertDatabaseHas('students', ['id' => 1]);

    assertDatabaseCount('records', 1);

    assertDatabaseHas('items', ['id' => 1]);
    assertDatabaseHas('items', ['id' => 2]);
    assertDatabaseHas('items', ['id' => 3]);

});
