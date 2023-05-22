<?php
if (!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query("delete from carrera where id_carrera=$id");
    if ($sql==true) {?>
    <script>
        $(function notificacion() {
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "Carrera eliminada correctamente",
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
                text: "Error al eliminar carrera",
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