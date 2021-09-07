<?php

use App\Models\EstadoCivil;
use Illuminate\Database\Seeder;

class EstadoCivilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            ['codigo' => '001', 'nome' => 'Solteiro(a)'],
            ['codigo' => '002', 'nome' => 'Casado(a)'],
            ['codigo' => '003', 'nome' => 'Divorciado(a)'],
            ['codigo' => '004', 'nome' => 'Viúvo(a)'],
            ['codigo' => '005', 'nome' => 'Separado(a)'],
            ['codigo' => '006', 'nome' => 'Companheiro(a)'],
        ];

        $rows = 0;
        foreach ($dados as $d) {
            EstadoCivil::query()->updateOrCreate(['codigo' => $d['codigo']], $d);
            $rows++;
        }

        $this->command->info($rows . ' Estados Civis Cadastrados.');
    }
}
