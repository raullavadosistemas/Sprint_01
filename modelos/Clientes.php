<?php

//conexion a la base de datos

require_once("../config/conexion.php");
class Cliente extends Conectar{

     //método para seleccionar registros
    public function get_clientes(){

    $conectar=parent::conexion();

    $sql="select * from clientes";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

   	     //método para insertar registros

    }

    public function registrar_cliente($dni,$nombre,$apellido,$telefono,$correo,$direccion,$estado,$id_usuario){

        $conectar=parent::conexion();

        $sql="insert into clientes
        values(null,?,?,?,?,?,?,now(),?,?);";

        $sql=$conectar->prepare($sql);


            $sql->bindValue(1, $_POST["dni"]);
            $sql->bindValue(2, $_POST["nombre"]);
            $sql->bindValue(3, $_POST["apellido"]);
            $sql->bindValue(4, $_POST["telefono"]);
            $sql->bindValue(5, $_POST["email"]);
            $sql->bindValue(6, $_POST["direccion"]);
            $sql->bindValue(7, $_POST["estado"]);
            $sql->bindValue(8, $_POST["id_usuario"]);
            $sql->execute();

    } 

    //metodo para mostrar los datos de un registro a modificar
    public function get_cliente_por_dni($dni){

    $conectar=parent::conexion();

    $sql="select * from clientes where dni_cliente=?";
     
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();

    }

    public function get_cliente_por_id($id_cliente){

        $conectar= parent::conexion();

        $sql="select * from clientes where id_cliente=?";

        $sql->$conectar->prepare($sql);
        $sql->bindValue(1, $id_cliente);
        $sql-> execute();

    }
  //método para editar un registro
  public function editar_cliente($dni,$nombre,$apellido,$telefono,$correo,$direccion,$estado,$id_usuario){
      $conectar=parent::conexion();

      $sql="update clientes set

             dni_cliente=?,
             nombre_cliente=?,
             apellido_cliente=?,
             telefono_cliente=?,
             correo_cliente=?,
             direccion_cliente=?,
             estado=?,
             id_usuario=?
             where 
             cedula_cliente=?

        	";
      
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["dni"]);
            $sql->bindValue(2, $_POST["nombre"]);
            $sql->bindValue(3, $_POST["apellido"]);
            $sql->bindValue(4, $_POST["telefono"]);
            $sql->bindValue(5, $_POST["email"]);
            $sql->bindValue(6, $_POST["direccion"]);
            $sql->bindValue(7, $_POST["estado"]);
            $sql->bindValue(8, $_POST["id_usuario"]);
            $sql->bindValue(9, $_POST["dni_cliente"]);
            $sql->execute();

    }

        /*metodo que valida si hay registros activos*/

        public function get_cliente_por_id_estado($id_cliente,$estado){

            $conectar= parent::conexion();
   
            //declaramos que el estado esté activo, igual a 1
   
            $estado=1;
   
             
           $sql="select * from clientes where id_cliente=? and estado=?";
   
                 $sql=$conectar->prepare($sql);
   
                 $sql->bindValue(1, $id_cliente);
                  $sql->bindValue(2, $estado);
                 $sql->execute();
   
                 return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
   
   
            }
   
   
             //método para activar Y/0 desactivar el estado del cliente
   
           public function editar_estado($id_cliente,$estado){
   
                $conectar=parent::conexion();
   
                //si el estado es igual a 0 entonces el estado cambia a 1
                //el parametro est se envia por via ajax
                if($_POST["est"]=="0"){
   
                  $estado=1;
   
                } else {
   
                     $estado=0;
                }
   
                $sql="update clientes set 
                 
                 estado=?
                 where 
                 id_cliente=?
   
                ";
   
                $sql=$conectar->prepare($sql);
   
                $sql->bindValue(1,$estado);
                $sql->bindValue(2,$id_cliente);
                $sql->execute();
           }
   
            //método si el cliente existe en la base de datos
           //valida si existe la cedula, cliente o correo, si existe entonces se hace el registro del cliente
           public function get_datos_cliente($dni,$cliente,$correo){
   
              $conectar=parent::conexion();
   
              $sql= "select * from clientes where dni_cliente=? or nombre_cliente=? or correo_cliente=?";
   
               $sql=$conectar->prepare($sql);
   
               $sql->bindValue(1, $dni);
               $sql->bindValue(2, $cliente);
               $sql->bindValue(3, $correo);
               $sql->execute();
   
              //print_r($email); exit();
   
              return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
           }
   
   
     }

?>