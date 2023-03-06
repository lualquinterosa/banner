        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PIT - Unipaz</title>
        <!-- css table datatables/dataTables -->
		<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
    
         <link type="text/css" href="../css/bootstrap.css" rel="stylesheet">
        <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
        <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../css/theme.css" rel="stylesheet">
        <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'    rel='stylesheet'>
            
            
            
        <script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		 <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		
   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<!-- obtenido de https://craftpip.github.io/jquery-confirm/ -->
<script>


function confirm(tit,cont,href){
$.confirm({
    title: tit,
    content: cont,
    buttons: {
        confirm: function () {
       location.href = href;
	return true;
        },
        cancel: function () {
           return true;
        }
    }
});	
}
function alert(tit,cont,href){
	
$.alert({
    title: tit,
    content: cont,
buttons: {
        Ok: function () {
       if (href !="") location.href = href;
	return true;
        }
        }
});
	
}
</script>
<style>
body, html{ margin:0; padding:0;}
</style>