<?php


class Alumnos
{
	private $con;

	// Tabla
	public $table = "Alumnos";

    // Campos
	public $id;
	public $nombres;
	public $apellidos;
	public $fechanac;
	public $foto;

	// Constructor de clase
	public function __construct($db)
	{
		$this->con = $db;
	}

    // Crear los metodos crud para los microservicios
    // Create
    public function createAlumn()
    {
    	$consulta = "INSERT into " . $this->table .
    				" SET  
    				nombres   = :nombres,
    				apellidos = :apellidos,
    				fechanac  = :fechanac,
    				foto 	  = :foto";

      
    	$comando = $this->con->prepare($consulta);
        
        // Limpieza
        $this->nombres = htmlspecialchars(strip_tags($this->nombres));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->fechanac = htmlspecialchars(strip_tags($this->fechanac));
		$this->foto = htmlspecialchars(strip_tags($this->foto));

        // paso de parametros
		$comando->bindParam(":nombres", $this->nombres);
		$comando->bindParam(":apellidos", $this->apellidos);
		$comando->bindParam(":fechanac", $this->fechanac);
		$comando->bindParam(":foto", $this->foto);

		if($comando->execute())
		{
			return true;
		}
		return false;
    }

    // Read lista completa
    public function GetAlumns()
    {
    	$sql = "SELECT id, nombres, apellidos, fechanac, foto FROM " .$this->table . "";
    	$stmt = $this->con->prepare($sql);
    	$stmt->execute();

    	return $stmt;
    }

    // Read un Alumno
    public function GetAlumn()
    {
    	$sql = "SELECT id, nombres, apellidos, fechanac FROM " .
    	        $this->table . 
    	        "WHERE id = ? LIMIT 0,1";
    	

    	$stmt = $this->con->prepare($sql);
    	$stmt->bindParam(1, $this->id);
    	$stmt->execute();

    	return $stmt;
    }


    public function  updateAlumn()
    {
    	$consulta = "UPDATE " . $this->table .
    				"SET 
    				nombres   = :nombres,
    				apellidos = :apellidos,
    				fechanac  = :fechanac,
    				foto 	  = :foto
    				WHERE id = :id";

    	$comando = $this->con->prepare($consulta);
        
        // Limpieza
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->fechanac = htmlspecialchars(strip_tags($this->fechanac));
		$this->foto = htmlspecialchars(strip_tags($this->foto));

        // paso de parametros
        $comando->bindParam(":id", $this->id);
		$comando->bindParam(":nombres", $this->nombre);
		$comando->bindParam(":apellidos", $this->apellidos);
		$comando->bindParam(":fechanac", $this->fechanac);
		$comando->bindParam(":foto", $this->foto);

		if($comando->execute())
		{
			return true;
		}
		return false;
    }

    function deleteAlum()
    {
    	$sql = "DELETE FROM " .
    	        $this->table . 
    	        "WHERE id = ?";
    	

    	$stmt = $this->con->prepare($sql);

    	$this->id = htmlspecialchars(strip_tags($this->id));
    	$stmt->bindParam(1, $this->id);
    	
    	if($stmt->execute())
    	{
    		return true;
    	}

    	return false;
    }

}

?>