<?php
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }

?>

<style>
  ul li:nth-child(3) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <H4 class="text-center text-secondary">REGISTRO DE ASISTENTES</H4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_asistente.php";   
    ?>
    
    <div class="row">
      <form action="" method="POST">
        <div class="fl-flex-label mb-4 px-2 col-12 ">
          <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 ">
          <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 ">
          <input type="text" placeholder="Num. Control" class="input input__text" name="txtnum_con">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 ">
          <select name="txtcarrera" class="input input__">
            <option value="">Seleccionar Carrera...</option>
            <?php
            $sql=$conexion->query("select * from carrera");
            while($datos=$sql->fetch_object()){?>
            <option value="<?=$datos->id_carrera?>"><?=$datos->nom_carrera?></option>
            <?php }
            ?>
          </select>
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12  ">
          <select name="txtcargo" class="input input__">
            <option value="">Seleccionar Cargo...</option>
            <?php
            $sql=$conexion->query("select * from cargo");
            while($datos=$sql->fetch_object()){?>
            <option value="<?=$datos->id_cargo?>"><?=$datos->nom_cargo?></option>
            <?php }
            ?>
          </select>
        </div>
        <div class="text-right p-2">
          <a href="asistente.php" class="btn btn-secondary btn-rounded">Atras</a>
          <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
        </div>
      </form>

    </div>
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>