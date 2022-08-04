<?php

    class Usuario{
        private $nombre;
        private $apellido;
        private $nacimiento;
        private $pais;
      

        public function __construct($nombre, $apellido,$nacimiento,$pais){
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
            $this -> nacimiento = $nacimiento;
            $this -> pais = $pais;
        }


        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;
                return $this;
        }

        public function getApellido()
        {
                return $this->apellido;
        }

        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

                return $this;
        }

        public function getNacimiento()
        {
                return $this->nacimiento;
        }

        public function setNacimiento($nacimiento)
        {
                $this->nacimiento = $nacimiento;

                return $this;
        }

        public function getPais()
        {
                return $this->pais;
        }

        public function setPais($pais)
        {
                $this->pais = $pais;

                return $this;
        }

        public function __toString() {
            return $this->nombre ." ".$this->apellido." ".$this->nacimiento." ".$this->pais;
        }

        public function guardarUsuario(){
               $contenidoArchivo = file_get_contents("../data/usuarios.json");
               $usuarios = json_decode($contenidoArchivo, true);
               $usuarios[] = array(
                        "nombre"=> $this->nombre,
                        "apellido"=> $this->apellido,
                        "nacimiento"=> $this->nacimiento,
                        "pais"=> $this->pais
               );
               $archivo = fopen("../data/usuarios.json","w");
               fwrite($archivo, json_encode($usuarios));
               fclose($archivo);
        }

        public static function obtenerUsuario(){ //acceder sin crear instancia
                $contenidoArchivo = file_get_contents("../data/usuarios.json");
                echo $contenidoArchivo;
        }

        public static function obtenerUsuarioById($id){
                $contenidoArchivo = file_get_contents("../data/usuarios.json");
                $usuarios = json_decode($contenidoArchivo,true);
                echo json_encode($usuarios[$id]); 
        }

        public function actualizarUsuario($id){
                $contenidoArchivo = file_get_contents("../data/usuarios.json");
                $usuarios = json_decode($contenidoArchivo,true);
                
                $user = array(
                        "nombre"=> $this->nombre,
                        "apellido"=> $this->apellido,
                        "nacimiento"=> $this->nacimiento,
                        "pais"=> $this->pais
                );
                $usuarios[$id] = $user;
                $archivo = fopen("../data/usuarios.json",'w');
                fwrite($archivo, json_encode($usuarios));
                fclose($archivo);
        }

        public static function eliminarUsuario($id){
                $contenidoArchivo = file_get_contents("../data/usuarios.json");
                $usuarios = json_decode($contenidoArchivo,true);
                array_splice($usuarios, $id , 1);
                $archivo = fopen("../data/usuarios.json",'w');
                fwrite($archivo, json_encode($usuarios));
                fclose($archivo);
        }
    }
?>