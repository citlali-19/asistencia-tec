<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre=$_POST["txtnombre"];
        $id=$_POST["txtid"];
        $verificarNombre=$conexion->query( "select count(*) as 'total' from actividad where nom_actividad='$nombre' and id_actividad!=$id ");
        if ($verificarNombre->fetch_object()->total > 0) {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La actividad <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $sql=$conexion->query(" update actividad set nom_actividad='$nombre' where id_actividad=$id");
            if ($sql==true) {?>
                <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "La actividad se ha modificado correctamente",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <?php }else {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar actividad",
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