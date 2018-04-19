<?php
wp_enqueue_style('wp-ep_fitness-report-11', wp_ep_fitness_URLPATH . 'admin/files/css/report/normalize.css');
wp_enqueue_script('ep_fitness-report-12', wp_ep_fitness_URLPATH . 'admin/files/js/amcharts.js');
//wp_enqueue_script('ep_fitness-report-13', wp_ep_fitness_URLPATH . 'admin/files/js/serial.js');

global $wpdb;
			


	$user_chart= array();	
	$user_chart_string='';
	$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('physical-record' )  and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' )  ORDER BY `ID` ASC ";									
	$authpr_post = $wpdb->get_results($sql);
	$total_post=count($authpr_post);									
	if($total_post>0){
		$i=0; 
		foreach ( $authpr_post as $row )								
		{		
		 		
		$user_chart[$i]['udate']=date('Y-m-d',strtotime(get_post_meta($row->ID,'date',true)));
		$user_chart[$i]['value']= get_post_meta($row->ID,'weight',true);;			
		$i++;
		}
	}

	$user_chart_string= json_encode($user_chart);
	
				
?>

		<div class="row">		
			<div class="col-md-12">	
				<h3  class="page-header"><?php esc_html_e('Weight Chart','epfitness'); ?> <small></small></h3>
			</div>	
			<div class="col-md-12">		
				<div id="chart-line" style="width:100%; height:400px;"></div>
			</div>
		</div>
					
 <style>

a:link {color: #84c4e2;}
a:visited {color:#84c4e2;}
a:hover {color: #cd82ad;}
a:active {color: #84c4e2;}
 </style>
    <script type="text/javascript">
            var chart;
            var graph;
			var chartData =<?php echo	$user_chart_string; ?> ;
				
           jQuery(document).ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.pathToImages = "<?php echo wp_ep_fitness_URLPATH;?>admin/files/images/";
                chart.dataProvider = chartData;
                chart.marginLeft = 10;
                chart.categoryField = "udate";
                //chart.dataDateFormat = "M-d-Y";
                 chart.dataDateFormat = "YYYY-MM-DD";


                // listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens
                chart.addListener("dataUpdated", zoomChart);

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is yearly, so we set minPeriod to YYYY
                categoryAxis.dashLength = 3;
                categoryAxis.minorGridEnabled = true;
                categoryAxis.minorGridAlpha = 0.1;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.inside = true;
                valueAxis.dashLength = 3;
                chart.addValueAxis(valueAxis);

                // GRAPH
                graph = new AmCharts.AmGraph();
                graph.type = "smoothedLine"; // this line makes the graph smoothed line.
                graph.lineColor = "#d1655d";
                graph.negativeLineColor = "#637bb6"; // this line makes the graph to change color when it drops below 0
                graph.bullet = "round";
                graph.bulletSize = 8;
                graph.bulletBorderColor = "#FFFFFF";
                graph.bulletBorderAlpha = 1;
                graph.bulletBorderThickness = 2;
                graph.lineThickness = 2;
                graph.valueField = "value";
                //graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>";
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.cursorPosition = "mouse";
                chartCursor.categoryBalloonDateFormat =  "DD";
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chart.addChartScrollbar(chartScrollbar);

                chart.creditsPosition = "bottom-right";

                // WRITE
                chart.write("chart-line");
            });

            // this method is called when chart is first inited as we listen for "dataUpdated" event
            function zoomChart() {
                // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
               // chart.zoomToDates(new Date(1972, 0), new Date(1984, 0));
            }
        </script>
