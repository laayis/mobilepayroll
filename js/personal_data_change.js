// timeout functionality
setTimeout("checkTimeout()", 840000); // 14 Minutes

function checkTimeout() { 
	newWindow = window.open('/EssPersonal/timeout.do', 'EssPersonal', 
		'scrollbars=yes,resizable=yes,toolbar=0,menubar=0,width=400,height=400,left=25,top=25');
	newWindow.focus();
}



function deleteConfirmation(){
	var sphone_bean = ""+
					  ""+
					  "";
	var	sphone_form = document.getElementById('secondaryPhone1').value+
					  document.getElementById('secondaryPhone2').value+
					  document.getElementById('secondaryPhone3').value;
	
	if ( (trim(sphone_bean) != "") & (trim(sphone_form) == "") ){
		var agree = confirm('Do you want to delete the Secondary phone?');
		if (agree == false){
			document.getElementById('secondaryPhone1').value = "";
			document.getElementById('secondaryPhone2').value = "";
			document.getElementById('secondaryPhone3').value = "";
			document.personalDataForm.secondaryPhone1.focus();
			return (false);
		}
	} 
	
	var pemail_bean = "";
	var	pemail_form = document.getElementById('personalEmail').value;
	if ( (trim(pemail_bean) != "") & (trim(pemail_form) == "") ){
		var agree = confirm('Do you want to delete the Personal E-mail address?');
		if (agree == false){
			document.getElementById('personalEmail').value = "";
			document.personalDataForm.personalEmail.focus();
			return (false);
		}
	} 
	
	var ecphone2_bean = ""+
					    ""+
					    "";
	var	ecphone2_form = document.getElementById('emeECPhone2Part1').value+
					    document.getElementById('emeECPhone2Part2').value+
					    document.getElementById('emeECPhone2Part3').value;
	
	if ( (trim(ecphone2_bean) != "") & (trim(ecphone2_form) == "") ){
		var agree = confirm('Do you want to delete the Emergency Contact phone2?');
		if (agree == false){
			document.getElementById('emeECPhone2Part1').value = "";
			document.getElementById('emeECPhone2Part2').value = "";
			document.getElementById('emeECPhone2Part3').value = "";
			document.personalDataForm.emeECPhone2Part1.focus();
			return (false);
		}
	} 
	
	var scname_bean = "";
	var	scname_form = document.getElementById('emeSCName').value;
	if ( (trim(scname_bean) != "") & (trim(scname_form) == "") ){
		var agree = confirm('Do you want to delete the Secondary Contact name?');
		if (agree == false){
			document.getElementById('emeSCName').value = "";
			document.personalDataForm.emeSCName.focus();
			return (false);
		}
	} 
	
	
	
	var scphone1_bean = ""+
					    ""+
					    "";
	var	scphone1_form = document.getElementById('emeSCPhone1Part1').value+
					    document.getElementById('emeSCPhone1Part2').value+
					    document.getElementById('emeSCPhone1Part3').value;
	
	if ( (trim(scphone1_bean) != "") & (trim(scphone1_form) == "") ){
		var agree = confirm('Do you want to delete the Secondary Contact phone1?');
		if (agree == false){
			document.getElementById('emeSCPhone1Part1').value = "";
			document.getElementById('emeSCPhone1Part2').value = "";
			document.getElementById('emeSCPhone1Part3').value = "";
			document.personalDataForm.emeSCPhone1Part1.focus();
			return (false);
		}
	} 
	
	var scphone2_bean = ""+
					    ""+
					    "";
	var	scphone2_form = document.getElementById('emeSCPhone2Part1').value+
					    document.getElementById('emeSCPhone2Part2').value+
					    document.getElementById('emeSCPhone2Part3').value;
	
	if ( (trim(scphone2_bean) != "") & (trim(scphone2_form) == "") ){
		var agree = confirm('Do you want to delete the Secondary Contact phone2?');
		if (agree == false){
			document.getElementById('emeSCPhone2Part1').value = "";
			document.getElementById('emeSCPhone2Part2').value = "";
			document.getElementById('emeSCPhone2Part3').value = "";
			document.personalDataForm.emeSCPhone2Part1.focus();
			return (false);
		}
	} 
	
	
	var ocname_bean = "";
	var	ocname_form = document.getElementById('emeOCName').value;
	if ( (trim(ocname_bean) != "") & (trim(ocname_form) == "") ){
		var agree = confirm('Do you want to delete the Other Contact name?');
		if (agree == false){
			document.getElementById('emeOCName').value = "";
			document.personalDataForm.emeOCName.focus();
			return (false);
		}
	} 
	
	var ocphone1_bean = ""+
					    ""+
					    "";
	var	ocphone1_form = document.getElementById('emeOCPhone1Part1').value+
					    document.getElementById('emeOCPhone1Part2').value+
					    document.getElementById('emeOCPhone1Part3').value;
	
	if ( (trim(ocphone1_bean) != "") & (trim(ocphone1_form) == "") ){
		var agree = confirm('Do you want to delete the Other Contact phone1?');
		if (agree == false){
			document.getElementById('emeOCPhone1Part1').value = "";
			document.getElementById('emeOCPhone1Part2').value = "";
			document.getElementById('emeOCPhone1Part3').value = "";
			document.personalDataForm.emeOCPhone1Part1.focus();
			return (false);
		}
	} 	
	
	var ocphone2_bean = ""+
					    ""+
					    "";
	var	ocphone2_form = document.getElementById('emeOCPhone2Part1').value+
					    document.getElementById('emeOCPhone2Part2').value+
					    document.getElementById('emeOCPhone2Part3').value;
	
	if ( (trim(ocphone2_bean) != "") & (trim(ocphone2_form) == "") ){
		var agree = confirm('Do you want to delete the Other Contact phone2?');
		if (agree == false){
			document.getElementById('emeOCPhone2Part1').value = "";
			document.getElementById('emeOCPhone2Part2').value = "";
			document.getElementById('emeOCPhone2Part3').value = "";
			document.personalDataForm.emeOCPhone2Part1.focus();
			return (false);
		}
	} 
	
	document.personalDataForm.submit();
	document.getElementById('sub').value = 'processing';
	document.getElementById('sub').disabled = true;
}

