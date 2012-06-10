
		saveWarningText="app.saveWarningText";
   		 // Used in click() JS function
   		rightClickWarningText="right.click.disabled";
		// Used in canSpellCheckRun() JS function
		var spellCheckWarning = "app.spellCheckWarning";

    //setInterval("checkTimeout()", 60000); // 5 Minutes
  	setTimeout("checkTimeout()", 840000); // 14 Minutes
  	//setTimeout("checkTimeout()", 70000); // 14 Minutes
    
    //setInterval("checkTimeout()", 70000); // 10 seconds
  

	//disable back button functionality
    javascript:window.history.forward(1);

  
    
    function checkTimeout() { 
    
      newWindow = window.open('/ESSDD/dd/Timeout.do?', 'ESSDD', 'scrollbars=yes, resizable=yes, toolbar=0,menubar=0,width=400,height=400,left=25,top=25');
      newWindow.focus();
    }
  
     
     
     
     
      function confirmExit() {
		
		var form = us_bank_form;
		
		
		 if (  form.newFullABA.value != null && trim(form.newFullABA.value) != "" || 
          form.newFullAcct.value != null && trim(form.newFullAcct.value) != "" || 
          form.newPartABA.value != null && trim(form.newPartABA.value) != "" || 
          form.newPartAcct.value != null && trim(form.newPartAcct.value) != "" || 
          form.newPartAmt.value != null && trim(form.newPartAmt.value) != "" ||
          form.newFullTransitNumber.value != null && trim(form.newFullTransitNumber.value) != "" || 
    	  form.newFullBankCode.value != null && trim(form.newFullBankCode.value) != "" || 
          form.newCanFullAcct.value != null && trim(form.newCanFullAcct.value) != "" || 
          form.newPartTransitNumber.value != null && trim(form.newPartTransitNumber.value) != "" || 
          form.newPartTransitNumber.value != null && trim(form.newPartTransitNumber.value) != "" ||           
          form.newPartBankCode.value != null && trim(form.newPartBankCode.value) != "" || 
          form.newCanPartAmt.value != null && trim(form.newCanPartAmt.value) != "")
	     {
	      if (confirm('You have made changes to your information but have not selected the "Enroll/Update" button.  If you exit now, your changes will not be saved.'))
		   {
		      //form.action='/ESSDD/dd/exit.do';
		      return true;
		   }else{
		      return false;
		   }
	     }
	     else
	     {
		   return true;
		 } 
	   }
	   function confirmDepositCancel(form){
			  if (form.mandateFlag.value == "Y"){
			      if (confirm('Cancellation of your direct deposit will result in automatic enrollment in the Citi MasterCard Payroll Card Program.  If you receive a paper pay statement, please review it carefully to determine if it is a live check before discarding it. Please click "OK" to enroll, or click "Cancel" to undo cancellation.		'))
				  {
					   return true;
				  }else{
					   return false;
				  }
			  }
			return true;
	   }
	   
	   function confirmEpayEnroll(form) {
			
			if (  form.fullABA.value != null && trim(form.fullABA.value) != "" || 
	          form.fullAcct.value != null && trim(form.fullAcct.value) != ""  || 
	          form.payCardFlag.value == "X")
		    {
		      if (confirm('Enrollment in Citi Payroll Card will cause your Direct Deposit elections to be cancelled.  Please click "OK" to enroll, or click "Cancel" to undo enrollment'))
			  {
			   return true;
			  }else{
			   return false;
			  }
			}
			return true;
		  } 
  function confirmEpayCancel(form) {
			
	if (  form.payCardFlag.value == "5")
	    {
	      if (confirm('Enrollment in Citi Payroll Card will cause your Direct Deposit elections to be cancelled.  Please click "OK" to enroll, or click "Cancel" to undo enrollment'))
		  {
		   return true;
		  }else{
		   return false;
		  }
		}
		return true;
	  } 
			  
	  
    function changeObjectVisibility(objectId) {

    if(objectId == 'us_bank_div')
    {
      document.getElementById('canadian_bank_div').className= "hidden";
      document.getElementById('us_bank_div').className= "visible";
	}
	else
	{	
      document.getElementById('us_bank_div').className= "hidden";	
      document.getElementById('canadian_bank_div').className= "visible";
	}
}


