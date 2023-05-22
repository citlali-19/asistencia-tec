<?php
if(!empty($_GET["id"])){
    $id=$_GET["id"];
    $sql=$conexion->query(" delete from asistente where id_asistente=$id");
    if ($sql==true) {?>
        <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El asistente se ha eliminado correctamente",
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
                        text: "Error al eliminar asistente",
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