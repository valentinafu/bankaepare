<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mungojne lendet me zgjedhje, por asgje nuk eshte e plote ne kete bote

        // Inxhinieri Matematike dhe Informatike
        DB::table('subjects')->insert([
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Analizë Matematike 1'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Algjebër 1'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Informatikë'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Hyrje në Gjeometri'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Hyrje në Arsyetimin Matematik'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Statistikë dhe Informatikë'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Gjuhë e Huaj'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Hyrje në Ekonomi'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Kulturë ekonomike dhe gjuhësore'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Analizë Matematike 2'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Algjebër 2'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Fizikë'],
            ['degree_id' => '1', 'school_year' => 1, 'name' => 'Gjeometri'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Algjeber Lineare'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Hyrje në Probabilitet'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Informatikë 2'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Analizë Matematike 2'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Kulturë Ekonomike e Gjuhësore 2'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Hyrje në Statistikë'],
            ['degree_id' => '1', 'school_year' => 2, 'name' => 'Grafe dhe Algoritmikë Numerike'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Ekuacione Diferenciale dhe Analizë per Zbatime'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Metoda të Analizës Numerike'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Probabilitet'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Njohje me Profesionin'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Procese Rasti dhe Analizë të Dhënash'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Analizë Numerike Matricore dhe Optimizim'],
            ['degree_id' => '1', 'school_year' => 3, 'name' => 'Informatikë 3']
        ]);

        // Informatikë
        DB::table('subjects')->insert([
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Bazat e informatikës'],
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Fizikë'],
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Matematikë'],
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Struktura të dhenash nën C'],
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Elektronikë'],
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Algjebër'],
            ['degree_id' => '5', 'school_year' => 1, 'name' => 'Anglisht'],
            ['degree_id' => '5', 'school_year' => 2, 'name' => 'Anglisht'],
            ['degree_id' => '5', 'school_year' => 2, 'name' => 'Matematikë e Aplikuar'],
            ['degree_id' => '5', 'school_year' => 2, 'name' => 'Programim Java'],
            ['degree_id' => '5', 'school_year' => 2, 'name' => 'Sisteme Multimediale'],
            ['degree_id' => '5', 'school_year' => 2, 'name' => 'Algoritmike nën C++'],
            ['degree_id' => '5', 'school_year' => 2, 'name' => 'Organizim  Kompjuteri dhe Arkitekturë'],
            ['degree_id' => '5', 'school_year' => 3, 'name' => 'Sisteme operimi'],
            ['degree_id' => '5', 'school_year' => 3, 'name' => 'Rrjetat'],
            ['degree_id' => '5', 'school_year' => 3, 'name' => 'Databaza nën Oracle'],
            ['degree_id' => '5', 'school_year' => 3, 'name' => 'Sisteme Logjike'],
            ['degree_id' => '5', 'school_year' => 3, 'name' => 'Teori gjuhësh'],
            ['degree_id' => '5', 'school_year' => 3, 'name' => 'Inxhinieri Softi dhe Programim në Ueb']
        ]);
    }
}
