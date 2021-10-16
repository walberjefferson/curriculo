<?php

namespace App\PDF;

class Curriculo extends AbstractPdf
{
    private $dados;
    private $foto;

    public function __construct($dados, $orientation = 'L', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
        $this->dados = $dados;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setSubTitulo($subtitulo)
    {
        $this->subTitulo = $subtitulo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function setFileName($name)
    {
        $this->fileName = $name;
    }

    public function setDestino($dest)
    {
        $this->destino = $dest;
    }

    public function Header()
    {
        $this->SetTextColor(140, 140, 140);
        $this->SetFont('Arial', 'B', 26);
        $this->SetDrawColor(217, 217, 217);
        $this->Cell(0, 14, fpdf_utf8($this->titulo), '0', 1, 'C');
        $this->Cell(0, 2, '', 'B', 1);
        $this->Ln(2);
    }

    public function Footer()
    {
        $this->AliasNbPages();
        $this->SetY(-15);
        $this->SetDrawColor(217, 217, 217);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 10, fpdf_utf8('Currículo gerado pelo portal Santana 360 Graus'), 'T', 1, 'C');
    }

    public function create()
    {
        $this->AddPage();
        $this->SetAutoPageBreak(true, 15);
        $this->SetFont('Arial', 'B', 8);

        $dados = $this->dados;

        // W - 190
        $this->SetFillColor(242, 242, 242);
        $this->SetDrawColor(217, 217, 217);
        $this->SetTextColor(140, 140, 140);

        // Foto
        if ($this->foto && is_file($this->foto)) {
            $this->Image($this->foto, null, $this->GetY(), 30, 40);
            $this->Rect(10, $this->GetY(), 30, 40, 'D');
        } else {
            $this->Cell(30, 40, 'FOTO', 1, 0, 'C', 1);
        }

        $this->SetFont('Arial', '', 8);
        $this->SetX(40);
        $this->Cell(85, 5, fpdf_utf8('Nome'), 'TR', 0, 'L', 0);
        $this->Cell(40, 5, fpdf_utf8('Sexo'), 'TR', 0, 'L', 0);
        $this->Cell(35, 5, fpdf_utf8('Data Nascimento'), 'TR', 1, 'L', 0);
        $this->SetX(40);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(85, 5, fpdf_utf8($dados->nome), 'BR', 0, 'L', 0);
        $this->Cell(40, 5, fpdf_utf8($dados->sexo ? $dados->sexo['nome'] : ''), 'BR', 0, 'L', 0);
        $this->Cell(35, 5, fpdf_utf8($dados->data_nascimento), 'BR', 1, 'L', 0);

        $this->SetFont('Arial', '', 8);
        $this->SetX(40);
        $this->Cell(25, 5, fpdf_utf8('CPF'), 'R', 0, 'L', 0);
        $this->Cell(40, 5, fpdf_utf8('Instagram'), 'R', 0, 'L', 0);
        $this->Cell(28, 5, fpdf_utf8('Telefone'), 'R', 0, 'L', 0);
        $this->Cell(28, 5, fpdf_utf8('Whatsapp'), 'R', 0, 'L', 0);
        $this->Cell(39, 5, fpdf_utf8('Estado Civil'), 'R', 1, 'L', 0);
        $this->SetX(40);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(25, 5, fpdf_utf8(mask_cpf_or_cnpj($dados->cpf)), 'BR', 0, 'L', 0);
        $this->Cell(40, 5, fpdf_utf8($dados->instagram ?? '---'), 'BR', 0, 'L', 0);
        $this->Cell(28, 5, fpdf_utf8($dados->telefone ?? '---'), 'BR', 0, 'L', 0);
        $this->Cell(28, 5, fpdf_utf8($dados->whatsapp ?? '---'), 'BR', 0, 'L', 0);
        $this->Cell(39, 5, fpdf_utf8($dados->estado_civil ? $dados->estado_civil['nome'] : ''), 'BR', 1, 'L', 0);

        $this->SetFont('Arial', '', 8);
        $this->SetX(40);
        $this->Cell(50, 5, fpdf_utf8('Escolaridade'), 'R', 0, 'L', 0);
        $this->Cell(110, 5, fpdf_utf8('Cidade / Estado'), 'R', 1, 'L', 0);
        $this->SetX(40);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 5, fpdf_utf8($dados->escolaridade ? $dados->escolaridade['nome'] : ''), 'BR', 0, 'L', 0);
        $cidade = $dados->cidade ? $dados->cidade['nome'] : '---';
        $estado = $dados->estado ? $dados->estado['nome'] : '---';
        $cidadeEstado = "{$cidade} / {$estado}";
        $this->Cell(110, 5, fpdf_utf8($cidadeEstado), 'BR', 1, 'L', 0);

        $this->SetFont('Arial', '', 8);
        $this->SetX(40);
        $this->Cell(52, 5, fpdf_utf8('PCD - (Portador de Deficiência Física)'), 'R', 0, 'L', 0);
        $this->Cell(54, 5, fpdf_utf8('CNH - (Carrteira Nacional de Habilitação)'), 'R', 0, 'L', 0);
        $this->Cell(54, 5, fpdf_utf8('Tem filhos?'), 'R', 1, 'L', 0);
        $this->SetX(40);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(52, 5, fpdf_utf8($dados->pcd ? 'Sim' : 'Não'), 'BR', 0, 'L', 0);
        $cnh = $dados->cnh ? 'Sim' : 'Não';
        $categoria = $dados->cnh ? ' - ' . $dados->categoria_cnh : null;
        $this->Cell(54, 5, fpdf_utf8("{$cnh}{$categoria}"), 'BR', 0, 'L', 0);
        $filhos = $dados->filhos ? 'Sim' : 'Não';
        $quantidadeFilhos = $dados->filhos ? ' - Quantos? ' . $dados->filhos_quantidade : null;
        $this->Cell(54, 5, fpdf_utf8("{$filhos}{$quantidadeFilhos}"), 'BR', 1, 'L', 0);


        $this->habilidades();
        $this->experiencias();
        $this->dadosPostais();
        $this->outrasInformacoes();
    }

