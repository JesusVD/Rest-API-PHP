<?php	

    header("Content-Type: application/json");
    include_once("../clases/clase-usuario.php");
    switch ($_SERVER[ 'REQUEST_METHOD' ]) {
        case 'POST':
                $_POST = json_decode(file_get_contents('php://input'), true);
                $usuario = new Usuario($_POST["nombre"],$_POST["apellido"],$_POST["nacimiento"],$_POST["pais"]);
                $usuario->guardarUsuario();
                $resultado["mensaje"] = "Guardar usuario, informacion: ". json_encode($_POST);
                echo json_encode($resultado);
            break;

        case 'GET' :
                if (isset($_GET['id'])) {
                    Usuario::obtenerUsuarioById($_GET['id']);
                }else{
                    Usuario::obtenerUsuario();
                }
            break;

        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            $usuario = new Usuario($_PUT["nombre"],$_PUT["apellido"],$_PUT["nacimiento"],$_PUT["pais"]);
            $usuario->actualizarUsuario($_GET['id']);

            $resultado["mensaje"] = "Actualizar un usuario con el id: " . $_GET['id'] .
                                    ", Informacion a actualizar: " . json_encode($_PUT);
            echo json_encode($resultado);
            break;

        case 'DELETE':
            Usuario::eliminarUsuario($_GET['id']);
            $resultado["mensaje"] = "Eliminar un usuario con el id: ". $_GET['id'];
            echo json_encode($resultado);
            break;    
        
        default:
            # code...
            break;
    }
?>