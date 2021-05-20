<?php

class RegistroVenta{
	
    
	
	public function addRegistroVenta($data){
		try{
            $id_cliente = $data['id_cliente'];
			$valor_total_venta = $data['valor_total_venta'];
			$id_informe = $data['id_informe'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "INSERT INTO registro_venta (FECHA, ID_CLIENTE, VALOR_TOTAL_VENTA,ID_INFORME) VALUES (NOW(),:id_cliente,:valor_total_venta,:id_informe)";
			$statement = $db->prepare($query);
			$statement->bindParam(":id_cliente", $id_cliente);
			$statement->bindParam(":valor_total_venta", $valor_total_venta);
			$statement->bindParam(":id_informe", $id_informe);
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
	
	public function deleteRegistroVenta($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM registro_venta WHERE ID_REGISTRO=:id";
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
	
	public function updateRegistroVenta($data){
		try{
			$id = $data['id'];
			$fecha = $data['fecha'];
            $id_cliente = $data['id_cliente'];
			$id_informe = $data['id_informe'];
			$valor_total_venta = $data['valor_total_venta'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query="UPDATE registro_venta SET FECHA=:f,ID_CLIENTE=:ic,VALOR_TOTAL_VENTA=:vtv
					WHERE ID_REGISTRO=:id AND ID_INFORME=:idf" ;
			$statement= $db->prepare($query);
			$statement->bindParam(":f", $fecha);
			$statement->bindParam(":ic", $id_cliente);
			$statement->bindParam(":vtv", $valor_total_venta);
			$statement->bindParam(":id", $id); 
			$statement->bindParam(":idf", $id_informe); 
			$result = $statement->execute();
			if($result){ 
				return "updated"; 
			} 
			 return "error!";

		} catch(PDOException $e){
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}

	
	public function getRegistroVenta($data){
		try{
			$id = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM registro_venta WHERE ID_REGISTRO=:id";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_REGISTRO'],
                  "id_cliente" => $res['ID_CLIENTE'],
				  "id_informe" => $res['ID_INFORME'], 
				  "fecha" => $res['FECHA'],
				  "valor_total_venta" => $res['VALOR_TOTAL_VENTA']);
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}

	public function getRegistroFecha($data){
		try{
			$fecha = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM registro_venta WHERE DATE(FECHA)=:fecha ORDER BY ID_REGISTRO DESC";
			$statement = $db->prepare($query);
			$statement->bindParam(':fecha', $fecha); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_REGISTRO'],
                  "id_cliente" => $res['ID_CLIENTE'],
				  "id_informe" => $res['ID_INFORME'], 
				  "fecha" => $res['FECHA'],
				  "valor_total_venta" => $res['VALOR_TOTAL_VENTA'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}
  
	public function getRegistroVentas(){
        try{
             $list = array();
             $conexion = new Conexion();
             $db = $conexion->getConexion();
             $query = "SELECT * FROM registro_venta ORDER BY ID_REGISTRO";
             $statement = $db->prepare($query);
             $statement->execute();
             while($row = $statement->fetch()) {
                 $list[] = array(
                    "id" => $row['ID_REGISTRO'],
					"id_cliente" => $row['ID_CLIENTE'],
					"id_informe" => $row['ID_INFORME'], 
                    "fecha" => $row['FECHA'],
                    "valor_total_venta" => $row['VALOR_TOTAL_VENTA']);
             }//fin del ciclo while 
     
             return $list;
     
        }catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
    }

	public function getRegistrosInforme($data){
        try{
             $list = array();
			 $informe = $data;
             $conexion = new Conexion();
             $db = $conexion->getConexion();
             $query = "SELECT * FROM registro_venta WHERE ID_INFORME=:informe";
             $statement = $db->prepare($query);
			 $statement->bindParam(':informe', $informe); 
             $statement->execute();
             while($row = $statement->fetch()) {
                 $list[] = array(
                    "id" => $row['ID_REGISTRO'],
                    "id_cliente" => $row['ID_CLIENTE'],
					"id_informe" => $row['ID_INFORME'], 
					"fecha" => $row['FECHA'],
                    "valor_total_venta" => $row['VALOR_TOTAL_VENTA']);
             }//fin del ciclo while 
     
             return $list;
     
        }catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
?>