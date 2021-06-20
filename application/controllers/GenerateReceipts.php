<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateReceipts extends CI_Controller {

	public function get_pdf_for_transaction($transaction_id, $security_token)
	{
		require __DIR__.'/../../assets/fpdf.php';

		$this->load->model('Model_giving_back');
		$transaction = $this->Model_giving_back->get_transaction($transaction_id, $security_token);
		if (!$transaction) {
			echo "You have entered an invalid URL. Please check the link again before trying!";
			return;
		}
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->Ln(7);

		// Heading
		$pdf->SetFont('Arial','B',16);
		$pdf->Image(__DIR__.'/../../assets/img/logo.png',40,17,20);
		$pdf->Cell(55);
		$pdf->Cell(40,12,'Alumni Association GEC-NIT Raipur');
		$pdf->Ln();
		$pdf->Cell(55);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(0,2,'National Institute of Technology, Raipur, CG, India');
		// Rule
			$pdf->Line(10, 41, 200, 41);
			
		// Main Content
			// Main heading
			$pdf->Ln(7);
			$pdf->SetFont('Arial','',14);
			$pdf->Cell(70);
			$pdf->Cell(40,20,'Transaction Receipt');
			// Main heading Ends
			// Rule
			$pdf->Line(10, 51, 200, 51);
			
			// Main Body
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Trasaction ID',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->transaction_id);

			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Name',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->customer_name);
			
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Email',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->email);
			
			// $pdf->Ln();
			// $pdf->SetFont('Arial','',10);
			// $pdf->Cell(60);
			// $pdf->Cell(30,7,'Mobile',0,0,'R');
			// $pdf->Cell(5);
			// $pdf->Cell(30,7,$transaction->mobile);
			
			// $pdf->Ln();
			// $pdf->SetFont('Arial','',10);
			// $pdf->Cell(60);
			// $pdf->Cell(30,7,'Whatsapp No',0,0,'R');
			// $pdf->Cell(5);
			// $pdf->Cell(30,7,$transaction->whatsapp_no);
			

			// $pdf->Ln();
			// $pdf->SetFont('Arial','',10);
			// $pdf->Cell(60);
			// $pdf->Cell(30,7,'Address',0,0,'R');
			// $pdf->Cell(5);
			// $pdf->Cell(30,7,$transaction->address);


			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Batch',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->passing_year);
			
			
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Branch',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->branch);

			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Degree',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->degree);
			
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Cause',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->cause);

			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Transaction Time',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->transaction_time);

			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Status',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,$transaction->txn_msg);

			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(60);
			$pdf->Cell(30,7,'Amount',0,0,'R');
			$pdf->Cell(5);
			$pdf->Cell(30,7,'Rs '.$transaction->amount.'/-');

			// $pdf->Ln();
			// $pdf->SetFont('Arial','',10);
			// $pdf->Cell(60);
			// $pdf->Cell(30,7,'Security Token',0,0,'R');
			// $pdf->Cell(5);
			// $pdf->Cell(30,7,$transaction->hash);
			// $pdf->Ln();
			
			// Main Body Ends
		// Rule
		$pdf->Line(10, 128, 200, 128);

		$pdf->Ln();
		$pdf->SetFont('Arial','BI',13);
		// $pdf->Cell(57);
		$pdf->Cell(190,15,'Thank you for your contribution to Alumni Association, GEC NIT Raipur',0,0,'C');


		$pdf->Output();

	}

}