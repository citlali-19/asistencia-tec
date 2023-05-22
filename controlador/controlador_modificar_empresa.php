<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"])) {
        $id=$_POST["txtid"];
        $nombre=$_POST["txtnombre"];
        $telefono=$_POST["txttelefono"];
        $ubicacion=$_POST["txtubicacion"];
        $rfc=$_POST["txtrfc"];
        $sql=$conexion->query("update empresa set nombre='$nombre', telefono='$telefono', ubicacion='$ubicacion', rfc='$rfc' where id_empresa=$id");
        if ($sql==true) {?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Los datos se han modificado correctamente",
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
                        text: "Error al modificar datos",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
        
    } else {?>
        <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "No se ha enviado el Identificador",
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