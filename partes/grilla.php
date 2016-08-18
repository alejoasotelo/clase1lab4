<?php
	require_once('clases/Alumnos.php');

	$ArrayDeAlumnos = Alumno::TraerTodasLasAlumnos();

	echo "<table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Foto   </th>				
					<th>  Nombre     </th>
					<th>  Apellido   </th>
					<th>  Dni        </th>
					<th>  BORRAR     </th>
					<th>  MODIFICAR  </th>
				</tr> 
			</thead>";   	

		foreach ($ArrayDeAlumnos as $alumnoAux){

			echo " 	<tr>
						<td><img  class='fotoGrilla' src='fotos/".$alumnoAux->GetFoto()."' /></td>
						
						<td>".$alumnoAux->GetNombre()."</td>
						<td>".$alumnoAux->GetApellido()."</td>
						<td>".$alumnoAux->GetDni()."</td>
						<td><button class='btn btn-danger' name='Borrar' onclick='Borrar(".$alumnoAux->GetId().")'>   <span class='glyphicon glyphicon-remove-circle'>&nbsp;</span>Borrar</button></td>
						<td><button class='btn btn-warning' name='Modificar' onclick='Modificar(".$alumnoAux->GetId().")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Modificar</button></td>
					</tr>";
		}	
	echo "</table>";		
?>
