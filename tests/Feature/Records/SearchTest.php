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

it('should search records by class of student', function () {
    $user     = User::factory()->create();
    $student1 = Student::factory()->create(['name' => 'John Doe', 'class' => '1201']);
    $student2 = Student::factory()->create(['name' => 'Ken Doe', 'class' => '1202']);

    Record::factory()->create([
        'user_id'    => $user->id,
        'student_id' => $student1->id,
        'type'       => 'Medida',
    ]);

    Record::factory()->create([
        'user_id'    => $user->id,
        'student_id' => $student2->id,
        'type'       => 'Medida',
    ]);

    actingAs($user);

    $response = get(route('records.index', [
        'search_class' => '1201',
    ]))->assertOk();

    $response->assertSee($student1->class);

    $response->assertDontSee($student2->class);

});

it('should search records by date', function () {
    $user     = User::factory()->create();
    $student1 = Student::factory()->create(['name' => 'John Doe']);
    $student2 = Student::factory()->create(['name' => 'Ken Doe']);

    Record::factory()->create([
        'user_id'    => $user->id,
        'student_id' => $student1->id,
        'type'       => 'Medida',
        'created_at' => now()->subDays(2),
    ]);

    Record::factory()->create([
        'user_id'    => $user->id,
        'student_id' => $student2->id,
        'type'       => 'Medida',
        'created_at' => now()->subDays(1),
    ]);

    actingAs($user);

    $response = get(route('records.index', [
        'search_date' => now()->subDays(1)->format('Y-m-d'),
    ]));

    $response->assertOk();

    $response->assertSee($student2->name);

    $response->assertDontSee($student1->name);

});
