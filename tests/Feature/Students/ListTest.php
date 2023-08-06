<?php

use App\Models\{Student, User};

use function Pest\Laravel\{actingAs, get};

it('should be able see students list', function () {
    $user     = User::factory()->create();
    $students = Student::factory(5)->create();

    actingAs($user);

    $request = get(route('students.index'));

    foreach ($students as $student) {
        $request->assertSee($student->name);
    }
});
