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

it('should be able search students by class', function () {
    $user     = User::factory()->create();
    $student1 = Student::factory()->create(['class' => '1201']);
    $student2 = Student::factory()->create(['class' => '1202']);

    actingAs($user);

    $response = get(route('students.index', [
        'search_class' => '1201',
    ]))->assertOk();

    $response->assertSee($student1->name);
    $response->assertDontSee($student2->name);

});