function getObjectVisibility() {

	if(us_bank_form.lastBankRadioButtonPressed.value == "US")
	{
		document.getElementById('canadian_bank_div').className= "hidden";
	    document.getElementById('us_bank_div').className= "visible";
	    
	    document.getElementById('radio').checked= true;
	    document.getElementById('radio2').checked= false;
	}
	else if(us_bank_form.lastBankRadioButtonPressed.value == "CA")
	{
	      document.getElementById('us_bank_div').className= "hidden";	
	      document.getElementById('canadian_bank_div').className= "visible";
	      
	      document.getElementById('radio2').checked= true;
	      document.getElementById('radio').checked= false;
	
	}
	else
	{
	      document.getElementById('us_bank_div').className= "hidden";	
	      document.getElementById('canadian_bank_div').className= "hidden";
	      document.getElementById('radio').checked= false;
	      document.getElementById('radio2').checked= false;
	}

}

function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
} 

function checkForm(form)
{

 var nonDigit = /\D/g;


    if(document.getElementById('radio').checked)
    {

 
    //PRIMARY ACCOUNT VALIDATION
    
    //check if anything was entered on the US bank form
    if (  form.newFullABA.value != null && trim(form.newFullABA.value) != "" || 
          form.newFullAcct.value != null && trim(form.newFullAcct.value) != "" || 
          form.newPartABA.value != null && trim(form.newPartABA.value) != "" || 
          form.newPartAcct.value != null && trim(form.newPartAcct.value) != "" || 
          form.newPartAmt.value != null && trim(form.newPartAmt.value) != "")
	{

	    //if Routing Number or Account Number entered on primary account
	    //validate Primary Account Direct Deposit entries
		if (form.newFullABA.value != null && trim(form.newFullABA.value).length > 0 
			|| form.newFullAcct.value != null && trim(form.newFullAcct.value).length > 0)
		{
	
		  //check Routing Number, should be 9 digits, numberic, required field
		  if (form.newFullABA.value == "" 
		  		|| nonDigit.test(form.newFullABA.value) 
		  		|| form.newFullABA.value.length != 9 )
		  {
		   alert('Routing (ABA) Number must contain 9 numeric digits.  Please re-enter.');  
		   form.newFullABA.focus();
		   return false;
		  }

		  //check Account Number, required field  
		  //if (form.newFullAcct.value == null || trim(form.newFullAcct.value) == "" )
		  if (form.newFullAcct.value == "")
		  {
		   //form.newFullAcct.value = "";
		   alert('Please enter Account Number.');  
		   form.newFullAcct.focus();
		   
		   return false;
		  }
		  
  
		  //check if Account Type was selected
		  if (form.newFullCheckSav.value == "SB")
		  {
		   alert('Please select the Account Type.');
		   form.newFullCheckSav.focus();
		   return false;
		  }
		}  

	  	
	  	//SECONDARY ACCOUNT VALIDATION
	  	
	    //if Routing Number, Account Number or Flat Amount are entered on secondary account
	    //vaidate Secondary Account Direct Deposit entries
		if (form.newPartABA.value != null && form.newPartABA.value != "" ||
		    form.newPartAcct.value != null && form.newPartAcct.value != "" || 
		    form.newPartAmt.value != null && form.newPartAmt.value != "")
		{
	
  		  //check if Primary Account exists or is currently enrolling before enrolling into Secondary Account
  		  if ((form.fullABAForm.value == null || form.fullABAForm.value == "") && 
  		      (form.newFullABA.value == null || form.newFullABA.value == "") )
  		  {			  
		   alert('A Secondary Account is not allowed without a Primary Account.  Please set up Primary Account to continue.');
		   
		   //clear the fields
		   form.newPartABA.value = "";
		   form.newPartAcct.value = "";
		   form.newPartCheckSav.value = "SB";
		   form.newPartAmt.value = "";
		   
		   form.newFullABA.focus();
		   return false;
		  }

		  //check Routing Number, should be 9 digits, numberic, required field
		  //if ( (form.fullABA.value == null || form.newPartABA.value == "") 
		  if ( form.newPartABA.value == null 
		        || form.newPartABA.value == ""
		  		|| nonDigit.test(form.newPartABA.value) 
		  		|| form.newPartABA.value.length != 9 )
		  {	
		   alert('Routing (ABA) Number for secondary deposit account must contain 9 numeric digits.  Please re-enter.');
		   form.newPartABA.focus();
		   return false;
		  }		  
		  //check Account Number, required field
		  if (form.newPartAcct.value == "")
		  {
		   alert('Please enter Account Number for secondary deposit account.');
		   form.newPartAcct.focus();
		   return false;
		  }
		  //check if Account Type was selected
		  if (form.newPartCheckSav.value == "SB")
		  {
		   alert('Please select the Account Type for secondary deposit account.');
		   form.newPartCheckSav.focus();
		   return false;
		  }

	 	  //check Flat Amount, numeric, no decimal, required field
		  if (form.newPartAmt.value == "" || nonDigit.test(form.newPartAmt.value) )
		  {
		   alert('Flat Amount must contain a whole dollar amount without any decimals.');
		   form.newPartAmt.focus();
		   
		   return false;
		  }
		}
		

  	 }//no data was entered on US bank form and Enroll/Update button was pressed
  	 else
  	 {
   	    alert('No change has been entered. Please enter or update direct deposit information to continue.');
    	return false;
  	 }  	
  	}//US radio button pressed
  	 
	//CANADA radio button pressed   
  	if(document.getElementById('radio2').checked)
    { 
    //PRIMARY ACCOUNT VALIDATION
    
/*
newFullTransitNumber
newFullBankCode = "";
newPartTransitNumber = "";
newPartBankCode = "";
newCanFullAcct = "";
newCanFullCheckSav = "";
newCanPartCheckSav = "";
newCanPartAmt = "";
*/    
    //check if anything was entered on the US bank form
    if (  form.newFullTransitNumber.value != null && trim(form.newFullTransitNumber.value) != "" || 
    	  form.newFullBankCode.value != null && trim(form.newFullBankCode.value) != "" || 
          form.newCanFullAcct.value != null && trim(form.newCanFullAcct.value) != "" || 
          form.newPartTransitNumber.value != null && trim(form.newPartTransitNumber.value) != "" || 
          form.newPartTransitNumber.value != null && trim(form.newPartTransitNumber.value) != "" ||           
          form.newPartBankCode.value != null && trim(form.newPartBankCode.value) != "" || 
          form.newCanPartAmt.value != null && trim(form.newCanPartAmt.value) != "")
          
	{

	    //if Transit number, Bank Code or Account Number entered on primary account
	    //validate Primary Account Transit Number entries
		if (form.newFullTransitNumber.value != null && trim(form.newFullTransitNumber.value).length > 0 
			|| form.newFullBankCode.value != null && trim(form.newFullBankCode.value).length > 0
			|| form.newCanFullAcct.value != null && trim(form.newCanFullAcct.value).length > 0)
		{
	
		  //check Transit Number, should be 5 digits, numberic, required field]
		  //message: Transit Number must contain 5 numeric digits.  Please re-enter.
		  if (form.newFullTransitNumber.value == "" 
		  		|| nonDigit.test(form.newFullTransitNumber.value) 
		  		|| form.newFullTransitNumber.value.length != 5 )
		  {
		   alert('Transit Number must contain 5 numeric digits.  Please re-enter.');  
		   form.newFullTransitNumber.focus();
		   return false;
		  }
		  
		  //check Bank Code, should be 3 digits, numberic, required field]
		  //message: Bank Code must contain 3 numeric digits.  Please re-enter.
		  if (form.newFullBankCode.value == "" 
		  		|| nonDigit.test(form.newFullBankCode.value) 
		  		|| form.newFullBankCode.value.length != 3 )
		  {
		   alert('Bank Code must contain 3 numeric digits.  Please re-enter.');  
		   form.newFullBankCode.focus();
		   return false;
		  }

		  //check Account Number, required field  
		  //if (form.newFullAcct.value == null || trim(form.newFullAcct.value) == "" )
		  if (form.newCanFullAcct.value == "")
		  {
		   //form.newFullAcct.value = "";
		   alert('Please enter Account Number.');  
		   form.newCanFullAcct.focus();
		   
		   return false;
		  }
		    
		  //check if Account Type was selected
		  if (form.newCanFullCheckSav.value == "SB")
		  {
		   alert('Please select the Account Type.');
		   form.newCanFullCheckSav.focus();
		   return false;
		  }
		}  

/*
newPartTransitNumber = "";
newPartBankCode = "";
newCanPartCheckSav = "";
newCanPartAmt = "";
newCanPartAcct
*/	  	
	  	//SECONDARY ACCOUNT VALIDATION
	    //if Routing Number, Account Number or Flat Amount are entered on secondary account
	    //vaidate Secondary Account Direct Deposit entries
		if (form.newPartTransitNumber.value != null && form.newPartTransitNumber.value != "" ||
		    form.newPartBankCode.value != null && form.newPartBankCode.value != "" || 
		    form.newCanPartAcct.value != null && form.newCanPartAcct.value != "" || 
		    form.newCanPartAmt.value != null && form.newCanPartAmt.value != "")
		{
	
  		  //check if Primary Account exists or is currently enrolling before enrolling into Secondary Account
  		  if (("00277" == null || "00277" == "") && 
  		      (form.newFullTransitNumber.value == null || form.newFullTransitNumber.value == "") )
  		  {			  
		  
		   alert('A Secondary Account is not allowed without a Primary Account.  Please set up Primary Account to continue.');
		   
		   //clear the fields
		   form.newPartTransitNumber.value = "";
		   form.newPartBankCode.value = "";		   
		   form.newCanPartAcct.value = "";
		   form.newCanPartCheckSav.value = "SB";
		   form.newCanPartAmt.value = "";
		   
		   form.newFullTransitNumber.focus();
		   return false;
		  }

		  //check TransitNumber, should be 5 digits, numberic, required field
		  if ( form.newPartTransitNumber.value == null 
		        || form.newPartTransitNumber.value == ""
		  		|| nonDigit.test(form.newPartTransitNumber.value) 
		  		|| form.newPartTransitNumber.value.length != 5 )
		  {	
		   alert('Transit Number must contain 5 numeric digits for secondary deposit account.  Please re-enter.');
		   form.newPartTransitNumber.focus();
		   return false;
		  }		  
		  
		  //check Bank Code, should be 3 digits, numberic, required field
		  if ( form.newPartBankCode.value == null 
		        || form.newPartBankCode.value == ""
		  		|| nonDigit.test(form.newPartBankCode.value) 
		  		|| form.newPartBankCode.value.length != 3 )
		  {	
		   alert('Bank Code must contain 3 numeric digits for secondary deposit account.  Please re-enter.');
		   form.newPartBankCode.focus();
		   return false;
		  }	
		  
		  //check Account Number, required field
		  if (form.newCanPartAcct.value == "")
		  {
		   alert('Please enter Account Number for secondary deposit account.');
		   form.newCanPartAcct.focus();
		   return false;
		  }
		  
		  //check if Account Type was selected
		  if (form.newCanPartCheckSav.value == "SB")
		  {
		   alert('Please select the Account Type for secondary deposit account.');
		   form.newCanPartCheckSav.focus();
		   return false;
		  }

	 	  //check Flat Amount, numeric, no decimal, required field
		  if (form.newCanPartAmt.value == "" || nonDigit.test(form.newCanPartAmt.value) )
		  {
		   alert('Flat Amount must contain a whole dollar amount without any decimals.');
		   form.newCanPartAmt.focus();
		   
		   return false;
		  }
		}
		

  	 }//no data was entered on US bank form and Enroll/Update button was pressed
  	 else
  	 {
   	    alert('No change has been entered. Please enter or update direct deposit information to continue.');
    	return false;
  	 }  	
  	}//CANADA radio button pressed
  	
  	
  return true;
	
} //checkForm

function disableButtons(theform) 
{
	if (document.all || document.getElementById) 
	{
		for (i = 0; i < theform.length; i++) 
		{
		    
			var tempobj = theform.elements[i];
			if (tempobj.type.toLowerCase() == "submit")
			{
			 //tempobj.value = "Processing...";
			 tempobj.value = 'Processing...'
			 tempobj.disabled = "true";
			}
		}		
		theform.submit();
	}
}
