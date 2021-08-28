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
            'Solteiro(a)',
            'Casado(a)',
            'Divorciado(a)',
            'Viúvo(a)',
            'Separado(a)',
            'Companheiro(a)',
        ];

        $rows = 0;
        foreach ($dados as $d) {
            $d = trim(mb_strtoupper($d));
            EstadoCivil::query()->updateOrCreate(['nome' => mb_strtoupper($d)], ['nome' => $d]);
            $rows++;
        }

        $this->command->info($rows . ' Estados Civis Cadastrados.');
    }
}
