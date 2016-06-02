<html lang="en">
<script src="./papaparse.min.js"></script>
		<script src="./jquery-2.2.4.min.js"></script>
		<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			// Load the Visualization API and the corechart package.
		    google.charts.load('current', {'packages':['corechart']});
			//Read Data from file.
			var data;
			function handleFileSelect(evt) {
				console.log("handleFileSelect");
				var file = evt.target.files[0];
			    Papa.parse(file, {
			      delimiter:",",
			      header: true,
			      dynamicTyping: true,
			      complete: function(results) {
			        data = results;
			        demo(data); //Data is read from csv.
			      }
			    });
			    return handleFileSelect;
			}
		
		    	/*setInterval((function() {
		    		function loop() {
		    			console.log("Hello");
		    			$("#csv-file").change(handleFileSelect);
		    		};
		    		loop();
		    		return loop;
		    	}()),1000);*/
		    $(document).ready(function(){
			    $("#csv-file").change(handleFileSelect);
			    //handleFileSelect($("#csv-file"));
			});

		  	function demo(dataI) {
		  	  console.log("Demo");
		      //var d = JSON.stringify(dataI);
		      // Set a callback to run when the Google Visualization API is loaded.
		      google.charts.setOnLoadCallback(drawChart);

		      // Callback that creates and populates a data table,
		      // instantiates the pie chart, passes in the data and
		      // draws it.
		      function drawChart() {
		        // Create the data table.
		        var data = new google.visualization.DataTable();
		        data.addColumn('string', 'Label');
		        if ($('#CheckBox1').is(':checked') && $('#2CheckBoX').is(':checked')) {
		        	data.addColumn('number', 'Y');
		        	data.addColumn('number', 'X');
		        } else if($("#CheckBox1").is(':checked')) { 
		        	data.addColumn('number', 'Y');
		        } else {
		        	data.addColumn('number', 'X');
		        }
		       	for(var i=0;i<dataI.data.length;i++)
				{
					if ($('#CheckBox1').is(':checked') && $('#2CheckBoX').is(':checked')) {
						alert("Both checkbox checked");
      					data.addRows([[dataI.data[i].label, dataI.data[i].y, dataI.data[i].x]]);
      				} else if($("#CheckBox1").is(':checked')) {
      					alert("1st checkbox is checked");
      					data.addRows([[dataI.data[i].label, dataI.data[i].y]]);
      				}else {
      					alert("2nd checkbox is checked");
      					data.addRows([[dataI.data[i].label, dataI.data[i].x]]);
      				}
      				// /data.addRows([[dataI.data[i].label, dataI.data[i].y, dataI.data[i].x]]);
				}
		        // Set chart options
		        var options = {
			        title: "Visualization of CSV data",
			        width: '100%',
			        height: '100%',
			        axisTitlesPosition: 'out',
			        'isStacked': true,
			        pieSliceText: 'percentage',
			        backgroundColor: '#E4E4E4',
			        colors: ['#0598d8', '#f97263'],
			        chartArea: {
			            left: "5%",
			            top: "10%",
			            height: "75%",
			            width: "95%"
			        },
			        vAxis: {
			            title: "Y"
			        },
			        hAxis: {
			            title: "Labels"
			        }
			    };
		        // Instantiate and draw our chart, passing in some options.
		        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		        chart.draw(data, options);
		      }
		      return demo;
			}//end of function.
		</script>
	<head>
		<title>Generate.php</title>
		<link rel="stylesheet" href="http://localhost/work/vr/assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://localhost/work/vr/assets/custom.css">
		<style type="text/css">
			#chart_div {
				height:300px;
				width: 80%;
				align-self: center;
				margin: 10px;
				margin-left:200px;
			}
			#csv-file {
				width:300px; 
				margin-right:auto; 
				margin-left: auto; 
				margin-top: 0px;
				border:1px solid #000;
			}
			input[type="checkbox"] {
				margin-top: 20px;
				margin-left: 20px;
			}
			#CheckBox1{
				margin-left: 230px;
			}
		</style>
	</head>
	<body>
		<div id="start">
			<div class="overlay-layer">
				<div class="col-md-3 text-center"> 
      				<img src="assets/bu.png">
      			</div>
      			<div class="col-md-7 text-white">
					<h1 align="center" style="margin-top:100px;">Graph Generation Tool.</h1>
					<input type="file" id="csv-file" name="files" class="btn btn-lg btn-warning" style="margin-top:50px	"/>
					<input type="checkbox" name="demo" id="CheckBox1"/> Y
					<input type="checkbox" name="demo2" id="2CheckBoX"/> X
				</div>
				<div id="chart_div" class="col-md-12"></div>
			</div>
		</div>
	</body>
</html>