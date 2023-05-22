<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre=$_POST["txtnombre"];
        $verificarNombre=$conexion->query(" select count(*) as 'total' from actividad where nom_actividad='$nombre'");
        if ($verificarNombre->fetch_object()->total >0) {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El actividad <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $sql=$conexion->query("insert into actividad(nom_actividad)values('$nombre')");
            if ($sql==true) {?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "La actividad se ha registrado correctamente",
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
                            text: "Error al registrar",
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