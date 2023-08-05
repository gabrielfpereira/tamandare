<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able create a Student', function () {
    $user = User::factory()->create();
    actingAs($user);

    post(route('students.store'), [
        'name'  => 'Gabriel Fernando Pereira',
        'class' => '8202',
    ])->assertRedirect();

    assertDatabaseCount('students', 1);

    assertDatabaseHas('students', [
        'name'  => 'Gabriel Fernando Pereira',
        'class' => '8202',
    ]);
});
