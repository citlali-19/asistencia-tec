<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtnum_con"]) and !empty($_POST["txtcarrera"])and !empty($_POST["txtcargo"])) {
        $nombre=$_POST["txtnombre"];
        $apellido=$_POST["txtapellido"];
        $num_con=$_POST["txtnum_con"];
        $carrera=$_POST["txtcarrera"];
        $cargo=$_POST["txtcargo"];
        $sql=$conexion->query(" select count(*) as 'total' from asistente where num_control='$num_con' ");
        if ($sql->fetch_object()->total > 0) {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "Este asistente con Num. Control <?= $num_con ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $registro=$conexion->query(" insert into asistente(nom_asistente,apellido,num_control,cargo,carrera) values('$nombre','$apellido','$num_con','$cargo','$carrera')");
            if ($registro==true) {?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El asistente con Num. Control <?= $num_con ?> se ha registrado correctamente",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al registrar asistente",
                            styling: "bootstrap3"
                        })
                    })
                </script>
               
            <?php }
            
        }
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