<?php
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }

?>

<style>
  ul li:nth-child(1) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <H4 class="text-center text-secondary">LISTA DE ASISTENCIA</H4>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_eliminar_asistencia.php";
    
    $sql= $conexion->query(" SELECT 
    asistencia.id_asistencia, 
    asistencia.id_asistente, 
    asistencia.entrada,
    asistente.apellido, 
    asistente.num_control, 
    cargo.nom_cargo,
    actividad.nom_actividad 
    FROM 
    asistencia 
    LEFT JOIN asistente ON asistencia.id_asistente=asistente.id_asistente 
    LEFT JOIN actividad ON asistencia.actividad=actividad.id_actividad 
    LEFT JOIN cargo on asistente.cargo=cargo.id_cargo ");
    ?>
    <div class="text-right mb-2">
      <a href="fpdf/ReporteAsistencia.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i>Generar reportes</a>
    </div>
    <div class="text-right mb-2">
      <a href="reporte_asistencia.php"  class="btn btn-primary"><i class="fas fa-plus"></i> Màs reportes</a>
    </div>
    <table class="table-bordered table-hover col-11" id="example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ASISTENTE</th>
      <th scope="col">NUM CONTROL</th>
      <th scope="col">CARGO</th>
      <th scope="col">ACTIVIDAD</th>
      <th scope="col">ENTRADA</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($datos=$sql->fetch_object()){?>
        <tr>
            <td><?= $datos->id_asistencia ?></td>
            <td><?= $datos->nom_asistente . " ".$datos->apellido ?></td>
            <td><?= $datos->num_control ?></td>
            <td><?= $datos->nom_cargo ?></td>
            <td><?= $datos->nom_actividad ?></td>
            <td><?= $datos->entrada ?></td>
            <td>
            <a href="inicio.php?id=<?=$datos->id_asistencia?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
    <?php }
    ?>
    
  </tbody>
</table>
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>