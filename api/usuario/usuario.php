<?php

//include_once '../../lib/session.php';
include_once '../lib/db.php';

class Usuario extends DB{

    function __construct(){
        parent::__construct();
    }


    public function getUser($id){
        $conn = $this->connect();
        $query = $conn->prepare(
            "SELECT * FROM CLIENTE where USUARIO_CLIENTE = :id"
        );
        $query->execute(['id' => $id]);

        $row = $query->fetch();

        if ($row) {
            return [
                'id' => $row['ID_CLIENTE'],
                'nombre' => $row['NOMBRE_CLIENTE'],
                'apellido' => $row['APELLIDO_CLIENTE'],
                'cedula' => $row['CEDULA_CLIENTE'],
                'correo' => $row['CORREO_CLIENTE'],
                'usuario' => $row['USUARIO_CLIENTE'],
                'contrasena' => $row['CONTRASENA_CLIENTE'],
                'rol' => $row['ROL']
            ];
        }
    }


    public function login($llave, $contrasena){

        /*try {
            $query_usuario = //"SELECT * FROM cliente where USUARIO_CLIENTE = '$key'";
            $this->connect()->prepare("SELECT * FROM CLIENTE where USUARIO_CLIENTE = :llave");
            $query_usuario->execute(['llave' => $llave]);
            return $query_usuario->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $eum = $e->getMessage()." - ".$e->getCode();
            return $eum;
        }*/

        $query_usuario = //"SELECT * FROM cliente where USUARIO_CLIENTE = '$key'";
        $this->connect()->prepare("SELECT * FROM CLIENTE where USUARIO_CLIENTE = :llave");
        $query_usuario->execute(['llave' => $llave]);
        

        $query_correo = //"SELECT * FROM cliente where CORREO_CLIENTE = '$contrasena'";
        $this->connect()->prepare('SELECT * FROM CLIENTE where CORREO_CLIENTE = :llave');
        $query_correo->execute(['llave' => $llave]);

        $row_usuario = $query_usuario->fetch();
        $row_correo = $query_correo->fetch();

        if ($row_correo) {
            if (password_verify($contrasena,$row_correo[6])) {
                //session_start();
                //return $_SESSION['usuario'] = $row;
                return [
                    'id' => $row_correo['ID_CLIENTE'],
                    'nombre' => $row_correo['NOMBRE_CLIENTE'],
                    'apellido' => $row_correo['APELLIDO_CLIENTE'],
                    'cedula' => $row_correo['CEDULA_CLIENTE'],
                    'correo' => $row_correo['CORREO_CLIENTE'],
                    'usuario' => $row_correo['USUARIO_CLIENTE'],
                    'contrasena' => $row_correo['CONTRASENA_CLIENTE'],
                    'rol' => $row_correo['ROL']
                ];
            }else{
                return null;
            }
        }else if ($row_usuario) {
            if (password_verify($contrasena,$row_usuario[6])) {
                //session_start();
                //return $_SESSION['usuario'] = $row;
                return [
                    'id' => $row_usuario['ID_CLIENTE'],
                    'nombre' => $row_usuario['NOMBRE_CLIENTE'],
                    'apellido' => $row_usuario['APELLIDO_CLIENTE'],
                    'cedula' => $row_usuario['CEDULA_CLIENTE'],
                    'correo' => $row_usuario['CORREO_CLIENTE'],
                    'usuario' => $row_usuario['USUARIO_CLIENTE'],
                    'contrasena' => $row_usuario['CONTRASENA_CLIENTE'],
                    'rol' => $row_usuario['ROL']
                ];
            }else{
                return null;
            }
        }else{
            return null;
        }

        /*if ($query_usuario) {

            $row = $query_usuario->fetch();


        }elseif ($query_correo) {

            $row = $query_correo->fetch();

        }

        if ($row) {
            if (password_verify($contrasena,$row[6])) {
                //session_start();
                //return $_SESSION['usuario'] = $row;
                return [
                    'id' => $row['ID_CLIENTE'],
                    'nombre' => $row['NOMBRE_CLIENTE'],
                    'apellido' => $row['APELLIDO_CLIENTE'],
                    'cedula' => $row['CEDULA_CLIENTE'],
                    'correo' => $row['CORREO_CLIENTE'],
                    'usuario' => $row['USUARIO_CLIENTE'],
                    'contrasena' => $row['CONTRASENA_CLIENTE'],
                    'rol' => $row['ROL']
                ];
            }else{
                return null;
            }
        }else{
            return null;
        }*/


        /*return [
            'id' => $row['ID_CLIENTE'],
            'nombre' => $row['NOMBRE_CLIENTE'],
            'apellido' => $row['APELLIDO_CLIENTE'],
            'cedula' => $row['CEDULA_CLIENTE'],
            'correo' => $row['CORREO_CLIENTE'],
            'usuario' => $row['USUARIO_CLIENTE'],
            'contrasena' => $row['CONTRASENA_CLIENTE'],
            'rol' => $row['ROL']
        ];*/


    }

