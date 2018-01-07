<?php

use Illuminate\Database\Seeder;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('degrees')->insert([
            ['faculty_id' => 1, 'name' => 'Bachelor në "Inxhinieri Matematike dhe Informatike"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Biologji"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Bioteknologji"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Fizikë"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Informatikë"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Kimi dhe Teknologji Ushqimore"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Kimi Industriale e Mjedisore"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Kimi"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Matematikë"'],
            ['faculty_id' => 1, 'name' => 'Bachelor në "Teknologji Informacioni dhe Komunikimi"']
        ]);
    }
}
