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

    <H4 class="text-center text-secondary">LISTA DE ASISTENTES</H4>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_asistente.php";
    include "../controlador/controlador_eliminar_asistente.php";
    
    
    $sql= $conexion->query(" SELECT 
    asistente.id_asistente,
    asistente.nom_asistente,
    asistente.apellido, 
    asistente.num_control, 
    cargo.nom_cargo,
    carrera.nom_carrera
    FROM 
    asistente
    LEFT JOIN cargo on asistente.cargo=cargo.id_cargo
    LEFT JOIN carrera on asistente.carrera=carrera.id_carrera");
    ?>
    <a href="registro_asistente.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i> &nbsp; Registrar</a>
    <table class="table-bordered table-hover col-11" id="example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">APELLIDO</th>
      <th scope="col">NUM_CONTROL</th>
      <th scope="col">CARRERA</th>
      <th scope="col">CARGO</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($datos=$sql->fetch_object()){?>
        <tr>
            <td><?= $datos->id_asistente ?></td>
            <td><?= $datos->nom_asistente ?></td>
            <td><?= $datos->apellido ?></td>
            <td><?= $datos->num_control ?></td>
            <td><?= $datos->nom_carrera ?></td>
            <td><?= $datos->nom_cargo ?></td>
            <td>
              <a href="" data-toggle="modal" data-target="#exampleModal<?=$datos->id_asistente ?>" class="btn btn-warning btn-sn"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="asistente.php?id=<?=$datos->id_asistente?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>

        <!-- Button trigger modal -->
  

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?=$datos->id_asistente ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Asistente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-11 ">
                    <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?=$datos->id_asistente ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12 ">
                    <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?=$datos->nom_asistente ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12 ">
                    <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?=$datos->apellido ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12 ">
                    <input type="text" placeholder="Num. Control" class="input input__text" name="txtnum_con" value="<?=$datos->num_control ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12 ">
                    <select name="txtcarrera" class="input input__select">
                      
                      <?php
                      $sql2=$conexion->query(" select * from carrera");
                      while ($datos2=$sql2->fetch_object()) {?>
                        <option <?= $datos->carrera==$datos2->id_carrera ? 'selected' : '' ?> value="<?= $datos2->id_carrera ?>"><?= $datos2->nom_carrera ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12 ">
                  <select name="txtcargo" class="input input__select">
                      
                      <?php
                      $sql2=$conexion->query(" select * from cargo");
                      while ($datos2=$sql2->fetch_object()) {?>
                        <option <?= $datos->cargo==$datos2->id_cargo ? 'selected' : '' ?> value="<?= $datos2->id_cargo ?>"><?= $datos2->nom_cargo ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>
                
                  <div class="text-right p-2">
                    <a href="asistente.php" class="btn btn-secondary btn-rounded">Atras</a>
                    <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
    <?php }
    ?>
    
  </tbody>
</table>
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>