    private function habilidades()
    {
        $dados = $this->dados;

        $this->SetFont('Arial', 'B', 11);
        $this->Ln(4);
        $this->Cell(0, 5, fpdf_utf8_uppercase("Habilidades"), '', 1, 'L', 0);

        $this->Ln(1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, fpdf_utf8('Habilidades'), 'LRT', 1, 'L', 0);
        $this->SetFont('Arial', 'B', 8);
        $experiencias = $dados->habilidades_count ? $dados->habilidades->implode('nome', ', ') : 'Nenhuma habilidade';
        $this->MultiCell(0, 5, fpdf_utf8($experiencias), 'LRB', 'L', 0);
    }

    private function experiencias()
    {
        $dados = $this->dados;

        $experiencias = $dados->experiencias;

        $this->SetFont('Arial', 'B', 11);
        $this->Ln(4);
        $this->Cell(0, 5, fpdf_utf8_uppercase("Experiências"), '', 1, 'L', 0);

        $this->Ln(1);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(60, 6, fpdf_utf8_uppercase('Cargo'), 'LRT', 0, 'L', 0);
        $this->Cell(60, 6, fpdf_utf8_uppercase('Empresa'), 'LRT', 0, 'L', 0);
        $this->Cell(40, 6, fpdf_utf8_uppercase('Tempo de Serviço'), 'LRT', 0, 'L', 0);
        $this->Cell(30, 6, fpdf_utf8_uppercase('Saída'), 'LRT', 1, 'L', 0);
        $this->SetFont('Arial', 'B', 8);

        $this->SetFont('Arial', '', 8);
        $this->SetWidths([60, 60, 40, 30]);
        $this->SetAligns(['L', 'L', 'L', 'L']);
        $fill = false;
        foreach ($experiencias as $e) {
            $d = [
                fpdf_utf8($e->cargo ?? '---'),
                fpdf_utf8($e->empresa ?? '---'),
                fpdf_utf8($e->tempo_servico ?? '---'),
                fpdf_utf8($e->saida ?? '---'),
            ];
            $this->Row($d, $fill);
            $fill = !$fill;
        }
    }

    private function dadosPostais()
    {
        $dados = $this->dados;

        $this->SetFont('Arial', 'B', 11);
        $this->Ln(4);
        $this->Cell(0, 5, fpdf_utf8_uppercase("Dados Postais"), '', 1, 'L', 0);

        $this->Ln(1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, fpdf_utf8('Endereço'), 'LRT', 0, 'L', 0);
        $this->Cell(10, 5, fpdf_utf8('Nº'), 'LRT', 0, 'L', 0);
        $this->Cell(55, 5, fpdf_utf8('Ponto de Referência'), 'LRT', 0, 'L', 0);
        $this->Cell(55, 5, fpdf_utf8('Complemento'), 'LRT', 1, 'L', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(70, 5, fpdf_utf8($dados->endereco ?? '---'), 'LBR', 0, 'L', 0);
        $this->Cell(10, 5, fpdf_utf8($dados->endereco_numero ?? 'S/N'), 'BR', 0, 'L', 0);
        $this->Cell(55, 5, fpdf_utf8($dados->ponto_referencia ?? '---'), 'BR', 0, 'L', 0);
        $this->Cell(55, 5, fpdf_utf8($dados->complemento ?? '---'), 'BR', 1, 'L', 0);
    }

    private function outrasInformacoes()
    {
        $dados = $this->dados;

        $this->SetFont('Arial', 'B', 11);
        $this->Ln(4);
        $this->Cell(0, 5, fpdf_utf8_uppercase("Outras Informações"), '', 1, 'L', 0);

        $this->Ln(1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, fpdf_utf8('Outras Informações'), 'LRT', 1, 'L', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->MultiCell(0, 5, fpdf_utf8($dados->outras_informacoes ?? '---'), 'LRB', 'L', 0);
    }
}
