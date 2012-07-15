<html>
<head>
<title>Quiz App</title>

<style type="text/css">
.bg 
{
	background-image:url('images/scroll.png');
	background-color:#cccccc;
	background-position:center; 
	background-repeat:no-repeat;
	height: 1024px;
}

#top10{
	width: 600px;
	height: 400px;
	position: relative;
	top: 300px;
	left: 30px;
}
.pie{
	width: 400px;
	height: 400px;
	position: relative;
	top: -120px;
	float: right;
}

.left{
	width: 690px;
	position: absolute;
	top: 200px;
	left: 300px;
}

.compass{
	background-image:url('images/compass_300.png');
	background-repeat:no-repeat;
	width: 300px;
	height: 300px;
	position: relative;
	top: 724px;
	left: 950px;
}

.clear{
	clear: both;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/themes/dark-blue.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script src="js/graph.js" type="text/javascript"></script>
</head>

<body>

<script type="text/javascript">createGraph('employee');
//<script type="text/javascript">createGraph('top10');
</script>

<div class="bg">
	<div class="left">
		<div class="pie" id="employee" style=""></div>
		<p class=""><strong>You have run into an old sacred scroll.</strong> This scroll contains live information about the world's top scorers. Go on, play more, and reach the top.
		</p>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<div id="top10"></div>
	<h2>The Champions Den</h2>
	</div>
</div>
</body>
</html>
