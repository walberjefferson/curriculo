<?php

namespace App\PDF;

use App\Models\Configuracao;
use Codedge\Fpdf\Fpdf\Fpdf;

abstract class AbstractPdf extends Fpdf
{
    protected $widths;
    protected $aligns;

    protected $fileName;
    protected $destino;

    protected $titulo;
    protected $subTitulo;
    protected $logo;
    protected $total;


    public function __construct($orientation = 'L', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
//        $this->titulo = (!empty($configuracao)) ? $configuracao->titulo : '';
//        $this->logo = (!empty($configuracao)) ? public_path('storage/configuracao/' . $configuracao->brasao) : '';
        $this->destino = 'I';
        $this->fileName = 'doc.pdf';
    }

    abstract public function setTitulo($titulo);

    abstract public function setSubTitulo($subTitulo);

    abstract public function setLogo($logo);

    abstract public function setTotal($total);

    public function Header()
    {
        if (is_file($this->logo)) :
            $this->Image($this->logo, 10, 10, 20, 13);
            $this->SetFont('Arial', 'B', 12);
            $this->SetDrawColor(200, 200, 200);
            $this->SetY(10);
            $this->Cell(21, 6, '', 0, 0);
            $this->Cell(0, 6, utf8_decode($this->titulo), '0', 1);
            $this->Cell(21, 8, '', 'B', 0);
            $this->Cell(0, 8, utf8_decode($this->subTitulo), 'B', 1);
        else:
            $this->SetFont('Arial', 'B', 12);
            $this->SetDrawColor(200, 200, 200);
            $this->SetY(10);
            $this->Cell(0, 6, utf8_decode($this->titulo), '0', 1);
            $this->Cell(0, 8, utf8_decode($this->subTitulo), 'B', 1);
        endif;
        $this->Ln(5);

    }

    public function Footer()
    {
        $this->AliasNbPages();
        $this->SetY(-15);
        $this->SetDrawColor(200, 200, 200);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(92, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 'T', 0, 'L');
        $this->Cell(93, 10, utf8_decode('Total de Registos: ') . $this->total, 'T', 0, 'C');
        $this->Cell(92, 10, utf8_decode('Gerado em ') . utf8_decode(date('d/m/Y \à\s H:i:s')), 'T', 0, 'R');
    }

    public function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    public function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    public function Row($data, $fill = false, $altura = 5)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }
        $h = $altura * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, $altura, $data[$i], 1, $a, $fill);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    public function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }
    }

    public function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw =& $this->CurrentFont['cw'];
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }

    public function create()
    {

    }

    public function render()
    {
        $this->create();
        $this->Output($this->destino, $this->fileName);
        exit();
    }

}
