<?php

require_once('conexion.php');
require_once('cors.php');
require_once('productoCrud.php');
require_once('clienteCrud.php');
require_once('ubicacionCrud.php');
require_once('registroVentaCrud.php');
require_once('informeCrud.php');
require_once('detalleVentaCrud.php');

$methodHTTP = $_SERVER['REQUEST_METHOD'];

switch ($methodHTTP) {

    case 'GET':
		$peticion = $_GET; 
		if($peticion['table']=='producto'){
			if($peticion['id']=='0'){
				$ctl = new Producto();
				$data = $ctl->getProductos();
				echo json_encode(["data" => $data]);
			}else{
				$data = $peticion['id'];
				$ctl = new Producto();
				$result = $ctl->getProducto($data);
				echo json_encode([ "data" => $result ]);
			}
		}elseif($peticion['table']=='cliente'){
			if($peticion['id']=='0'){
				$ctl = new Cliente();
				$data = $ctl->getClientes();
				echo json_encode(["data" => $data]);
			}elseif($peticion['id']=='-1'){
				$data = $peticion['documento'];
				$ctl = new Cliente();
				$data = $ctl->getClienteDoc($data);
				echo json_encode(["cliente" => $data]);
			}
			else{
				$data = $peticion['id'];
				$ctl = new Cliente();
				$result = $ctl->getCliente($data);
				echo json_encode([ "data" => $result ]);
			}
		}elseif($peticion['table']=='ubicacion'){
			if($peticion['id']=='0'){
				$ctl = new Ubicacion();
				$data = $ctl->getUbicacions();
				echo json_encode(["data" => $data]);
			}else{
				$data = $peticion['id'];
				$ctl = new Ubicacion();
				$result = $ctl->getUbicacion($data);
				echo json_encode([ "data" => $result ]);
			}
		}elseif($peticion['table']=='informe'){
			if($peticion['id']=='0'){
				$ctl = new Informe();
				$data = $ctl->getInformes();
				echo json_encode(["data" => $data]);
			}elseif($peticion['id']=='-1'){
				$data = $peticion['fecha'];
				$ctl = new Informe();
				$data = $ctl->getInformeDay($data);
				echo json_encode(["informe" => $data]);
			}
			else{
				$data = $peticion['id'];
				$ctl = new Informe();
				$result = $ctl->getInforme($data);
				echo json_encode([ "data" => $result ]);
			}
		}elseif($peticion['table']=='registro_venta'){
			if($peticion['id']=='0'){
				$ctl = new RegistroVenta();
				$data = $ctl->getRegistroVentas();
				echo json_encode(["data" => $data]);
			}elseif($peticion['id']=='-1'){
				$data = $peticion['fecha'];
				$ctl = new RegistroVenta();
				$data = $ctl->getRegistroFecha($data);
				echo json_encode(["registro" => $data]);
			}elseif($peticion['id']=='null'){
				$data = $peticion['informe'];
				$ctl = new RegistroVenta();
				$data = $ctl->getRegistrosInforme($data);
				echo json_encode(["informes" => $data]);
			}
			else{
				$data = $peticion['id'];
				$ctl = new RegistroVenta();
				$result = $ctl->getRegistroVenta($data);
				echo json_encode([ "data" => $result ]);
			}
		}elseif($peticion['table']=='detalle_venta'){
			$data = $peticion['id'];
			$ctl = new DetalleVenta();
			$result = $ctl->getDetalleVenta($data);
			echo json_encode([ "data" => $result ]);
		}
		else{
			echo null;
		}
		
        
        break;

    case 'POST':
		$peticion = $_GET; 	
		$data = json_decode(file_get_contents('php://input'), true);
		if($peticion['table']=='producto'){
		    $ctl = new Producto();
		    $result = $ctl->addProducto($data);
		    echo json_encode([ "data" => $result ]);
		}elseif($peticion['table']=='cliente'){
		    $ctl = new Cliente();
		    $result = $ctl->addCliente($data);
		    echo json_encode([ "data" => $result ]);
		}elseif($peticion['table']=='ubicacion'){
		    $ctl = new Ubicacion();
		    $result = $ctl->addUbicacion($data);
		    echo json_encode([ "data" => $result ]);
		}elseif($peticion['table']=='informe'){
		    $ctl = new Informe();
		    $result = $ctl->addInforme($data);
		    echo json_encode([ "data" => $result ]);
		}elseif($peticion['table']=='registro_venta'){
		    $ctl = new RegistroVenta();
		    $result = $ctl->addRegistroVenta($data);
		    echo json_encode([ "data" => $result ]);
		}elseif($peticion['table']=='detalle_venta'){
		    $ctl = new DetalleVenta();
		    $result = $ctl->addDetalleVenta($data);
		    echo json_encode([ "data" => $result ]);
		}
		else{
			echo null;
		}
		break;

    case 'DELETE':
        $peticion = $_GET;
	    if($peticion['table']=='producto'){
			$data = $peticion['id'];
		    $ctl = new Producto();
		    $result = $ctl->deleteProducto($data);
		    echo json_encode([ "data" => $result ]);
	    }elseif($peticion['table']=='cliente'){
			$data = $peticion['id'];
		    $ctl = new Cliente();
		    $result = $ctl->deleteCliente($data);
		    echo json_encode([ "data" => $result ]);
	    }elseif($peticion['table']=='ubicacion'){
			$data = $peticion['id'];
		    $ctl = new Ubicacion();
		    $result = $ctl->deleteUbicacion($data);
		    echo json_encode([ "data" => $result ]);
	    }elseif($peticion['table']=='informe'){
			$data = $peticion['id'];
		    $ctl = new Informe();
		    $result = $ctl->deleteInforme($data);
		    echo json_encode([ "data" => $result ]);
	    }elseif($peticion['table']=='registro_venta'){
			$data = $peticion['id'];
		    $ctl = new RegistroVenta();
		    $result = $ctl->deleteRegistroVenta($data);
		    echo json_encode([ "data" => $result ]);
	    }elseif($peticion['table']=='detalle_venta'){
			$data = $peticion['id'];
		    $ctl = new DetalleVenta();
		    $result = $ctl->deleteDetalleVenta($data);
		    echo json_encode([ "data" => $result ]);
	    }
		else{
			echo null;
		}
		break;
	   

    case 'PUT';
		$peticion = $_GET;
		$data = json_decode(file_get_contents('php://input'), true); 
		if($peticion['table']=='producto'){
			$ctl = new Producto();
			$result = $ctl->updateProducto($data);
			echo json_encode([ "data" => $result  ]);
		}elseif($peticion['table']=='cliente'){
			$ctl = new Cliente();
			$result = $ctl->updateCliente($data);
			echo json_encode([ "data" => $result  ]);
		}elseif($peticion['table']=='ubicacion'){
			$ctl = new Ubicacion();
			$result = $ctl->updateUbicacion($data);
			echo json_encode([ "data" => $result  ]);
		}elseif($peticion['table']=='informe'){
			$ctl = new Informe();
			$result = $ctl->updateInforme($data);
			echo json_encode([ "data" => $result  ]);
		}elseif($peticion['table']=='registro_venta'){
			$ctl = new RegistroVenta();
			$result = $ctl->updateRegistroVenta($data);
			echo json_encode([ "data" => $result  ]);
		}elseif($peticion['table']=='detalle_venta'){
			$ctl = new DetalleVenta();
			$result = $ctl->updateDetalleVenta($data);
			echo json_encode([ "data" => $result  ]);
		}
		else{
			echo null;
		}
		break;

  default:
    # code...
    break;
}

?>