<?php
require('fpdf17/fpdf.php'); // file fpdf.php harus diincludekan
require('koneksi.php');
class PDF extends FPDF
{
function Header()
{
// setting properti font
$this->SetFont('Arial','I',10);
// menulis header
$this->Image('images/logosbp.png',70,5);


$this->SetFont('Arial','',14);
$this->Text(70,28,'BERITA ACARA OPERASIONAL');
$this->Line(10,68,60,68);
}



}
$noba=$_POST['noba'];
$namapers=$_POST['namapers'];
$alamat=$_POST['alamat'];
$waktu=date('d F Y');
$pdf=new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Text(10,44, 'No BA      :  '.$noba.'');
$pdf->Text(10,50, 'Date  :  '.$waktu.'');
$pdf->Text(10,56, 'Page  :  1');
$pdf->Text(10,66, 'Internet Services');
$pdf->Text(11,212, 'Keterangan : ');
$pdf->Text(14,222, '- Harga Belum Termasuk PPN (10%)');
$pdf->Text(14,229, '- Melampirkan Fotocopy KTP');
$pdf->Text(14,236, '- Pembayaran Registrasi dan biaya bulanan dilakukan pada saat pendaftaran');
$pdf->Text(14,243, '- Minimum jangka Waktu berlangganan adalah tiga (3) bulan');
$pdf->Output();

?>
