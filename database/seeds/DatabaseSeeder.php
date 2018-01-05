<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            ['name' => 'Fakulteti i Shkencave të Natyrës'],
            ['name' => 'Fakulteti i Historisë dhe i Filologjisë'],
            ['name' => 'Fakulteti i Ekonomisë'],
            ['name' => 'Fakulteti i Drejtësisë'],
            ['name' => 'Fakulteti i Gjuhëve të Huaja'],
            ['name' => 'Fakulteti i Shkencave Sociale']
        ]);
        // Mbase Politekniku, Mjekesori etj

        $this->call(DegreesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
    }
}
