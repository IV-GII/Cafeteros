
<?php
	require_once "configuracion.php";
	ini_set ("display_errors","1" );
	error_reporting(E_ALL);

	function conectarse(){
		$mysqli = new mysqli(DB_DSN, DB_USUARIO, DB_PASS, DB_NAME) or die ("No se ha podido Conectar");
		
		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}
		return $mysqli;		
	}

	function consultarUsuario($user, $pass){
		$mysqli = conectarse(); 
		if ($resultado = $mysqli->query("SELECT * FROM `usuario` WHERE username = '". $user."'")) {
		   $vectorResultado = $resultado -> fetch_assoc();
		   if($vectorResultado == null){
			echo "No existe usuario";
			}else if($vectorResultado['password']==$pass)
						return true;
					else
						return false;
		} else{
			echo "error peticion";
			printf("Errormessage: %s\n", $mysqli->error);
		}
		$mysqli->close();
	}
	
	function consultarMaquina($maquina){
		$mysqli = conectarse(); 
		$maquinas=""; 
		if ($resultado = $mysqli->query("SELECT * FROM  `maquinas` WHERE  `cod_maquina` =".$maquina)) {
			while ($row = $resultado->fetch_assoc()) {
				$maquinas= 'Modelo: '.$row["modelo"].'<br>Firm: '.$row["firmware"].'<br>Fabricante: '.$row["fabricante"].'<br>N&uacute;mero de cafes: '.$row["n_cafes"].'<br>Vasos totales: '.$row["vasos_totales"].'<br>Vasos mantenido: '.$row["vasos_mantenido"].'<br>N&uacute;mero impresi&oacute;n: '.$row["n_impresion"];
			}
			return $maquinas;
		}else{
			echo "error peticion";
			printf("Errormessage: %s\n", $mysqli->error);
		}
		
		$mysqli->close();
	}

	function consultarCodigosMaquinas(){
		$mysqli = conectarse(); 
		$columnaIzq=""; 
		if ($resultado = $mysqli->query("SELECT * FROM " . MAQUINAS)) {
			while ($row = $resultado->fetch_assoc()) {
				$columnaIzq= $columnaIzq.'<li><a href="#">M&aacute;quina '.$row["cod_maquina"].'</a></li>';
			}
			return $columnaIzq;
		}else{
			echo "error peticion";
			printf("Errormessage: %s\n", $mysqli->error);
		}
		
		$mysqli->close();
	}

	function obtenerTablaBotones($maquina){
		$mysqli = conectarse(); 
		$datos=""; 
		if ($resultado = $mysqli->query("SELECT * FROM  `Producto` WHERE  `id_maquina` =".$maquina)) {
			while ($row = $resultado->fetch_assoc()) {
				//$datos= $columnaIzq.'<li><a href="#">M&aacute;quina '.$row["cod_maquina"].'</a></li>';
				$datos = $datos."Botón: ".$row["boton"]."<br>". "&nbsp;&nbsp;&nbsp;&nbsp;Pagados:".$row["pago"]."<br>". "&nbsp;&nbsp;&nbsp;&nbsp;Gratis:".$row["gratis"]."<br>". "&nbsp;&nbsp;&nbsp;&nbsp;Test:".$row["test"]."<br>";
			}
			return $datos;
		}else{
			echo "error peticion";
			printf("Errormessage: %s\n", $mysqli->error);
		}
		
		$mysqli->close();
	}

	function consultarCodigo($maquina){
		$mysqli = conectarse(); 
		$codigo=""; 
		if ($resultado = $mysqli->query("SELECT * FROM " . MAQUINAS . "WHERE cod_maquina=" . $maquina)) {
			while ($row = $resultado->fetch_assoc()) {
				$codigo= 'M&aacute;quina '.$row["cod_maquina"];
			}
			return $codigo;
		}else{
			echo "error peticion";
			printf("Errormessage: %s\n", $mysqli->error);
		}
		
		$mysqli->close();
	}