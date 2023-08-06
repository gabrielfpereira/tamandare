<?php

use App\Models\Student;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;

it('should delete a student', function () {
    $user = User::factory()->create();
    $student = Student::factory()->create();

    actingAs($user);

    delete(route('students.destroy', $student))
        ->assertRedirect(route('students.index'));

    assertDatabaseMissing('students', [
        'id' => $student->id,
    ]);

});