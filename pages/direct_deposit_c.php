<script type="text/javascript" src="/js/directdeposit.js"></script>

<h1>ESS Direct Deposit Form</h1>
<hr />

<table  border="0" cellpadding="3" cellspacing="0" >   
	<tr> 
		<td class="small"> Name:
			<strong>
			 WINICIUS &nbsp;
			 SIQUEIRA    						
			</strong>
		</td> 
		<td class="small" align="left"> &nbsp;&nbsp;Associate ID:
				<strong>
				 115838849                		
				</strong>
		</td> 
	</tr>
</table>
<form action="/ESSDD/dd/DirectDepositUpdate.do" method="post" name="us_bank_form" target="_self" id="dd" >
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="0" >
	<tr> 
		<td> 
			<p class="small"> Only electronic pay options are available to associates working in your state.</p>
			<p class="small">&nbsp; </p>
			<p class="small"> The Home Depot offers you two ways to receive your pay electronically. The preferred option, direct deposit, is the safest, fastest and most convenient way to get paid. The second option is the payroll card, a great alternative provided by Citi for associates who do not have a bank account. Both electronic pay options offer you peace of mind that you will get paid on-time, every time, regardless of natural disasters or check delivery delays.</p>
		</td> 
	</tr>
</table>
<br>
<table width="90%" border="0" cellpadding="3" cellspacing="0" align="center">
	<tr> 
		<td> 
			<p class="small"> (Note: For U.S. Associates only) Printed Paper Pay Statements: To view your pay statement options please click on the View Pay Statements link located on the top left hand corner of this screen.  </p>
		</td>
	</tr>
</table>
<br>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="areabox" >
	<tr>
	  <td><table width="100%" border="0" cellpadding="3" cellspacing="0" >
		  <tr> 
			<td class="heading1">Direct Deposit</td>
		  </tr>
		  <tr>
			<td>
			  <br> 
				<p class="small">You must establish a bank account if you do not already have one. Several banks offer incentives when you open a new account using direct deposit. Contact your bank for more information. </p>
				<p class="small">Please allow up to 2 weeks for your new or updated direct deposit account information to take effect. If you receive a paper pay statement, please review it carefully to determine if it is a live check before discarding it.  If you are changing accounts for direct deposit, please do not cancel your former account until you verify that your pay is being deposited into your new account. </p>
			  <br>
			 </td>
		  </tr>
		</table>
		<input name="lastBankRadioButtonPressed" type="hidden" id="rdButtonId" value="">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="textbox">
		  <tr>
			<td align="center" width="50%" class="normal"><strong>Select the Country of Your Bank to continue:</strong></td>
			<td  align="left" width="50%" class="small">
			 U.S. Bank <input type="radio" name="banksel" id="radio" value="us_bank_radio" onClick="changeObjectVisibility('us_bank_div'); this.form.lastBankRadioButtonPressed.value='US'" >
			 &nbsp;&nbsp;
			 Canadian Bank<input type="radio" name="banksel" id="radio2" value="ca_bank_radio" onClick="changeObjectVisibility('canadian_bank_div'); this.form.lastBankRadioButtonPressed.value='CA'"" ></td>
<!--                       <td  align="center" width="30%" class="small">
			 U.S. Bank <input type="radio" name="banksel" id="radio" value="us_bank_radio" onClick="changeObjectVisibility('us_bank_div'); this.form.lastBankRadioButtonPressed.value='US'" ></td>
			<td  align="left" width="20%" class="small">
			  Canadian Bank<input type="radio" name="banksel" id="radio2" value="ca_bank_radio" onClick="changeObjectVisibility('canadian_bank_div'); this.form.lastBankRadioButtonPressed.value='CA'"" ></td>
			<td>&nbsp;</td>
-->                        
		  </tr>
		</table>
		<!-- check if secondary account exists -->
		<!-- check if primary account exists -->
		<br>
<!-- start US Bank deposit form here -->
		<!-- <form action="" name="dd" target="_self" id="dd"> -->
<!--                      <div id="us_bank_div" style="position:static;visibility:hidden;">  -->
<!--                       <div id="us_bank_div" class="visiable">  -->
<!--                      <div id="us_bank_div" class='return getObjectVisibility("", this)'> -->
							  <div id="us_bank_div" class="hidden">
