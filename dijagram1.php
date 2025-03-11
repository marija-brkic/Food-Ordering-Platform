<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
date_default_timezone_set('Europe/Belgrade');
$datumi = [];
for ($i = 6; $i >= 0; $i--) {
    $datumi[] = date('Y-m-d', strtotime("-$i days"));
}

require "dbConn.php";
session_start();
$kor_ime = $_SESSION['ulogovan'];
$result1 = mysqli_query($conn, "select * from konobari where kor_ime='$kor_ime'");
$row1 = mysqli_fetch_assoc($result1);
$id_konobara = $row1['id'];
$result = mysqli_query($conn, "select date(datum_i_vreme) as dan, count(*) as broj_rezervacija from rezervacije where (id_konobara='$id_konobara' and datum_i_vreme>=(now()-interval 7 day) and datum_i_vreme<=now() and status='dosao') group by dan order by dan");
$niz = [];
$rezervacije_po_danima = [];
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $rezervacije_po_danima[$row['dan']] = $row['broj_rezervacija'];
    }
}


foreach ($datumi as $datum) {
    $niz[] = [
        'label' => $datum,
        'y' => isset($rezervacije_po_danima[$datum]) ? $rezervacije_po_danima[$datum] : 0
    ];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Broj gostiju po danu"
	},
	axisY: {
		title: "Broj gostiju"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($niz, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
};
</script>
    <body>
        <div id="chartContainer" style="height: 370px; width: 50%;"></div>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </body>
</html>
