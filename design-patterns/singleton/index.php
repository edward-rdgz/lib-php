<?php

require_once 'DatabaseLayer.php';

//Como parámetro va el nombre del proveedor que queréis cargar  
$db = DatabaseLayer::getConnection("MySqlProvider");  
//Imprimiría la estructura del array  
print_r($db->execute("SELECT * FROM maintenances WHERE  name like ? LIMIT 20",array("c%")));  
//Imprime un valor númerico  
echo($db->executeScalar("SELECT count(*) FROM details_devices WHERE status = ?",array(true))); 

// url: http://web.ontuts.com/tutoriales/creando-una-capa-de-conexion-abstracta-a-base-de-datos-con-php/

?>