<!--                      <form action="/Project25_DirectDeposit/dd/DirectDepositUpdate.do" method="post" name="us_bank_form" target="_self" id="dd" > -->
		  <table width="100%" border="0" cellpadding="3" cellspacing="0" class="textboxunderline">
			<tr> 
			  <td colspan="4" class="normal"><strong>Primary Deposit Account for US Banks<br>
			  </strong> <span class="small"> If you are depositing your pay into only one account, all your net earnings will be deposited in this account.  All fields are required.</span></td>
			</tr>
			<tr bgcolor="E3E3D7">
			<td width="150" class="wsmall">&nbsp;</td>
			<td width="187" class="small"><strong>Current Data</strong></td>
			<td width="153" class="small"><strong>New/Updated Data</strong></td>
			<td width="243" class="wsmall"><div align="right">
<!--                       <input name="button3" type="button" class="entertext" id="button3" OnClick="Circle_calc(this.form);"value=Cancel Primary Account> -->
<!--                         <input type="submit" name="cancelPrimaryAccountButton" value="Cancel Primary Account"> -->
<!--                         <input type="submit" value="Cancel Primary Account" onclick=" this.form.action='/ESSDD/dd/CancelPrimary.do'; disableButtons(this.form) "> -->
<input type="submit" value="Cancel Primary Account" onclick="if(confirmDepositCancel(this.form)){ this.form.action='/ESSDD/dd/CancelPrimary.do'; disableButtons(this.form);return true} else { return false}; ">
			</div></td>
			</tr>
				<!-- logic: ... is to display value of the newFullABA without required text on the background -->       
				<tr bgcolor="#EBEBDB" class="small"> 
				  <td class="small">Routing (ABA) Number:</td>
				  <td class="small">063100277</td> 
						<td width="153" class="small"><input name="newFullABA" type="text" class="entertextrequired" id="newFullABA" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" maxlength="9" >
				  <a href="#" onClick="window.open('../jsp/check_example_us.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>
				  <td bgcolor="#EBEBDB" class="small">&nbsp;</td>
				 </tr>
				<tr bgcolor="#F9F8E7" class="small"> 
				  <td valign="top" >Account Number:<br></td>
				  <td valign="top" >229032750730</td>
						<td valign="top" bgcolor="#F9F8E7" class="small"><input name="newFullAcct" type="text" class="entertextrequired" id="account_3" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" > 
					<a href="#" onClick="window.open('../jsp/check_example_us.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>
				  <td> &nbsp;</td>
				</tr>
<script type="text/javascript">
//	alert("C");
</script> 
			<tr bgcolor="#EBEBDB" class="small">                     
			  <td valign="top" class="small"> Account Type:</td>
			  <td valign="top" class="small">                                                   				
					Checking
			  </td>
