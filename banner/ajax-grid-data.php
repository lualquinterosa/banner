<?php

session_start();
if(!isset($_SESSION['name'])) {
	header("Location: login.php");	

}// else echo $_SESSION['usr_id'];

 include "../conn.php";

/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'banner_id',
    1 => 'banner_ingreso',
    2 => 'banner_retiro',
    3 => 'banner_titulo',
    4 => 'banner_descripcion',
    5 => 'banner_file',
    6 => 'banner_link',
    7 => 'banner_activo',
);
	
	
// getting total number records without any search
$sql = "SELECT `banner_id`, `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`,banner_activo ";
$sql.=" FROM banner ";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT `banner_id`, `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`,banner_activo ";
	$sql.=" FROM banner";
	$sql.=" WHERE  (banner_titulo LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR  banner_activo LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR  banner_id LIKE '%".$requestData['search']['value']."%' )";

	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT `banner_id`, `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`,banner_activo ";
	$sql.=" FROM banner ";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["banner_id"];
    $nestedData[] = $row["banner_ingreso"];
    $nestedData[] = $row["banner_retiro"];
    $nestedData[] = $row["banner_titulo"];
    $nestedData[] = $row["banner_descripcion"];
    $nestedData[] = "<img src=".$row['banner_file']."  height='10%'>";
    $nestedData[] = $row["banner_link"];
    $nestedData[] = $row["banner_activo"];
	$msjeliminar=' Está seguro que desea eliminar banner:  '.$row['banner_titulo'];
	$href='index.php?action=delete&banner_id='.$row['banner_id'];



   // $nestedData[] = date("d/m/Y", strtotime($row["registrado"]));
   $usersid = $_SESSION['usersid'];
								
   $rs = mysqli_query($conn,"SELECT usersrol FROM users WHERE usersid='$usersid'");	
   if ($row = mysqli_fetch_row($rs)) {
	   $usersrol = trim($row[0]);
	   }
   
	   if ($usersrol==1) {
    $nestedData[] = '<td><center>
                     <a href="editar.php?banner_id='.$row['banner_id'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="menu-icon icon-pencil"></i> </a>
                      <a href="#"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger" onclick="javaScript: confirm(`Eliminar`,`'.$msjeliminar.'`,`'.$href.'`);"> <i class="menu-icon icon-trash"></i> </a>
				     </center></td>';		

	   }
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


