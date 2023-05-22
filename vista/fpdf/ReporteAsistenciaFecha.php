<?php
if (!empty($_GET["txtfechainicio"]) and !empty($_GET["txtfechafinal"]) and !empty($_GET["txtasistente"])) {
   require('./fpdf.php');
   $fechaInicio=$_GET["txtfechainicio"];
   $fechaFinal=$_GET["txtfechafinal"];
   $asistente=$_GET["txtasistente"];

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php';//llamamos a la conexion BD

      $consulta_info = $conexion->query(" select *from  empresa");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('logo.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode($dato_info->nombre), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : ". $dato_info->ubicacion), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : ". $dato_info->telefono), 0, 0, '', 0);
      $this->Ln(5);

      /* RFC */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("RFC: ". $dato_info->rfc), 0, 0, '', 0);
      $this->Ln(10);



      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS Y ACTIVIDADES POR FECHAS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(125, 173, 221); //colorFondo
      $this->SetTextColor(0, 0, 0); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('ASISTENTE'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('NUM. CONTROL'), 1, 0, 'C', 1);
      $this->Cell(29, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
      $this->Cell(24, 10, utf8_decode('ACTIVIDAD'), 1, 0, 'C', 1);
      $this->Cell(43, 10, utf8_decode('ENTRADA'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../../modelo/conexion.php';
/* CONSULTA INFORMACION DE LA EMPRESA */


$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde
if ($asistente == "todos") {
   $sql = $conexion->query("SELECT 
   asistencia.id_asistencia, 
   asistencia.id_asistente, 
   date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada', 
   asistente.nom_asistente,
   asistente.apellido, 
   asistente.num_control, 
   cargo.nom_cargo,
   actividad.nom_actividad 
   FROM 
   asistencia 
   INNER JOIN asistente ON asistencia.id_asistente=asistente.id_asistente 
   INNER JOIN actividad ON asistencia.actividad=actividad.id_actividad 
   INNER JOIN cargo on asistente.cargo=cargo.id_cargo 
   where entrada BETWEEN '$fechaInicio' and '$fechaFinal' order by id_asistente asc ");
} else {
   $sql=$conexion->query("SELECT 
   asistencia.id_asistencia, 
   asistencia.id_asistente, 
   date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada', 
   asistente.nom_asistente,
   asistente.apellido, 
   asistente.num_control, 
   cargo.nom_cargo,
   actividad.nom_actividad 
   FROM 
   asistencia 
   INNER JOIN asistente ON asistencia.id_asistente=asistente.id_asistente 
   INNER JOIN actividad ON asistencia.actividad=actividad.id_actividad 
   INNER JOIN cargo on asistente.cargo=cargo.id_cargo 
   where asistencia.actividad=$asistente and entrada BETWEEN '$fechaInicio' and '$fechaFinal' order by id_asistencia asc");
}



while ($datos_reporte = $sql->fetch_object()) {      
   $i = $i + 1;
   /* TABLA */
   $pdf->Cell(10, 10, utf8_decode("$i"), 1, 0, 'C', 0);
   $pdf->Cell(60, 10, utf8_decode($datos_reporte->nom_asistente ." ".$datos_reporte->apellido), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->num_control), 1, 0, 'C', 0);
   $pdf->Cell(29, 10, utf8_decode($datos_reporte->nom_cargo), 1, 0, 'C', 0);
   $pdf->Cell(24, 10, utf8_decode($datos_reporte->nom_actividad), 1, 0, 'C', 0);
   $pdf->Cell(43, 10, utf8_decode($datos_reporte->entrada), 1, 1, 'C', 0);
}



$pdf->Output('Reporte de asistencia por fecha.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)

}

