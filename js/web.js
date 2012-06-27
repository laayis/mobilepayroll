function getweek(id){
	alert(id);
}

var rem='0';
function deleteframe(temp){
//alert('awd');
	rem = temp;
	var id = document.getElementById('getid').innerHTML;
	//alert(id);
	var x = temp + "_1";
	var time1 = document.getElementById(x).innerHTML;
	var x = temp + "_2";
	var time2 = document.getElementById(x).innerHTML;

	var n=time1.split(";"); 
	var nn=time2.split(";");
	var date_id = temp.split("_");
	var date = document.getElementById(date_id[1]).innerHTML;

	var sendget = date + " " + n[1] + " " + nn[1];
//	alert(sendget);
	//$.post("../pages/deleteframe.php", { id: id, date: temp, timei: n[1], timef: nn[1]},

	var check = confirm('Are you sure you want to delete this?');
	$.post("../deleteframe.php", { id: id, date: date, timei: n[1], timef: nn[1]},
	function(data){
		if(1){
//		alert('---');
		var temp = rem;
//		alert(temp);
			//remove
			var x = document.getElementById(temp);
			x.innerHTML = '&nbsp;';
			var time1 = document.getElementById(temp+'_1');
			time1.innerHTML = '&nbsp;';
			var time2 = document.getElementById(temp+'_2');
			time2.innerHTML = '&nbsp;';
			alert(data);
		}
	}
	);
}

function renew(temp){
	//alert(temp+'1');
	$.post("../renew.php", { totable_license: temp },
	function(data){
		//alert(data);
		window.location.reload();
	}
	);
}
