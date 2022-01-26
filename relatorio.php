<?php 
	require_once 'fpdf/fpdf.php';
	require_once 'core/init.php';

    class myPDF extends FPDF{
        function header(){
            
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'RELATORIO DE PUBLICACOES',0,0,'C');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276,10,'Up-vitrine || relatorio',0,0,'C');
            $this->Ln(20);
        }

        
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }

        function headerTable(){
            $this->SetFont('Times','B',12);
            $this->cell(20,10,'ID',1,0,'C');
            $this->cell(40,10,'DATA',1,0,'C');
            $this->cell(40,10,'HORA',1,0,'C');
            $this->cell(60,10,'VITRINE',1,0,'C');
            $this->cell(45,10,'TITULO',1,0,'C');
            $this->cell(70,10,'BREVE DESCRICAO',1,0,'C');
            $this->Ln();
        }

        function viewTable(){
             $this->SetFont('Times','',12);
            $publicacao = new Publicacao();
            $arquivos = $publicacao->getPublicacaoArquivo();
            foreach($arquivos->results() as $key => $arquivo ) {

                $dataHora=explode(' ', $arquivo->data);

                $this->cell(20,10,++$key,1,0,'L');
                $this->cell(40,10,$dataHora[0],1,0,'L');
                $this->cell(40,10,$dataHora[1],1,0,'L');
                $this->cell(60,10,$arquivo->id_faculdade,1,0,'L');
                $this->cell(45,10,$arquivo->titulo,1,0,'L');
                $this->cell(70,10,substr($arquivo->assunto,0,30).'...',1,0,'C');
                $this->Ln();
        }

    }
}


$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();



	