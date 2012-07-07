function createGraph(name){
var chart1; // globally available
var chart2; // globally available
$(document).ready(function() {
      var options = {
         chart: {
            renderTo: name,
            type: 'line'
         },
         title: {
            text: 'Employees in Company YTD'
         },
         xAxis: {
         	categories: []
	},
         yAxis: {
		title: {
			text: 'Amount of Employees in Company'
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
		alert(data);
		var lines = data.split('\n');
		$.each(lines, function(lineNo, line) {
			var items = line.split(',');	

			if (lineNo == 0) {
				$.each(items, function(itemNo, item) {
					if (itemNo > 0) options.xAxis.categories.push(item);
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
				}
		
		});
	
		var chart1 = new Highcharts.Chart(options);
	//end of post
	});
//end of function
});

//end of createGraph
}
