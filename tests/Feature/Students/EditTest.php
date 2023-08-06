<?php

use App\Models\{Student, User};

use function Pest\Laravel\{actingAs, get, put};

it('should be able see edit page', function () {
    $user    = User::factory()->create();
    $student = Student::factory()->create();

    actingAs($user);

    get(route('students.edit', $student))
        ->assertOk();
});

it('should be able update student', function () {
    $user    = User::factory()->create();
    $student = Student::factory()->create();

    actingAs($user);

    put(route('students.update', $student), [
        'name'  => 'John Doe',
        'class' => '8202',
    ])->assertRedirect(route('students.index'));

    $student->refresh();

    expect($student->name)->toBe('John Doe');
    expect($student->class)->toBe('8202');
});

it('should not be able update student with invalid data', function () {
    $user    = User::factory()->create();
    $student = Student::factory()->create();

    actingAs($user);

    put(route('students.update', $student), [
        'name'  => '',
        'class' => '',
    ])->assertSessionHasErrors([
        'name',
        'class',
    ]);

    $student->refresh();

    expect($student->name)->not->tobeNull();
    expect($student->class)->not->toBeNull();
});
