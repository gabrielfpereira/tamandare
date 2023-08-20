<?php

use App\Models\{Record, Student, User};

use function Pest\Laravel\{actingAs, get};

it('should search records by name of student', function () {
    $user     = User::factory()->create();
    $student1 = Student::factory()->create(['name' => 'John Doe']);
    $student2 = Student::factory()->create(['name' => 'Ken Doe']);

    $record1 = Record::factory()->create([
        'user_id'    => $user->id,
        'student_id' => $student1->id,
        'type'       => 'Medida',
    ]);

    $record2 = Record::factory()->create([
        'user_id'    => $user->id,
        'student_id' => $student2->id,
        'type'       => 'Medida',
    ]);

    actingAs($user);

    $response = get(route('records.index', [
        'search' => 'John',
    ]))->assertOk();

    $response->assertSee($student1->name);

    $response->assertDontSee($student2->name);

});
