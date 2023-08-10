<?php

require_once "modelos/formularios.modelo.php";
    
class ControladorFormularios{

    static public function ctrRegistro(){
        if(isset($_POST["regnombre"])){
            $tabla = "registros";
            $datos = array(
                "nombre" => $_POST["regnombre"],
                "email" => $_POST["regemail"],
                "password" => $_POST["regpassword"]
            );
            $respuesta = ModeloFormularios::mdlRegistro($tabla,$datos);
            return $respuesta;
        }
    }
    static public function ctrSeleccionarRegistros($item, $valor){
        $tabla = "registros";
        $respuesta = ModeloFormularios::mdlSeleccionarRegistro($tabla,$item,$valor);
        return $respuesta;
    }

    public function ctrIngreso(){
        if(isset($_POST["ingresoEmail"])){
            $tabla = "registros";
            $item = "email";
            $valor = $_POST["ingresoEmail"];

            $respuesta = ModeloFormularios::mdlSeleccionarRegistro($tabla,$item,$valor);

            if($respuesta["regemail"] == $_POST["ingresoEmail"] && $respuesta["password"] == $_POST["ingresoPassword"]){
                $_SESSION["validarIngreso"] == "ok";
                echo '<script>
                
                    if (window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }

                    window.location = "index.php?ruta=inicio";
                </script>';   

            }else{
                echo '<script>
                
                    if (window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }

                </script>';   
                echo '<div class = alert alert-danger> Error al ingresar el email o contraseña incorrecta</div>';
            }
        }
    }
    
    static public function ctrActualizarRegistro(){
        if(isset($_POST["actualizarNombre"])){
            if($_POST["actualizarPassword"] != "") {
                $password =$_POST["actualizarPassword"];
            }else{
                $password = $_POST["passwordA   ctual"];
            }
                $tabla = "registros";
                $datos = array(
                    "id" => $_POST["idUsuario"],
                    "nombre" => $_POST["actualizarNombre"],
                    "email" => $_POST["actualizarEmail"],
                    "password" => $password
                );
                $respuesta = ModeloFormularios::mdlActualizarRegistros($tabla,$datos);
                if($respuesta == "ok"){
                    echo '<script>
                
                        if (window.history.replaceState){
                            window.history.replaceState(null,null,window.location.href);
                        }

                        window.location = "index.php?ruta=inicio";
                    </script>';   
                }
            
        }
        
    }
    static public function ctrEliminarRegistro(){
        if(isset($_POST["eliminarrNombre"])) {
            if($_POST["actualizarPassword"] != "") {

                $tabla = "registros";
                $valor = $_POST["eliminarRegistro"];

                $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);
                if($respuesta == "ok") {
                    echo '<script>
                        
                                if (window.history.replaceState){
                                    window.history.replaceState(null,null,window.location.href);
                                }

                                window.location = "index.php?ruta=inicio";
                            </script>';
                }
            }
        }
                
    }

}