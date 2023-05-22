<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre=$_POST["txtnombre"];
        $id=$_POST["txtid"];
        $verificarNombre=$conexion->query( "select count(*) as 'total' from cargo where nom_cargo='$nombre' and id_cargo!=$id ");
        if ($verificarNombre->fetch_object()->total > 0) {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El cargo <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $sql=$conexion->query(" update cargo set nom_cargo='$nombre' where id_cargo=$id");
            if ($sql==true) {?>
                <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El cargo se ha modificado correctamente",
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
                        text: "Error al modificar cargo",
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