<?php
date_default_timezone_set('Europe/Belgrade');
require "dbConn.php";
session_start();
$kor_ime = $_SESSION['ulogovan'];
$result1 = mysqli_query($conn, "select * from konobari where kor_ime='$kor_ime'");
$row1 = mysqli_fetch_assoc($result1);
$id_restorana = $row1['id_restorana'];
$result = mysqli_query($conn, "select dayofweek(datum_i_vreme) as dan_u_nedelji, count(*) as broj_rezervacija from rezervacije where (id_restorana='$id_restorana' and datum_i_vreme>=(now()-interval 24 month) and datum_i_vreme<=now()) group by dan_u_nedelji order by dan_u_nedelji");

$dan_u_nedelji_mapiranje = [
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    7 => 'Sunday'
];

$niz = [];

$rezervacije_po_danima = array_fill(1, 7, 0);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dan_u_nedelji = $row['dan_u_nedelji'];
        $rezervacije_po_danima[$dan_u_nedelji] = $row['broj_rezervacija'];
    }
}


foreach ($dan_u_nedelji_mapiranje as $dan_u_nedelji => $label) {
    $niz[] = [
        'label' => $label,
        'y' => $rezervacije_po_danima[$dan_u_nedelji]/104
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
                text: "Prosecan broj rezervacija po danima u poslednje 2 godine"
            },
            axisY: {
                title: "Broj rezervacija"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.##",
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