function editAccess(){

	
	var addressFlag = "N";
	var nameFlag = "N";
	enableOrDisableCheckBoxes();
	if(addressFlag == "Y" || addressFlag == "y" )
	
	{
			document.getElementById('address1').readOnly = true;
		  	document.getElementById('address2').readOnly = true;
		  	document.getElementById('city').readOnly = true;
			document.getElementById('zipCode').readOnly = true;
			document.getElementById('primaryPhone1').readOnly = true;
		  	document.getElementById('primaryPhone2').readOnly = true;
		  	document.getElementById('primaryPhone3').readOnly = true;
			document.getElementById('secondaryPhone1').readOnly = true;
			document.getElementById('secondaryPhone2').readOnly = true;
			document.getElementById('secondaryPhone3').readOnly = true;
			document.getElementById('personalEmail').readOnly = true;
			
			var sels = document.personalDataForm.state;
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "FL" ){
					sels.remove(i);
					i--;
				}
			}
			
			document.getElementById('address1').className= "DisabledFields";
		  	document.getElementById('address2').className= "DisabledFields";
		  	document.getElementById('city').className= "DisabledFields";
			document.getElementById('state').className= "DisabledFields";
			document.getElementById('zipCode').className= "DisabledFields";
			document.getElementById('primaryPhone1').className= "DisabledFields";
		  	document.getElementById('primaryPhone2').className= "DisabledFields";
		  	document.getElementById('primaryPhone3').className= "DisabledFields";
			document.getElementById('secondaryPhone1').className= "DisabledFields";
			document.getElementById('secondaryPhone2').className= "DisabledFields";
			document.getElementById('secondaryPhone3').className= "DisabledFields";
			document.getElementById('personalEmail').className= "DisabledFields";
	}
	
	if(nameFlag == "Y" || nameFlag == "y")
	{
			document.getElementById('fname').readOnly = true;
		  	document.getElementById('mname').readOnly = true;
		  	document.getElementById('lname').readOnly = true;
	  		
			var sels = document.personalDataForm.race;
			if(sels!=null)
			{
				for(i=0;i<sels.length;i++){
					if (sels.options[i].value != "A" ){
						sels.remove(i);
						i--;
					}
				}
			}
			
			var sels = document.personalDataForm.gender;
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "M" ){
					sels.remove(i);
					i--;
				}
			}
			
			var sels = document.personalDataForm.milStatus;
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "1" ){
					sels.remove(i);
					i--;
				}
			}
			
			var sels = document.personalDataForm.disVeteran;
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
			
			var sels = document.personalDataForm.suffix;
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
			
			document.getElementById('fname').className= "DisabledFields";
		  	document.getElementById('mname').className= "DisabledFields";
		  	document.getElementById('lname').className= "DisabledFields";
	  		document.getElementById('suffix').className= "DisabledFields";

	  		if(document.getElementById('gender')!=null)
	  			document.getElementById('gender').className= "DisabledFields";
	  		if(document.getElementById('milStatus')!=null)
		  		document.getElementById('milStatus').className= "DisabledFields";
	  		if(document.getElementById('disVeteran')!=null)
		  		document.getElementById('disVeteran').className= "DisabledFields";
	  		if(document.getElementById('race')!=null)
	  			document.getElementById('race').className= "DisabledFields";
	  		
	}

	var status ="A";
	document.getElementById('nameNote').style.display='none'; 
	document.getElementById('adrNote').style.display='none';
	
	  if(status == "T") {
	  	document.getElementById('fname').readOnly = true;
	  	document.getElementById('mname').readOnly = true;
	  	document.getElementById('lname').readOnly = true;
	  	document.getElementById('primaryPhone1').readOnly = true;
	  	document.getElementById('primaryPhone2').readOnly = true;
	  	document.getElementById('primaryPhone3').readOnly = true;
		document.getElementById('secondaryPhone1').readOnly = true;
		document.getElementById('secondaryPhone2').readOnly = true;
		document.getElementById('secondaryPhone3').readOnly = true;
		document.getElementById('personalEmail').readOnly = true;
		document.getElementById('emeECName').readOnly = true;
		document.getElementById('emeECPhone1Part1').readOnly = true;
		document.getElementById('emeECPhone1Part2').readOnly = true;
		document.getElementById('emeECPhone1Part3').readOnly = true;
		document.getElementById('emeECPhone2Part1').readOnly = true;
		document.getElementById('emeECPhone2Part2').readOnly = true;
		document.getElementById('emeECPhone2Part3').readOnly = true;
		document.getElementById('emeSCName').readOnly = true;
		document.getElementById('emeSCPhone1Part1').readOnly = true;
		document.getElementById('emeSCPhone1Part2').readOnly = true;
		document.getElementById('emeSCPhone1Part3').readOnly = true;
		document.getElementById('emeSCPhone2Part1').readOnly = true;
		document.getElementById('emeSCPhone2Part2').readOnly = true;
		document.getElementById('emeSCPhone2Part3').readOnly = true;
		document.getElementById('emeOCName').readOnly = true;
		document.getElementById('emeOCPhone1Part1').readOnly = true;
		document.getElementById('emeOCPhone1Part2').readOnly = true;
		document.getElementById('emeOCPhone1Part3').readOnly = true;
		document.getElementById('emeOCPhone2Part1').readOnly = true;
		document.getElementById('emeOCPhone2Part2').readOnly = true;
		document.getElementById('emeOCPhone2Part3').readOnly = true;
		
		document.getElementById('fname').className= "DisabledFields";
	  	document.getElementById('mname').className= "DisabledFields";
	  	document.getElementById('lname').className= "DisabledFields";
	  	document.getElementById('primaryPhone1').className= "DisabledFields";
	  	document.getElementById('primaryPhone2').className= "DisabledFields";
	  	document.getElementById('primaryPhone3').className= "DisabledFields";
		document.getElementById('secondaryPhone1').className= "DisabledFields";
		document.getElementById('secondaryPhone2').className= "DisabledFields";
		document.getElementById('secondaryPhone3').className= "DisabledFields";
		document.getElementById('personalEmail').className= "DisabledFields";
		document.getElementById('emeECName').className= "DisabledFields";
		document.getElementById('emeECPhone1Part1').className= "DisabledFields";
		document.getElementById('emeECPhone1Part2').className= "DisabledFields";
		document.getElementById('emeECPhone1Part3').className= "DisabledFields";
		document.getElementById('emeECPhone2Part1').className= "DisabledFields";
		document.getElementById('emeECPhone2Part2').className= "DisabledFields";
		document.getElementById('emeECPhone2Part3').className= "DisabledFields";
		document.getElementById('emeSCName').className= "DisabledFields";
		document.getElementById('emeSCPhone1Part1').className= "DisabledFields";
		document.getElementById('emeSCPhone1Part2').className= "DisabledFields";
		document.getElementById('emeSCPhone1Part3').className= "DisabledFields";
		document.getElementById('emeSCPhone2Part1').className= "DisabledFields";
		document.getElementById('emeSCPhone2Part2').className= "DisabledFields";
		document.getElementById('emeSCPhone2Part3').className= "DisabledFields";
		document.getElementById('emeOCName').className= "DisabledFields";
		document.getElementById('emeOCPhone1Part1').className= "DisabledFields";
		document.getElementById('emeOCPhone1Part2').className= "DisabledFields";
		document.getElementById('emeOCPhone1Part3').className= "DisabledFields";
		document.getElementById('emeOCPhone2Part1').className= "DisabledFields";
		document.getElementById('emeOCPhone2Part2').className= "DisabledFields";
		document.getElementById('emeOCPhone2Part3').className= "DisabledFields";


		var sels = document.personalDataForm.race;

		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "A" ){
					sels.remove(i);
					i--;
				}
			}
		}

		
		var sels = document.personalDataForm.ethnicOrig;

		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
		}

		var sels = document.personalDataForm.caMilitary;

		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
		}

		var sels = document.personalDataForm.immigration18mos;

		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
		}

		var sels = document.personalDataForm.studentStat;

		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
		}
				
   	 var sels = document.personalDataForm.gender;
		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "M" ){
					sels.remove(i);
					i--;
				}
			}
		}
		
		var sels = document.personalDataForm.milStatus;
		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "1" ){
					sels.remove(i);
					i--;
				}
			}
		}

		
		
		var sels = document.personalDataForm.disVeteran;
		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
		}
		
		var sels = document.personalDataForm.suffix;
		if(sels!=null)
		{
			for(i=0;i<sels.length;i++){
				if (sels.options[i].value != "" ){
					sels.remove(i);
					i--;
				}
			}
		}


		if(document.getElementById('suffix')!=null)
			document.getElementById('suffix').className= "DisabledFields";
		if(document.getElementById('gender')!=null)
  			document.getElementById('gender').className= "DisabledFields";
  		if(document.getElementById('milStatus')!=null)
	  		document.getElementById('milStatus').className= "DisabledFields";
  		if(document.getElementById('disVeteran')!=null)
	  		document.getElementById('disVeteran').className= "DisabledFields";
  		if(document.getElementById('race')!=null)
  			document.getElementById('race').className= "DisabledFields";

  		if(document.getElementById('ethnicOrig')!=null)
  			document.getElementById('ethnicOrig').className= "DisabledFields";
  		if(document.getElementById('caMilitary')!=null)
  			document.getElementById('caMilitary').className= "DisabledFields";
  		if(document.getElementById('immigration18mos')!=null)
  			document.getElementById('immigration18mos').className= "DisabledFields";	
  		if(document.getElementById('studentStat')!=null)
  			document.getElementById('studentStat').className= "DisabledFields";				
		


  		if(document.personalDataForm.langSel!=null)
  		{
	  		for(i=0;i<document.personalDataForm.langSel.length; i++){
				document.personalDataForm.langSel[i].disabled = true;
				document.personalDataForm.langSel[i].className= "DisabledFields";
			}
  		}

  		if(document.personalDataForm.minorityInd!=null)
  		{
  			document.personalDataForm.minorityInd.disabled = true;
  			document.personalDataForm.minorityInd.className= "DisabledFields";			
  		}

  		if(document.personalDataForm.aborigInd!=null)
  		{
  			document.personalDataForm.aborigInd.disabled = true;
  			document.personalDataForm.aborigInd.className= "DisabledFields";			
  		}

  		if(document.personalDataForm.caDisabInd!=null)
  		{
  			document.personalDataForm.caDisabInd.disabled = true;
  			document.personalDataForm.caDisabInd.className= "DisabledFields";			
  		}

  		if(document.personalDataForm.sexPrefInd!=null)
  		{
  			document.personalDataForm.sexPrefInd.disabled = true;
  			document.personalDataForm.sexPrefInd.className= "DisabledFields";			
  		}  		  		

	}


}


