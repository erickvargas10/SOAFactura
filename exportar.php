<?php
$xml= simplexml_load_file("https://github.com/BYRONTOSH/SOAFactura/blob/master/ejemplo1.xml");
foreach ($xml->nodo_hijo as $nodo) {
	echo $nodo->valor."<br>";
}


$nuevo = array("elemento1","elemento2", "elemento3");
foreach ($nuevo as $ele) {
	echo $ele;
}



// 1.- CREAR LA FUNCIÓN PARA CREAR UN ARCHIVO
	function crea_fichero($abc)
	{
		//creamos el fichero.
		$flujo=fopen('dataExportada.xml','w');
		//volcamos el contenido de cadena al fichero
		fputs($flujo,$abc);
		//cerramos el flujo
		fclose($flujo);

	}
// 2.- CREAR LA CONEXIÓN A LA BDD
	$db_host="localhost";
	$db_nombrebdd="xml";
	$db_usuario="root";
	$db_contra="";
	$dwes=mysqli_connect($db_host,$db_usuario,$db_contra);
	if(mysqli_connect_errno($dwes))
	{
		echo "CONEXIÓN FALLIDA";
	}
	else
	{
		echo "CONEXIÓN OK";
	}
	mysqli_set_charset($dwes,"utf8");
	mysqli_select_db($dwes,$db_nombrebdd)or die ("BDD NO SE ENCUENTRA");

// 3.- PREPARAR LA CONSULTA PARA TRAER LOS REGISTROS DE LA BDD
if (isset($dwes))
{

	$a = $sql="SHOW TABLES";
    $xml="<?xml version=\"1.0\"?>\n";
	$b=mysqli_query($dwes,$a);
	
	while(($ver=mysqli_fetch_row($b))==true)
	{
	$xml .= "\t<".$ver[0].">\n";
	
    $c= $sql="select *from usuarios";
	$d=mysqli_query($dwes,$c);
		while($fila =mysqli_fetch_array($d,MYSQLI_ASSOC))
		{

            $xml .= "\t\t<registro>\n";

            foreach ($fila as $k => $v) 
			{
				echo "$k => $v.\n";
                echo "<br/>";

                $xml .= "\t\t\t<".$k.">".$v."</".$k.">\n";
            }
            $xml .= "\t\t</registro>\n";
		}
        $xml .= "\t</".$ver[0].">\n";
	
	}
	
	crea_fichero($xml); 

}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

?>