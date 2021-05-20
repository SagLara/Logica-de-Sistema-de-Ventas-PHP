<?php

class Informe{
	
    
	
	public function addInforme($data){
		try{
			$fecha = $data['fecha'];
			$cant_ventas = $data['cant_ventas'];
			$venta_mayor = $data['venta_mayor'];
            $venta_menor = $data['venta_menor'];
            $venta_promedio = $data['venta_promedio'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "INSERT INTO informe (FECHA, CANT_VENTAS, VENTA_MAYOR, VENTA_MENOR,VENTA_PROMEDIO)
                      VALUES (:fecha,:cant_ventas,:venta_mayor,:venta_menor,:venta_promedio)";
			$statement = $db->prepare($query);
			$statement->bindParam(":fecha", $fecha);
			$statement->bindParam(":cant_ventas", $cant_ventas);
			$statement->bindParam(":venta_mayor", $venta_mayor);
            $statement->bindParam(":venta_menor", $venta_menor);
            $statement->bindParam(":venta_promedio", $venta_promedio);
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
	
	public function deleteInforme($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM informe WHERE ID_INFORME=:id";
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
	
	public function updateInforme($data){
		try{
			$id = $data['id'];
			$fecha = $data['fecha'];
			$cant_ventas = $data['cant_ventas'];
			$venta_mayor = $data['venta_mayor'];
            $venta_menor = $data['venta_menor'];
            $venta_promedio = $data['venta_promedio'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query="UPDATE informe SET FECHA=:f,CANT_VENTAS=:cv,VENTA_MAYOR=:vmay,VENTA_MENOR=:vmen,VENTA_PROMEDIO=:vprom
					WHERE ID_INFORME=:id";
			$statement= $db->prepare($query);
			$statement->bindParam(":f", $fecha);
			$statement->bindParam(":cv", $cant_ventas);
			$statement->bindParam(":vmay", $venta_mayor);
            $statement->bindParam(":vmen", $venta_menor);
            $statement->bindParam(":vprom", $venta_promedio);
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

	
	public function getInforme($data){
		try{
			$id = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM informe WHERE ID_INFORME=:id";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_INFORME'],
				  "fecha" => $res['FECHA'],
				  "cant_ventas" => $res['CANT_VENTAS'],
                  "venta_mayor" => $res['VENTA_MAYOR'],
                  "venta_menor" => $res['VENTA_MENOR'],
				  "venta_promedio" => $res['VENTA_PROMEDIO'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            //echo "¡Error!: " . $e->getMessage() . "<br/>";
			return null;
        }
	}

	public function getInformeDay($data){
		try{
			$fecha = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM informe WHERE FECHA=:fecha";
			$statement = $db->prepare($query);
			$statement->bindParam(':fecha', $fecha); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_INFORME'],
				  "fecha" => $res['FECHA'],
				  "cant_ventas" => $res['CANT_VENTAS'],
                  "venta_mayor" => $res['VENTA_MAYOR'],
                  "venta_menor" => $res['VENTA_MENOR'],
				  "venta_promedio" => $res['VENTA_PROMEDIO'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}
  
	public function getInformes(){
        try{
             $list = array();
             $conexion = new Conexion();
             $db = $conexion->getConexion();
             $query = "SELECT * FROM informe ORDER BY ID_INFORME";
             $statement = $db->prepare($query);
             $statement->execute();
             while($row = $statement->fetch()) {
                 $list[] = array(
                    "id" => $row['ID_INFORME'],
                    "fecha" => $row['FECHA'],
                    "cant_ventas" => $row['CANT_VENTAS'],
                    "venta_mayor" => $row['VENTA_MAYOR'],
                    "venta_menor" => $row['VENTA_MENOR'],
                    "venta_promedio" => $row['VENTA_PROMEDIO'] );
             }//fin del ciclo while 
     
             return $list;
     
        }catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
?>