//testomg
function createGraph(name){
var chart1; // globally available
var chart2; // globally available
$(document).ready(function() {
      var options = {
         chart: {
            renderTo: 'employee',
            type: 'pie',
	    backgroundColor: 'transparent'
         },
         title: {
            text: 'Your Score'
         },
         xAxis: {
         	categories: []
	},
         yAxis: {
		title: {
			text: ''
		},
		plotLines: [{
			value: 0,
			width: 1,
			color: '#808080'
		}]


         },

         series: []
      };
      var options2 = {
         chart: {
            renderTo: 'top10',
            type: 'column',
	    backgroundColor: 'transparent'
         },
         title: {
            text: 'Top 7 Countries Scoring 100%'
         },
         xAxis: {
         	categories: []
	},
         yAxis: {
		title: {
			text: ''
		},
		plotLines: [{
			value: 0,
			width: 1,
			color: '#808080'
		}]


         },

         series: []
      };


	$.post('datacsv.php', {request: name},function(data){
		//alert(data);
		var lines = data.split('\n');
		$.each(lines, function(lineNo, line) {
			var items = line.split(',');	

			if (lineNo == 0) {
				$.each(items, function(itemNo, item) {
					if (itemNo > 0) options.xAxis.categories.push(item);
					if (itemNo > 0) options2.xAxis.categories.push(item);
				});
			}	
			else {
				var series = { 
					data: []
				};
				$.each(items, function(itemNo, item) {
					if (itemNo == 0) {
						series.name = item;
					} else {
						series.data.push(parseFloat(item));
					}
				});
		
				options.series.push(series);
				options2.series.push(series);
				}
		
		});
	
		var chart1 = new Highcharts.Chart(options);
		var chart2 = new Highcharts.Chart(options2);
	//end of post
	});
//end of function
});

//end of createGraph
}
