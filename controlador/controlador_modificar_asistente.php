<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtnum_con"]) and !empty($_POST["txtcarrera"]) and !empty($_POST["txtcargo"])) {
        $id=$_POST["txtid"];
        $nombre=$_POST["txtnombre"];
        $apellido=$_POST["txtapellido"];
        $num_con=$_POST["txtnum_con"];
        $carrera=$_POST["txtcarrera"];
        $cargo=$_POST["txtcargo"];
        $sql=$conexion->query(" update asistente set nom_asistente='$nombre', apellido='$apellido', num_control='$num_con', cargo=$cargo, carrera=$carrera where id_asistente=$id ");
        if ($sql == true) {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El asistente se ha modificado correctamente",
                        styling: "bootstrap3"
                    })
                })
            </script>
            

        <?php } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar asistente",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
        
    } else {?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Los campos estan vacios",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php }?>
        
    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script> 
<?php }
?>