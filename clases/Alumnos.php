<?php
require_once"accesoDatos.php";
class Alumno
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id;
	private $nombre;
 	private $apellido;
  	private $dni;
  	private $foto;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetApellido()
	{
		return $this->apellido;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetDni()
	{
		return $this->dni;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetApellido($valor)
	{
		$this->apellido = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetDni($valor)
	{
		$this->dni = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($dni=NULL)
	{
		if($dni != NULL){
			$obj = Alumno::TraerUnaAlumno($dni);
			
			$this->apellido = $obj->apellido;
			$this->nombre = $obj->nombre;
			$this->dni = $dni;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->apellido."-".$this->nombre."-".$this->dni."-".$this->foto;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaAlumno($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from alumno where id =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$alumnoBuscada= $consulta->fetchObject('alumno');
		return $alumnoBuscada;	
					
	}
	
	public static function TraerTodasLasAlumnos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from alumno");
		$consulta->execute();			
		$arrAlumnos= $consulta->fetchAll(PDO::FETCH_CLASS, "alumno");	
		return $arrAlumnos;
	}
	
	public static function Borrar($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from alumno	WHERE id=:id");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function Modificar($alumno)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update alumno 
				set nombre=:nombre,
				apellido=:apellido
				WHERE id=:id");
			$consulta->bindValue(':id',$alumno->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$alumno->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':apellido', $alumno->apellido, PDO::PARAM_STR);
			//$consulta->bindValue(':foto', $alumno->foto, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function Insertar($alumno)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumno (nombre,apellido)values(:nombre,:apellido)");
				$consulta->bindValue(':nombre',$alumno->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido', $alumno->apellido, PDO::PARAM_STR);
				//$consulta->bindValue(':dni', $alumno->dni, PDO::PARAM_STR);
				//$consulta->bindValue(':foto', $alumno->foto, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//

}