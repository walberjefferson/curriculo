<?php

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    public function run()
    {
        \DB::beginTransaction();
        $this->getEstado();
        \DB::commit();
    }

    public function getEstado()
    {
        $file = database_path('cargacsv/estado.csv');

        $handle = fopen($file, 'r');
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            if ($row++ == 0) {
                continue;
            }

            $data_array = ['id' => $data[0], 'nome' => $data[1], 'uf' => $data[2]];

            Estado::query()->updateOrCreate($data_array);
        }
        fclose($handle);
        $this->command->info($row - 1 . ' estados criados ou atualizados');
    }
}
