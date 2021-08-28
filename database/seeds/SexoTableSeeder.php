<?php

use App\Models\Sexo;
use Illuminate\Database\Seeder;

class SexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexos = [
            'Masculino',
            'Feminino'
        ];

        $rows = 0;
        foreach ($sexos as $sexo) {
            $sexo = trim(mb_strtoupper($sexo));
            Sexo::query()->updateOrCreate(['nome' => $sexo], ['nome' => $sexo]);
            $rows++;
        }

        $this->command->info($rows . ' Sexos cadastrados');
    }
}
