<?php
session_start();
if(!isset($_SESSION['name'])) {
	header("Location: login.php");
	
}
 include "../conn.php";

/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'usersid',
    1 => 'usersnombre',
    2 => 'usersmail',
   // 3 => 'userspassword',
    3 => 'usersestado',
    4 => 'usersrol',
);

$usersid = $_SESSION['usersid'];
								
	$rs = mysqli_query($conn,"SELECT usersrol FROM users WHERE usersid='$usersid'");	
	if ($row = mysqli_fetch_row($rs)) {
	$usersrol = trim($row[0]);
	}


// getting total number records without any search
$sql = "SELECT users.usersid, `usersnombre`, `usersmail`, `userspassword`, `usersestado`, `usersrol` ";
$sql.=" FROM users";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT users.usersid, `usersnombre`, `usersmail`, `userspassword`, `usersestado`, `usersrol` ";
$sql.=" FROM users";
	$sql.=" WHERE usersnombre LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" AND usersmail LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT users.usersid, `usersnombre`, `usersmail`, `userspassword`, `usersestado`, `usersrol` ";
$sql.=" FROM users ";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	if($row["usersrol"]==1) $usersrol="Administrador";
	if($row["usersrol"]==2) $usersrol="Invitado";
	
	if($row["usersestado"]=='A') $estado="Activo";
	if($row["usersestado"]=='N') $estado="Inactivo";


	$nestedData[] = $row["usersid"];
    $nestedData[] = $row["usersnombre"];
    $nestedData[] = $row["usersmail"];
    //$nestedData[] = $row["userspassword"];
    $nestedData[] = $estado;
    $nestedData[] = $usersrol;
	$msjeliminar=' Está seguro que desea eliminar usuario:  '.$row['usersnombre'];
	$href='index.php?action=delete&usersid='.$row['usersid'];

   // $nestedData[] = date("d/m/Y", strtotime($row["registrado"]));
    $nestedData[] = '<td><center>
    <a href="editar.php?usersid='.$row['usersid'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="menu-icon icon-pencil"></i> </a>
    <a href="#"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger" onclick="javaScript: confirm(`Eliminar`,`'.$msjeliminar.'`,`'.$href.'`);"> <i class="menu-icon icon-trash"></i> </a>
	 </center></td>';		
	
	$data[] = $nestedData;
    
}


$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
