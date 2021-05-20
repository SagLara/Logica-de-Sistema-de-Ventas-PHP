<?php

class Producto{
	
    
	
	public function addProducto($data){
		try{
			$nombre = $data['nombre'];
			$precio = $data['precio'];
			$stock = $data['stock'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "INSERT INTO producto (NOMBRE, PRECIO, STOCK) VALUES (:nombre,:precio,:stock)";
			$statement = $db->prepare($query);
			$statement->bindParam(":nombre", $nombre);
			$statement->bindParam(":precio", $precio);
			$statement->bindParam(":stock", $stock);
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
	
	public function deleteProducto($data){
	    try {
			$id = $data;
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "DELETE FROM producto WHERE ID_PRODUCTO=:id";
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
	
	public function updateProducto($data){
		try{
			$id = $data['id'];
			$nombre = $data['nombre'];
			$precio = $data['precio'];
			$stock = $data['stock'];
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query="UPDATE producto SET NOMBRE=:n,PRECIO=:p,STOCK=:s
					WHERE ID_PRODUCTO=:id";
			$statement= $db->prepare($query);
			$statement->bindParam(":n", $nombre);
			$statement->bindParam(":p", $precio);
			$statement->bindParam(":s", $stock);
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

	
	public function getProducto($data){
		try{
			$id = $data;
			$list = array();
			$conexion = new Conexion();
			$db = $conexion->getConexion();
			$query = "SELECT * FROM producto WHERE ID_PRODUCTO=:id";
			$statement = $db->prepare($query);
			$statement->bindParam(':id', $id); 
			$statement->execute();
			$res = $statement->fetch();
			if($res==false){
				return null;
			}else{
				$list[] = array(
				  "id" => $res['ID_PRODUCTO'],
				  "nombre" => $res['NOMBRE'],
				  "precio" => $res['PRECIO'],
				  "stock" => $res['STOCK'] );
			}
			
			return $list[0];
			
		}catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
	}
  
	public function getProductos(){
        try{
             $list = array();
             $conexion = new Conexion();
             $db = $conexion->getConexion();
             $query = "SELECT * FROM producto ORDER BY ID_PRODUCTO";
             $statement = $db->prepare($query);
             $statement->execute();
             while($row = $statement->fetch()) {
                 $list[] = array(
                      "id" => $row['ID_PRODUCTO'],
                      "nombre" => $row['NOMBRE'],
                      "precio" => $row['PRECIO'],
                      "stock" => $row['STOCK'] );
             }//fin del ciclo while 
     
             return $list;
     
        }catch(PDOException $e){
            echo "¡Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
?>