<script type="text/javascript">
//	alert("N");
</script> 
			  <td>
				  <select name="newFullCheckSav" class="entertext" id="acct_type_3" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'">
					<option value="SB" >Select Below</option>
						<option value="C" >Checking</option>
						<option value="S" >Savings</option>
				  </select>
			  </td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
		  <table width="100%" border="0" cellpadding="3" cellspacing="0" class="textboxunderline">
			<tr> 
			  <td colspan="4" class="normal"><strong><br>Secondary Deposit Account for US Banks(Optional)<br>
			  </strong><span class="small">This Flat Amount will be deposited first from your net earnings and the remainder will be deposited into your Primary Account. All fields are required.</span></td>
			</tr>
			<tr bgcolor="E3E3D7" class="wsmall"> 
			  <td width="150">&nbsp;</td>
			  <td width="190"  class="small"> <strong>Current Data <a href="#" onClick="window.open('../html/check_example.html', '_blank', 'height=600,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')"></a></strong></td>
			  <td width="152"  class="small"><strong>New/Updated Data</strong></td>
			  <td width="243"><div align="right">
				<input type="submit" value="Cancel Secondary Account" onclick=" this.form.action='/ESSDD/dd/CancelSecondary.do'; disableButtons(this.form) " disabled="disabled">
			  </div></td>
			</tr>
			<tr bgcolor="#EBEBDB" class="small"> 
				  <td class="small">Routing (ABA) Number:</td>
				  <td class="small"></td> 
						<td width="153" class="small"><input name="newPartABA" type="text" class="entertext" id="routing_4" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" maxlength="9" >
				  <a href="#" onClick="window.open('../jsp/check_example_us.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>
				  <td>&nbsp;</td>
			</tr> 
				<tr> 
				  <td valign="top" bgcolor="#F9F8E7" class="small">Account Number:<br></td>
				  <td valign="top" bgcolor="#F9F8E7" class="small"></td>
						<td valign="top" bgcolor="#F9F8E7" class="small"><input name="newPartAcct" type="text" class="entertext" id="account_4" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" > 
					<a href="#" onClick="window.open('../jsp/check_example_us.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>
				  <td valign="top" bgcolor="#F9F8E7" class="small">&nbsp;</td>
				</tr>
			<tr bgcolor="#EBEBDB" class="small"> 
			  <td valign="top" >Account Type:</td>
			  <td valign="top" >
			  </td>
			  <td valign="top" >
				  <select name="newPartCheckSav" class="entertext" id="acct_type_4" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'">
					<option value="SB" >Select Below</option>
						<option value="C" >Checking</option>
						<option value="S" >Savings</option>
				  </select>
			  </td>
			  <td valign="top" >&nbsp;</td>
			</tr>
			<tr valign="top" bgcolor="#F9F8E7" class="small">
			  <td>Flat Amount</td>
			  <td></td>
						<td>$
						<input name="newPartAmt" type="text" class="entertext" id="amount_2" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" value="" size="6" maxlength="6"> .00
						</td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
		  <input name="sysUsrId" type="hidden" id="sysUsrId" value="44020624905850483311352J">
		  <input name="preferLocale" type="hidden" id="preferLocale" value="en_US">
		  <input name="fname" type="hidden" id="fname" value="WINICIUS">
		  <input name="lname" type="hidden" id="lname" value="SIQUEIRA">
		  <input name="associateID" type="hidden" id="associateID" value="115838849">
		  <input name="fullABAForm" type="hidden" id="fullABA" value="063100277">
		  <input name="payCardFlag" type="hidden" id="payCardFlag" value="X">
		 <input name="fullABA" type="hidden" id="fullABA" value="063100277">
		 <input name="fullAcct" type="hidden" id="fullAcct" value="229032750730">
		 <input name="fullCheckSav" type="hidden" id="fullCheckSav" value="C">
		 <input name="fullTZCode" type="hidden" id="fullTZCode" value="999">
		 <input name="partTZCode" type="hidden" id="partTZCode" value="">
		 <input name="partAmt" type="hidden" id="partAmt" value="">
		 <input name="partABA" type="hidden" id="partABA" value="">
		 <input name="partAcct" type="hidden" id="partAcct" value="">
		 <input name="partCheckSav" type="hidden" id="partCheckSav" value="">
		  <input name="epayTZCode" type="hidden" id="epayTZCode" value="">
		  <input name="epayAmt" type="hidden" id="epayAmt" value="">
		 <input name="epayABA" type="hidden" id="epayABA" value="">
		 <input name="epayAcct" type="hidden" id="epayAcct" value="">
		 <input name="epayCheckSav" type="hidden" id="epayCheckSav" value="N">
		 <input name="mandateFlag" type="hidden" id="mandateFlag" value="Y">
		  <br><table width="100%" border="0" cellspacing="0" cellpadding="3">
		  <tr>
			<td colspan="2" class="rsmall">By enrolling in Direct Deposit, you are authorizing The Home Depot to initiate credit and debit entries into your account. The Home Depot is not responsible for any unforeseen or unavoidable circumstances which result in an incorrect or delayed deposit of pay to your direct deposit account(s). Transactions should not be performed from your account until you verify the timely and correct deposit of funds.  This authorization is to remain in effect until you have provided The Home Depot with a request of cancellation, and in a time frame which affords The Home Depot a reasonable opportunity to process your request. </td>
			</tr>
		  <tr>
				<td width="95"><input type="submit" value="Enroll/Update" onclick=" if(checkForm(this.form)){ this.form.action='/ESSDD/dd/DirectDepositUpdate.do'; disableButtons(this.form); return true } else{ return false }; "></td>
			 <td class="rsmall">&nbsp;</td>
		  </tr>
		</table>
