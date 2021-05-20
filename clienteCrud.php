<?php

class Cliente{
		
	public function addCliente($data){
		try{
			$documento = $data['documento'];
			$tipo_doc = $data['tipo_doc'];
			$nombres = $data['nombres'];
            $apellidos = $data['apellidos'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "INSERT INTO cliente (DOCUMENTO, TIPO_DOC, NOMBRES, APELLIDOS) VALUES (:documento,:tipo_doc,:nombres,:apellidos)";
			$statement = $db->prepare($query);
			$statement->bindParam(":documento", $documento);
			$statement->bindParam(":tipo_doc", $tipo_doc);
			$statement->bindParam(":nombres", $nombres);
            $statement->bindParam(":apellidos", $apellidos);
			$result = $statement->execute();
			if($result){
			 return "successfully";
			}
			return "error";

			} catch (PDOException $e) {
				echo "¡Error!: " . $e->getMessage() . "<br/>";
				return "error";
	    }
	}
	
	public function deleteCliente($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM cliente WHERE ID_CLIENTE=:id";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id);
			$result = $statement->execute();
			if($result){
				return "removed";
			}
			return "error!";      

			} catch (PDOException $e) {
			  echo "¡Error!: " . $e->getMessage() . "<br/>";
	    }
	  
	}
	
	public function updateCliente($data){
		try{
			$id = $data['id'];
			$documento = $data['documento'];
			$tipo_doc = $data['tipo_doc'];
			$nombres = $data['nombres'];
            $apellidos = $data['apellidos'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query="UPDATE cliente SET DOCUMENTO=:d,TIPO_DOC=:t,NOMBRES=:n,APELLIDOS=:a
					WHERE ID_CLIENTE=:id";
			$statement= $db->prepare($query);
			$statement->bindParam(":d", $documento);
			$statement->bindParam(":t", $tipo_doc);
			$statement->bindParam(":n", $nombres);
            $statement->bindParam(":a", $apellidos);
			$statement->bindParam(":id", $id); 
			$result = $statement->execute();
			if($result){ 
				return "updated"; 
			} 
			 return "error!";

		} catch(PDOException $e){
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}

	
	public function getCliente($data){
		try{
			$id = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM cliente WHERE ID_CLIENTE=:id";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_CLIENTE'],
				  "documento" => $res['DOCUMENTO'],
				  "tipo_doc" => $res['TIPO_DOC'],
                  "nombres" => $res['NOMBRES'],
				  "apellidos" => $res['APELLIDOS'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}

	public function getClienteDoc($data){
		try{
			$doc = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM cliente WHERE DOCUMENTO=:doc";
			$statement = $db->prepare($query);
			$statement->bindParam(':doc', $doc); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_CLIENTE'],
				  "documento" => $res['DOCUMENTO'],
				  "tipo_doc" => $res['TIPO_DOC'],
                  "nombres" => $res['NOMBRES'],
				  "apellidos" => $res['APELLIDOS'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}
  
	public function getClientes(){
        try{
             $list = array();
             $conexion = new Conexion();
             $db = $conexion->getConexion();
             $query = "SELECT * FROM cliente ORDER BY ID_CLIENTE";
             $statement = $db->prepare($query);
             $statement->execute();
             while($row = $statement->fetch()) {
                 $list[] = array(
                    "id" => $row['ID_CLIENTE'],
                    "documento" => $row['DOCUMENTO'],
                    "tipo_doc" => $row['TIPO_DOC'],
                    "nombres" => $row['NOMBRES'],
                    "apellidos" => $row['APELLIDOS'] );
             }//fin del ciclo while 
     
             return $list;
     
        }catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
?>