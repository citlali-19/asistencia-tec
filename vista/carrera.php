<?php
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }

?>

<style>
  ul li:nth-child(5) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <H4 class="text-center text-secondary">LISTA DE CARRERAS</H4>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_carrera.php";
    include "../controlador/controlador_eliminar_carrera.php";
    
    $sql= $conexion->query(" SELECT * from carrera");
    ?>
    <a href="registro_carrera.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i> &nbsp; Registrar</a>
    <table class="table-bordered table-hover col-11" id="example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">CARRERA</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($datos=$sql->fetch_object()){?>
        <tr>
            <td><?= $datos->id_carrera ?></td>
            <td><?= $datos->nom_carrera ?></td>
            <td>
              <a href="" data-toggle="modal" data-target="#exampleModal<?=$datos->id_carrera ?>" class="btn btn-warning btn-sn"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="carrera.php?id=<?=$datos->id_carrera?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>

        <!-- Button trigger modal -->
  

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?=$datos->id_carrera ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-12 ">
                    <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?=$datos->id_carrera ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12 ">
                    <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?=$datos->nom_carrera ?>">
                  </div>
                
                  <div class="text-right p-2">
                    <a href="carrera.php" class="btn btn-secondary btn-rounded">Atras</a>
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