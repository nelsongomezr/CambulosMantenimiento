<?php 
require("parametros.php");
class Conexion
{

	protected $conex;

	public function Conexion()
	{
		try
		{
			$this->conex= new PDO("mysql:host=".serv.";dbname=".base.";charset=".charset.";port=".port,usua,pass);
		
		}
		catch(exception $e)
		{
			echo"Error al aconectar la base de datos".$e->getMessage();
		}

	}

}


?>