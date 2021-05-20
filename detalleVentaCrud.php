<?php

class DetalleVenta{
	
    
	
	public function addDetalleVenta($data){
		try{
			$id_registro = $data['id_registro'];
			$id_producto = $data['id_producto'];
			$cantidad = $data['cantidad'];
            $valor_x_cant = $data['valor_x_cant'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "INSERT INTO detalle_venta (ID_REGISTRO, ID_PRODUCTO, CANTIDAD, VALOR_X_CANT) VALUES (:id_registro,:id_producto,:cantidad,:valor_x_cant)";
			$statement = $db->prepare($query);
			$statement->bindParam(":id_registro", $id_registro);
			$statement->bindParam(":id_producto", $id_producto);
			$statement->bindParam(":cantidad", $cantidad);
            $statement->bindParam(":valor_x_cant", $valor_x_cant);
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
	
	public function deleteDetalleVentaReg($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM detalle_venta WHERE ID_REGISTRO=:id";
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

	public function deleteDetalleVentaProd($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM detalle_venta WHERE ID_PRODUCTO=:id";
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
	
	public function updateDetalleVenta($data){
		try{
			$id_registro = $data['id_registro'];
			$id_producto = $data['id_producto'];
			$cantidad = $data['cantidad'];
            $valor_x_cant = $data['valor_x_cant'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query="UPDATE detalle_venta SET CANTIDAD=:c,VALOR_X_CANT=:vxc
					WHERE ID_REGISTRO=:id_reg AND ID_PRODUCTO=:id_prod"  ;
			$statement= $db->prepare($query);
			$statement->bindParam(":c", $cantidad);
            $statement->bindParam(":vxc", $valor_x_cant);
            $statement->bindParam(":id_reg", $id_cliente);
			$statement->bindParam(":id_prod", $id); 
			$result = $statement->execute();
			if($result){ 
				return "updated"; 
			} 
			 return "error!";

		} catch(PDOException $e){
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}

	
	public function getDetalleVenta($data){
		try{
			$id = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM detalle_venta WHERE ID_REGISTRO=:id ORDER BY ID_REGISTRO";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id); 
			$statement->execute();
			while($row = $statement->fetch()) {
                $list[] = array(
                   "id_registro" => $row['ID_REGISTRO'],
                   "id_producto" => $row['ID_PRODUCTO'],
                   "cantidad" => $row['CANTIDAD'],
                   "valor_x_cant" => $row['VALOR_X_CANT'] );
            }//fin del ciclo while 
    
            return $list;
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}

}
?>