<?php
$title = "Pinnakisa";
$script = "
	<script src=\"http://biomi.kapsi.fi/tools/tringa-eko/include/highcharts.js\"></script>
	<script src=\"http://biomi.kapsi.fi/tools/tringa-eko/include/exporting.js\"></script>
";
include "page_elements/header.php";

//echo "<pre>"; print_r ($species); echo "</pre>"; // debug

echo "<h1><a href=\"" . site_url("/results/summary/" . $contest['id']) . "\">&laquo;</a> " . htmlspecialchars($contest['name'], ENT_COMPAT, 'UTF-8') . "</h1>";

echo "<h3>Oman lajimäärän kehitys</h3>";

if ($takenPartThisyear)
{
	echo "<div id=\"container\" style=\"min-width: 400px; height: 800px; margin: 0 auto\"></div>";
?>
<script>
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'spline'
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e.%m.',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: 'Lajeja'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%A %e.%m.', this.x) +': '+ this.y + ' lajia';
                }
            },
			plotOptions: {
                spline: {
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 10,
							color: '#ff0000'
                        }
                    },
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 5,
                                lineWidth: 1
                            }
                        }
                    },
                }
            },

            series:
            [
				<?php
                foreach ($fullData as $number => $yearlyData)
                {
                    echo $yearlyData;
                }
                ?>
			]
			});
		});
	});
</script>
<?php

}
else
{
	echo "<p>Et ole vielä osallistunut tähän kisaan, joten et voi vertailla tuloksia.</p>";
}


include "page_elements/footer.php";

?>