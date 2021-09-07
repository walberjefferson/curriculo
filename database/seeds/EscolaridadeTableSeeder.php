<?php

use App\Models\Escolaridade;
use Illuminate\Database\Seeder;

class EscolaridadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escolaridades = [
            ['codigo' => '001', 'nome' => 'FUNDAMENTAL INCOMPLETO'],
            ['codigo' => '002', 'nome' => 'FUNDAMENTAL COMPLETO'],
            ['codigo' => '003', 'nome' => 'MÉDIO INCOMPLETO'],
            ['codigo' => '004', 'nome' => 'MÉDIO COMPLETO'],
            ['codigo' => '005', 'nome' => 'SUPERIOR INCOMPLETO'],
            ['codigo' => '006', 'nome' => 'SUPERIOR COMPLETO'],
        ];

        foreach ($escolaridades as $e) {
            Escolaridade::query()->updateOrCreate(['codigo' => $e['codigo']], $e);
        }

        $this->command->comment('Escolaridades cadastradas.');
    }
}
