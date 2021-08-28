<?php

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadeTableSeeder extends Seeder
{
    public function run()
    {
        \DB::beginTransaction();
        $this->getMunicipio();
       \DB::commit();
    }

    public function getMunicipio()
    {
        $file = database_path('cargacsv/cidade.csv');

        $handle = fopen($file, 'r');
        $row = 0;
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            if ($row++ == 0) {
                continue;
            }
            $data_array = array(
                'id' => $data[0],
                'nome' => $data[1],
                'estado_id' => $data[3]
            );

            Cidade::query()->updateOrCreate($data_array);
        }
        fclose($handle);
        // Exibe uma informação no console durante o processo de seed
        $this->command->info($row - 1 . " municipios criados.\n");
    }
}