<!--                       </form>--><!-- end US Bank dd form here --> 
		</div>
		<!-- CANADA -->  
		<div id="canadian_bank_div" class="hidden">
		  <table width="100%" border="0" cellpadding="3" cellspacing="0" class="textboxunderline">
			<tr> 
			  <td colspan="4" class="normal"><strong>Primary Deposit Account for Canadian Banks<br>
			  </strong> <span class="small"> If you are depositing your pay into only one account, all your net earnings will be deposited in this account.  All fields are required.</span></td>
			</tr>
			<tr bgcolor="#EBEBDB" class="wsmall"> 
			  <td width="128">&nbsp;</td>
			  <td width="164" class="small"><strong>Current Data</strong></td>
			  <td width="203" class="small"><strong>New/Updated Data</strong></td>
			  <td width="222"><div align="right">
				<input type="submit" value="Cancel Primary Account" onclick=" this.form.action='/ESSDD/dd/CancelPrimary.do'; disableButtons(this.form) ">
			  </div></td>
			</tr>
			<tr valign="top" bgcolor="#F9F8E7" class="small"> 
			  <td>Transit Number<br></td>
			  <td>00277</td>
			  <td><span class="small">
					<input name="newFullTransitNumber" type="text" class="entertextrequired" id="account_3" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" maxlength="5" > 
					<a href="#" onClick="window.open('../jsp/check_example_ca.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a>
			  </span></td>
			  <td>&nbsp;</td>
			</tr>
			<tr valign="top" bgcolor="EBEBDB" class="small">
			  <td>Bank Code</td>
			  <td>631</td>
			  <td><span class="small">
					<input name="newFullBankCode" type="text" class="entertextrequired" id="bank_cd1" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" maxlength="3">
					<a href="#" onClick="window.open('../jsp/check_example_ca.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a>                                                     
			  </span></td>
			  <td>&nbsp;</td>
			</tr>
			<tr valign="top" bgcolor="#F9F8E7" class="small">
			  <td>Account Number:</td>
			  <td>229032750730</td>
			   <td>
					<input name="newCanFullAcct" type="text" class="entertextrequired" id="account_1" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'">
					<a href="#" onClick="window.open('../jsp/check_example_ca.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>                                                       
			  <td>&nbsp;</td>
			</tr>
			<tr valign="top" bgcolor="EBEBDB" class="small">                    
			  <td>Account Type:</td>
			  <td>                                                   				
					Checking
			  </td>
<script type="text/javascript">
//	alert("N");
</script> 
			  <td>
				  <select name="newCanFullCheckSav" class="entertext" id="acct_type_3" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'">
					<option value="SB" >Select Below</option>
						<option value="C" >Checking</option>
						<option value="S" >Savings</option>
				  </select>
			  </td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
		  <br>
		  <table width="100%" border="0" cellpadding="3" cellspacing="0" class="textboxunderline">
			<tr> 
			   <td colspan="4" class="normal"><strong>Secondary Deposit Account for Canadian Banks(Optional)<br>
			  </strong> <span class="small"> This Flat Amount will be deposited first from your net earnings and the remainder will be deposited into your Primary Account. All fields are required.</span></td>
			</tr>
			<tr bgcolor="#EBEBDB" class="wsmall"> 
			  <td width="128">&nbsp;</td>
			  <td width="164" class="small"><strong>Current Data<a href="#" onClick="window.open('../html/check_example.html', '_blank', 'height=600,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')"></a></strong></td>
			  <td width="203" class="small"><strong>New/Updated Data</strong></td>
			  <td width="221"><div align="right"><strong>
			  <input type="submit" value="Cancel Secondary Account" onclick=" this.form.action='/ESSDD/dd/CancelSecondary.do'; disableButtons(this.form) " disabled="disabled"> 
			  </strong></div></td>
			</tr>
			<tr> 
			  <td valign="top" bgcolor="#F9F8E7" class="small">Transit Number<br></td>
			  <td valign="top" bgcolor="#F9F8E7" class="small"></td>
			  <td valign="top" bgcolor="#F9F8E7"><span class="small">
					<input name="newPartTransitNumber" type="text" class="entertext" id="account_3" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" maxlength="5" > 
					<a href="#" onClick="window.open('../jsp/check_example_ca.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>                            
			  </span></td>
			  <td valign="top" bgcolor="#F9F8E7">&nbsp;</td>
			</tr>
			<tr valign="top" bgcolor="EBEBDB" class="small"> 
			  <td>Bank Code</td>
			  <td></td>
			  <td><span class="small">
					<input name="newPartBankCode" type="text" class="entertext" id="account_1" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" maxlength="3">
				<a href="#" onClick="window.open('../jsp/check_example_ca.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>
			  </span></td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td valign="top" bgcolor="#F9F8E7" class="small">Account Number:</td>
			  <td valign="top" bgcolor="#F9F8E7" class="small"></td>
			  <td valign="top" bgcolor="#F9F8E7" class="small">
					<input name="newCanPartAcct" type="text" class="entertext" id="account_1" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'">
				<a href="#" onClick="window.open('../jsp/check_example_ca.jsp', '_blank', 'height=450,width=630,menubar=no,location=no,resizable=yes,toolbar=no,scrollbars=yes,status=no')">help</a></td>
			  <td valign="top" bgcolor="#F9F8E7">&nbsp;</td>
			</tr>
			<tr valign="top" bgcolor="EBEBDB" class="small"> 
			  <td>Account Type:</td>
			  <td>
			  </td>
			  <td>
				  <select name="newCanPartCheckSav" class="entertext" id="acct_type_3" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'">
					<option value="SB" >Select Below</option>
						<option value="C" >Checking</option>
						<option value="S" >Savings</option>
				  </select>
			  </td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td valign="top" bgcolor="#F9F8E7" class="small">Flat Amount</td>
			  <td valign="top" bgcolor="#F9F8E7" class="small"></td>
			  <td valign="top" bgcolor="#F9F8E7" class="small">$
					<input name="newCanPartAmt" type="text" class="entertext" id="amount_2" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" value="" size="6" maxlength="6"> .00
