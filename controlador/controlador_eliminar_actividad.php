<?php
if (!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query("delete from actividad where id_actividad=$id");
    if ($sql==true) {?>
    <script>
        $(function notificacion() {
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "Actividad eliminada correctamente",
                styling: "bootstrap3"
            })
        })
    </script>
<?php } else { ?>
    <script>
        $(function notificacion() {
            new PNotify({
                title: "INCORRECTO",
                type: "ERROR",
                text: "Error al eliminar actividad",
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