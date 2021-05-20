<?php

class Ubicacion{
	
    
	
	public function addUbicacion($data){
		try{
			$id_cliente = $data['id_cliente'];
			$ciudad = $data['ciudad'];
			$latitud = $data['latitud'];
            $longitud = $data['longitud'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "INSERT INTO ubicacion (ID_CLIENTE, CIUDAD, LATITUD, LONGITUD) VALUES (:id_cliente,:ciudad,:latitud,:longitud)";
			$statement = $db->prepare($query);
			$statement->bindParam(":id_cliente", $id_cliente);
			$statement->bindParam(":ciudad", $ciudad);
			$statement->bindParam(":latitud", $latitud);
            $statement->bindParam(":longitud", $longitud);
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
	
	public function deleteUbicacion($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM ubicacion WHERE ID_CLIENTE=:id";
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
	
	public function updateUbicacion($data){
		try{
			$id_cliente = $data['id_cliente'];
			$ciudad = $data['ciudad'];
			$latitud = $data['latitud'];
            $longitud = $data['longitud'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query="UPDATE ubicacion SET CIUDAD=:c,LATITUD=:lat,LONGITUD=:lon
					WHERE ID_CLIENTE=:id";
			$statement= $db->prepare($query);
			$statement->bindParam(":c", $ciudad);
			$statement->bindParam(":lat", $latitud);
            $statement->bindParam(":lon", $longitud);
			$statement->bindParam(":id", $id_cliente);
			$result = $statement->execute();
			if($result){ 
				return "updated"; 
			} 
			 return "error!";

		} catch(PDOException $e){
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}

	
	public function getUbicacion($data){
		try{
			$id = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM ubicacion WHERE ID_CLIENTE=:id";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_UBICACION'],
				  "id_cliente" => $res['ID_CLIENTE'],
				  "ciudad" => $res['CIUDAD'],
                  "latitud" => $res['LATITUD'],
				  "longitud" => $res['LONGITUD'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}
  
	public function getUbicacions(){
        try{
             $list = array();
             $conexion = new Conexion();
             $db = $conexion->getConexion();
             $query = "SELECT * FROM ubicacion ORDER BY ID_UBICACION";
             $statement = $db->prepare($query);
             $statement->execute();
             while($row = $statement->fetch()) {
                 $list[] = array(
                    "id" => $row['ID_UBICACION'],
                    "id_cliente" => $row['ID_CLIENTE'],
                    "ciudad" => $row['CIUDAD'],
                    "latitud" => $row['LATITUD'],
                    "longitud" => $row['LONGITUD'] );
             }//fin del ciclo while 
     
             return $list;
     
        }catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
?>