<!--                             <input name="newCanPartAmt" type="text" class="entertext" id="amount_2" onFocus="this.style.background='#FFFFDF'" onBlur="this.style.background='#FFFFFF'" value="" size="6" maxlength="6">
			  .00</td>
-->                          
			  <td valign="top" bgcolor="#F9F8E7">&nbsp;</td>
			</tr>
		  </table>
		  <!-- <input name="emplid" type="hidden" id="emplid" value="32767">
		  <input name="fname" type="hidden" id="fname" value="Arthur">
		  <input name="lname" type="hidden" id="lname" value="Blank">
		  -->
		  <br>
		  <table width="100%" border="0" cellspacing="0" cellpadding="3">
		  <tr>
			<td colspan="2" class="rsmall">By enrolling in Direct Deposit, you are authorizing The Home Depot to initiate credit and debit entries into your account. The Home Depot is not responsible for any unforeseen or unavoidable circumstances which result in an incorrect or delayed deposit of pay to your direct deposit account(s). Transactions should not be performed from your account until you verify the timely and correct deposit of funds.  This authorization is to remain in effect until you have provided The Home Depot with a request of cancellation, and in a time frame which affords The Home Depot a reasonable opportunity to process your request. </td>
			</tr>
		  <tr>
<!--                     <td width="95"><input type="submit" value="Enroll/Update"></td> -->
			<td width="95"><input type="submit" value="Enroll/Update" onclick=" if(checkForm(this.form)){ this.form.action='/ESSDD/dd/DirectDepositUpdate.do'; disableButtons(this.form); return true } else{ return false }; "></td>
			<td class="rsmall">&nbsp;</td>
		  </tr>
		</table>
		</div>   
	  </td>
	</tr>
  </table>
  <br>
  <!-- EPay section	 -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="areabox">
	<tr>
	 <td>
	  <div id="payroll_card_div" class="visible">
<!--                     <form name="form1" method="post" action="/Project25_DirectDeposit/dd/DirectDepositUpdate.do"> -->
		<table width="100%" border="0" cellpadding="3" cellspacing="0" >
		<tr>
		  <td class="heading1">Citi Payroll Card</td>
		</tr>
<!-- ---------------- Mandated ePay section STARTS here ----------------------------- -->                    
		<!--  Epay flags of 2, 3, 5 or 9 or X do not apply to mandated associates -->
		<!-- When epay-flag = 6  Request Recorded  -->
		<!-- When epay-flag = 7 Payroll Card request sent to Citi -->
		<!-- When epay-flag = 4, There's an error. -->
		<!-- When epay-flag = 8, Currently Enrolled in Payroll Card -->
<!---------------- Mandated ePay section ENDS here --------------------------------->                    
<!---------------- Non-Mandated ePay section STARTS here --------------------------->                    
	  <!-- Non-Mandated ePay section ends here -->                 
	  </table>
	  <br>
	  <div id="payroll.txt4" class= Visible >
		<table width="100%" border="0" cellspacing="0" cellpadding="3">                   
		  <tr>
			<td COLSPAN=2 class="rsmall">
					<p>When you are enrolled in the Citi MasterCard Payroll Card, The Home Depot is authorized to initiate credit and debit entries into your account. The Home Depot is not responsible for any unforeseen or unavoidable circumstances which result in an incorrect or delayed deposit of pay to your payroll card account. Transactions should not be performed with the payroll card from your account until you verify the timely and correct deposit of funds onto your payroll card account.                                                               </p>
					<p>This authorization will remain in effect until you no longer participate in the Citi payroll card program and The Home Depot has had a reasonable opportunity to process your request.</p>
			</td>
		  </tr>					
		</table>
	  </div>
	  <br>
	   </div>
	  </td>
	</tr>
  </table>
</form>