function displayNameNote(){
	document.getElementById('nameNote').style.display='block';
}

function hideNameNote(){
	document.getElementById('nameNote').style.display='none';
}

function displayAdrNote(){
	document.getElementById('adrNote').style.display='block';
}

function hideAdrNote(){
	document.getElementById('adrNote').style.display='none';
}

function trim(str){
var trimmed = str.replace(/^\s+|\s+$/g,'') ;
return trimmed;
}

function enableOrDisableCheckBoxes(){
	var checkBoxes = document.personalDataForm.langSel;
	var selCount = 0;
	for (i=0; i<checkBoxes.length; i++){
		if (checkBoxes[i].checked == true) {
			selCount++;
		}
	}
	
	if (selCount >= 4){
		for(i=0;i<checkBoxes.length; i++){
			if (checkBoxes[i].checked == false) {
				checkBoxes[i].disabled = true;
			}	
		}
	}
	else {
		for(i=0;i<checkBoxes.length; i++){
			checkBoxes[i].disabled = false;	
		}
	}
}

function confirmExit(){
	
	if ("com.homedepot.ess.personal.form.personalDataForm@e05d6f" == null){
		return true;
	}

	
/*	
	if ((trim(document.getElementById('fname').value)  			!= "WINICIUS"))  { alert ("2");};
	if ((trim(document.getElementById('mname').value)  			!= ""))  { alert ("3");};
	if ((trim(document.getElementById('lname').value) 			!= "SIQUEIRA"))  { alert ("4");};
	if ((trim(document.getElementsByName('suffix')[0].value)		!= ""))  { alert ("5");};
	if ((trim(document.getElementById('address1').value)  		!= "200 177TH DR."))  { alert ("6");};
	if ((trim(document.getElementById('address2').value)  		!= "303"))  { alert ("7");};
	if ((trim(document.getElementById('city').value)  			!= "SUNNY ISLES"))  { alert ("8");};
	if ((trim(document.getElementsByName('state')[0].value) 		!= "FL"))  { alert ("9");};
	if ((trim(document.getElementById('zipCode').value)  		!= "33160"))  { alert ("10");};
	if ((trim(document.getElementById('primaryPhone1').value) 	!= "786"))  { alert ("11");};
	if ((trim(document.getElementById('primaryPhone2').value) 	!= "488"))  { alert ("12");};
	if ((trim(document.getElementById('primaryPhone3').value)  	!= "5097"))  { alert ("13");};
	if ((trim(document.getElementById('secondaryPhone1').value)  != ""))  { alert ("14");};
	if ((trim(document.getElementById('secondaryPhone2').value)  != ""))  { alert ("15");};
	if ((trim(document.getElementById('secondaryPhone3').value)  != ""))  { alert ("16");};
	if ((trim(document.getElementById('personalEmail').value)  	!= ""))  { alert ("17");};
	if ((trim(document.getElementById('emeECName').value)  		!= ""))  { alert ("18");};
	if ((trim(document.getElementById('emeECPhone1Part1').value) != ""))  { alert ("19");};
	if ((trim(document.getElementById('emeECPhone1Part2').value) != ""))  { alert ("20");};
	if ((trim(document.getElementById('emeECPhone1Part3').value) != ""))  { alert ("21");};
	if ((trim(document.getElementById('emeECPhone2Part1').value) != ""))  { alert ("22");};
	if ((trim(document.getElementById('emeECPhone2Part2').value) != ""))  { alert ("23");};
	if ((trim(document.getElementById('emeECPhone2Part3').value) != ""))  { alert ("24");};
	if ((trim(document.getElementById('emeSCName').value)  		!= ""))  { alert ("25");};
	if ((trim(document.getElementById('emeSCPhone1Part1').value) != ""))  { alert ("26");};
	if ((trim(document.getElementById('emeSCPhone1Part2').value) != ""))  { alert ("27");};
	if ((trim(document.getElementById('emeSCPhone1Part3').value) != ""))  { alert ("28");};
	if ((trim(document.getElementById('emeSCPhone2Part1').value) != ""))  { alert ("29");};
	if ((trim(document.getElementById('emeSCPhone2Part2').value) != ""))  { alert ("30");};
	if ((trim(document.getElementById('emeSCPhone2Part3').value) != ""))  { alert ("31");};
	if ((trim(document.getElementById('emeOCName').value)  		!= ""))  { alert ("32");};
	if ((trim(document.getElementById('emeOCPhone1Part1').value) != ""))  { alert ("33");};
	if ((trim(document.getElementById('emeOCPhone1Part2').value) != ""))  { alert ("34");};
	if ((trim(document.getElementById('emeOCPhone1Part3').value) != ""))  { alert ("36");};
	if ((trim(document.getElementById('emeOCPhone2Part1').value) != ""))  { alert ("37");};
	if ((trim(document.getElementById('emeOCPhone2Part2').value) != ""))  { alert ("38");};
	if ((trim(document.getElementById('emeOCPhone2Part3').value) != ""))  { alert ("39");};
	if ((trim(document.getElementsByName('gender')[0].value) 		!= trim("M"))) { alert ("43");};
*/		 
	if ((trim(document.getElementById('fname').value)  			== "WINICIUS")  &
		(trim(document.getElementById('mname').value)  			== "")  &
		(trim(document.getElementById('lname').value) 			== "SIQUEIRA")  &
		(trim(document.getElementsByName('suffix')[0].value)		== "")  &
		(trim(document.getElementById('address1').value)  		== "200 177TH DR.")  &
		(trim(document.getElementById('address2').value)  		== "303")  &
		(trim(document.getElementById('city').value)  			== "SUNNY ISLES")  &
		(trim(document.getElementsByName('state')[0].value) 		== "FL")  &
		(trim(document.getElementById('zipCode').value)  		== "33160")  &
		(trim(document.getElementById('primaryPhone1').value) 	== "786")  &
		(trim(document.getElementById('primaryPhone2').value) 	== "488")  &
		(trim(document.getElementById('primaryPhone3').value)  	== "5097")  &
		(trim(document.getElementById('secondaryPhone1').value)  == "")  &
		(trim(document.getElementById('secondaryPhone2').value)  == "")  &
		(trim(document.getElementById('secondaryPhone3').value)  == "")  &
		(trim(document.getElementById('personalEmail').value)  	== "")  &
		(trim(document.getElementById('emeECName').value)  		== "")  &
		(trim(document.getElementById('emeECPhone1Part1').value) == "")  &
		(trim(document.getElementById('emeECPhone1Part2').value) == "")  &
		(trim(document.getElementById('emeECPhone1Part3').value) == "")  &
		(trim(document.getElementById('emeECPhone2Part1').value) == "")  &
		(trim(document.getElementById('emeECPhone2Part2').value) == "")  &
		(trim(document.getElementById('emeECPhone2Part3').value) == "")  &
		(trim(document.getElementById('emeSCName').value)  		== "")  &
		(trim(document.getElementById('emeSCPhone1Part1').value) == "")  &
		(trim(document.getElementById('emeSCPhone1Part2').value) == "")  &
		(trim(document.getElementById('emeSCPhone1Part3').value) == "")  &
		(trim(document.getElementById('emeSCPhone2Part1').value) == "")  &
		(trim(document.getElementById('emeSCPhone2Part2').value) == "")  &
		(trim(document.getElementById('emeSCPhone2Part3').value) == "")  &
		(trim(document.getElementById('emeOCName').value)  		== "")  &
		(trim(document.getElementById('emeOCPhone1Part1').value) == "")  &
		(trim(document.getElementById('emeOCPhone1Part2').value) == "")  &
		(trim(document.getElementById('emeOCPhone1Part3').value) == "")  &
		(trim(document.getElementById('emeOCPhone2Part1').value) == "")  &
		(trim(document.getElementById('emeOCPhone2Part2').value) == "")  &
		(trim(document.getElementById('emeOCPhone2Part3').value) == "")  &
		(trim(document.getElementsByName('gender')[0].value) 		== trim("M")) &
		checkUsFields()  &
		checkCaFields()  &
		langSelMatch() ){
			return true;
		}
		else {
			var agree =	confirm("You have made changes to your information but have not selected Submit button. If you exit now, your changes will be lost");
	 		if (agree){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
		}
		doExit(document.forms[0],'/EssPersonal/exit.do');
}

function langSelMatch(){
	orgLang = new Array();
	i=0;
	
		orgLang[i] = "EN";
		i = i + 1;
	
		orgLang[i] = "ES";
		i = i + 1;
	
		orgLang[i] = "PT";
		i = i + 1;
	
	orgLangStr = orgLang.sort().join();
	
	newLang = new Array();
	j=0;
	for (i =0; i<document.personalDataForm.langSel.length; i++){
		if (document.personalDataForm.langSel[i].checked == true){
			newLang[j]= document.personalDataForm.langSel[i].value;
			j= j + 1; 
		}
	}
	newLangStr = newLang.sort().join();

	if (orgLangStr == newLangStr){
		return true;
	}
	else {
		return false;
	}
}
function checkUsFields(){
	    if ("US" != 'US') return true;
	    
		if ((trim(document.getElementsByName('milStatus')[0].value) 	== trim("1"))  &
			(trim(document.getElementsByName('disVeteran')[0].value)	== trim(""))  &
			(trim(document.getElementsByName('race')[0].value)  		== trim("A"))){
			return true;
		}
	return false;
}

function checkCaFields(){
		if ("US" != 'CA') return true;

		if (
			((trim(document.getElementsByName('caMilitary')[0].value) == "NO" ) && (trim("")=="") ) ||
		  	 (trim(document.getElementsByName('caMilitary')[0].value)  == trim("") )&
		  	 
			(trim(document.getElementsByName('ethnicOrig')[0].value) 	== trim(""))  &

		  	(
			 ((document.getElementsByName('minorityInd')[0].checked == true) &&  (trim("")=="Y" )) ||
			 ((document.getElementsByName('minorityInd')[0].checked == false) &&  ((trim("")=="") || trim("")=="N" ))
			) &	
			
		  	(
			 ((document.getElementsByName('aborigInd')[0].checked == true) &&  (trim("")=="Y" )) ||
			 ((document.getElementsByName('aborigInd')[0].checked == false) &&  ((trim("")=="") || trim("")=="N" ))
			) &		  	 


		   (
			 ((document.getElementsByName('caDisabInd')[0].checked == true) &&  (trim("")=="Y" )) ||
			 ((document.getElementsByName('caDisabInd')[0].checked == false) &&  ((trim("")=="") || trim("")=="N" ))
			) &	

			(
			 ((document.getElementsByName('sexPrefInd')[0].checked == true) &&  (trim("")=="Y" )) ||
			 ((document.getElementsByName('sexPrefInd')[0].checked == false) &&  ((trim("")=="") || trim("")=="N" ))
			) &				
						
			(trim(document.getElementsByName('immigration18mos')[0].value) 	== trim(""))  &
			(trim(document.getElementsByName('studentStat')[0].value) 	== trim(""))){
			return true;
		}

	return false;
	
}
