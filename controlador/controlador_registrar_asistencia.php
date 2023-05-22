<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtnum_con"]) and !empty($_POST["txtactividad"])) {
        $num_con=$_POST["txtnum_con"];
        $actividad=$_POST["txtactividad"];
        $consulta=$conexion->query("select count(*) as 'total' from asistente where num_control='$num_con' ");
        $id=$conexion->query("select id_asistente from asistente where num_control='$num_con' ");
        if ($consulta->fetch_object()->total > 0) {
            $fecha=date("Y-m-d h:i:s");
            $id_asistente=$id->fetch_object()->id_asistente;
            $consultaFecha=$conexion->query("select entrada from asistencia where id_asistente=$id_asistente order by id_asistencia desc limit 1");
            $fechaBD=$consultaFecha->fetch_object()->entrada;
            if (substr($fecha,0,10)==substr($fechaBD,0,10)) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Ya esta registrada tu asistencia",
                            styling: "bootstrap3"
                        })
                    })
                </script>
                <?php 
            }else{
                $sql=$conexion->query("insert into asistencia(id_asistente, actividad, entrada)values($id_asistente,$actividad, now() )");
                if ($sql==true) {?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO",
                                type: "success",
                                text: "Hola, BIENVENIDO",
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
                                text: "Error al registrar asistencia",
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
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error el Num. Control no existe",
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