    public function register($nombre, $apellido, $cedula, $correo, $usuario, $contrasena){
        
        $hash = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 10]);

        try {
            //code...
        } catch (PDOException $e) {
            //throw $th;
        }

        $conn = $this->connect();
        
        /*INSERT INTO `cliente` (`ID_CLIENTE`, `NOMBRE_CLIENTE`, `APELLIDO_CLIENTE`, `CEDULA_CLIENTE`, `CORREO_CLIENTE`, `USUARIO_CLIENTE`, `CONTRASENA_CLIENTE`, `ROL`) 
        VALUES (NULL, 'JUAN', 'FERRIN', '9874563210', 'juansape@gmail.com', 'juansape', '$2y$10$s/55X3OZeokw6MsMbhFH5uWJHYQDFNGq1FPImA0ri4oBvoYjwLGVC', 'CLIENTE');*/

        $query = $conn->prepare(
            "INSERT INTO `CLIENTE`(`ID_CLIENTE`, `NOMBRE_CLIENTE`, `APELLIDO_CLIENTE`, `CEDULA_CLIENTE`, `CORREO_CLIENTE`, `USUARIO_CLIENTE`, `CONTRASENA_CLIENTE`, `ROL`) VALUES (NULL, '". $nombre ."', '" . $apellido . "', '". $cedula . "', '" . $correo . "', '" . $usuario . "', '" . $hash . "', 'CLIENTE')"

        );

        
        $query->execute();

        
        $id_cliente = $conn->lastInsertId();

        if ($id_cliente == 0) {
            return null;
        }else{
            $query2 = $this->connect()->prepare(
                'SELECT * FROM CLIENTE where ID_CLIENTE = :id'
            );

            $query2->execute(['id' => $id_cliente]);

            $row = $query2->fetch();

            if ($row) {
                return [
                    'id' => $row['ID_CLIENTE'],
                    'nombre' => $row['NOMBRE_CLIENTE'],
                    'apellido' => $row['APELLIDO_CLIENTE'],
                    'cedula' => $row['CEDULA_CLIENTE'],
                    'correo' => $row['CORREO_CLIENTE'],
                    'usuario' => $row['USUARIO_CLIENTE'],
                    'contrasena' => $row['CONTRASENA_CLIENTE'],
                    'rol' => $row['ROL']
                ];
            }else{
                return null;
            }
        }

        

        /*if ($query) {
            
            $query2 = $this->connect()->prepare(
                'SELECT * FROM CLIENTE where ID_CLIENTE = :id'
            );

            $query2->execute(['id' => $id_cliente]);

            $row = $query2->fetch();

            if ($row) {
                return [
                    'id' => $row['ID_CLIENTE'],
                    'nombre' => $row['NOMBRE_CLIENTE'],
                    'apellido' => $row['APELLIDO_CLIENTE'],
                    'cedula' => $row['CEDULA_CLIENTE'],
                    'correo' => $row['CORREO_CLIENTE'],
                    'usuario' => $row['USUARIO_CLIENTE'],
                    'contrasena' => $row['CONTRASENA_CLIENTE'],
                    'rol' => $row['ROL']
                ];
            }else{
                return null;
            }

        }else{
            return null;
        }*/

        


    }

}

?>