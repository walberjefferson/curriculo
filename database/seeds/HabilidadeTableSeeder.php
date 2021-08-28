<?php

use App\Models\Habilidade;
use Illuminate\Database\Seeder;

class HabilidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escolaridades = [
            ['codigo' => '001', 'nome' => 'ATENDIMENTO'],
            ['codigo' => '002', 'nome' => 'ADMINISTRATIVO'],
            ['codigo' => '003', 'nome' => 'COZINHEIRO(A)'],
            ['codigo' => '004', 'nome' => 'DESIGNER GRÁFICO'],
            ['codigo' => '005', 'nome' => 'VENDAS'],
            ['codigo' => '006', 'nome' => 'FINANCEIRO'],
            ['codigo' => '007', 'nome' => 'MARKETING DIGITAL'],
            ['codigo' => '008', 'nome' => 'MOTORISTA'],
            ['codigo' => '009', 'nome' => 'SERVICOS DOMÉSTICOS'],
            ['codigo' => '010', 'nome' => 'SEVICOS GERAIS'],
            ['codigo' => '011', 'nome' => 'MANUTENÇÃO EM COMPUTADOES'],
            ['codigo' => '012', 'nome' => 'PACOTE OFFICE'],
            ['codigo' => '013', 'nome' => 'EDITOR DE VÍDEOS'],
            ['codigo' => '014', 'nome' => 'FOTOGRAFIA'],
            ['codigo' => '015', 'nome' => 'MECÂNICO DE MOTO'],
            ['codigo' => '016', 'nome' => 'MECÂNICO DE CARRO'],
            ['codigo' => '017', 'nome' => 'AJUDANTE DE MECÂNICO (MOTO)'],
            ['codigo' => '018', 'nome' => 'AJUDANTE DE MECÂNICO (CARRO)'],
            ['codigo' => '019', 'nome' => 'MOTOBOY'],
            ['codigo' => '9999', 'nome' => 'OUTROS'],
        ];

        foreach ($escolaridades as $e) {
            Habilidade::query()->updateOrCreate(['codigo' => $e['codigo']], $e);
        }

        $this->command->comment('Habilidades cadastradas.');
    }
}
