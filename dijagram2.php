<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
date_default_timezone_set('Europe/Belgrade');
session_start();
require "dbConn.php";
$kor_ime = $_SESSION['ulogovan'];
$result2 = mysqli_query($conn, "select * from konobari where kor_ime='$kor_ime'");
$row2 = mysqli_fetch_assoc($result2);
$id_restorana = $row2['id_restorana'];
$result3 = mysqli_query($conn, "select id_konobara, count(*) as broj_rezervacija from rezervacije where (id_restorana='$id_restorana' and status='dosao') group by id_konobara order by broj_rezervacija desc");
$niz1 = [];
$rezervacije_po_danima = [];
if(mysqli_num_rows($result3)>0){
    while($row3 = mysqli_fetch_assoc($result3)){
        $niz1[] = [
        'label' => $row3['id_konobara'],
        'y' => $row3['broj_rezervacija']
    ];
    }
}
?>
<html>
<head>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Raspodela gostiju medju konobarima za ovaj restoran"
	},
	data: [{
		type: "pie",
		indexLabel: "{y}",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($niz1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 50%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>  
