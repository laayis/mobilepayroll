<?php
if(empty($awdaccess)) {
	header('Location: http://timesheet.elasticbeanstalk.com/');
	die();
}
?>

<script type="text/javascript" src="/js/themes/dark-blue.js"></script>
<script src="/js/highcharts.js" type="text/javascript"></script>
<script src="/js/graph.js" type="text/javascript"></script>
<h1>Statistical Tools</h1>
<hr />
Select a function at the left by clicking on an activity you'd like to complete.
<script type="text/javascript">createGraph('employee');</script>


<div id="employee" style="width: 100%; height: 400px"></div>
