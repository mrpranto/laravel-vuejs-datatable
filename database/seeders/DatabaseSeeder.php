<?php

namespace Database\Seeders;

use App\Models\ClassInfo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $classes = ['Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5', 'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10'];
        $classDetails = [];
        foreach ($classes as $class){
            $classDetails[] = [
                'class_name' => $class,
                'description' => $class,
            ];
        }
        ClassInfo::query()->insert($classDetails);

        \App\Models\Student::factory(200)->create();

    }
}
