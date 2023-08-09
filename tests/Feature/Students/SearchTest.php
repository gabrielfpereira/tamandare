<?php

use App\Models\{Student, User};

use function Pest\Laravel\{actingAs, get};

it('should be able search students by name', function () {
    $user     = User::factory()->create();
    $student1 = Student::factory()->create(['name' => 'student']);
    $student2 = Student::factory()->create(['name' => 'Oher Thing']);

    actingAs($user);

    $response = get(route('students.index', [
        'search' => 'student',
    ]))->assertOk();

    $response->assertSee($student1->name);
    $response->assertDontSee($student2->name);
});
