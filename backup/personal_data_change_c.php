
<script type="text/javascript" src="/js/personal_data_change.js"></script>

<h1>ESS Personal Data Change</h1>
<hr />

<form name="personaldataform" method="post" action="updatepersonalinfo.php">
<table width="800"   border="0" cellpadding="0" cellspacing="0"  align="center">
<tr><td>
<div style="display: none; visibility: invisible;">
<input type="text" name="tot_country" maxlength="2" size="5" value="<?php ?>" class="entertext">
</div>
			<!-- US Associate Info -->
	<table width="100%" border="0" cellpadding="0" cellspacing="4">
		<tr><td colspan="2" class="small">
			<div align="left"><span>Name:&nbsp<strong>
			<?php $link=initDb();
			selectDb($link);
			echo showName($link);
			 ?>&nbsp;&nbsp;&nbsp;
			</strong>&nbsp;
			Associate ID:&nbsp<strong>
			<?php
				echo $_COOKIE['id'];
			 ?>
			</strong>
			<br /><br />
			On this page you may update your personal Information.
			</span><br />
			</div>
		</td></tr>
    </table>
</td></tr>
<tr><td>
</td></tr>
<tr><td>
	<br />
			<!-- US Contact Information -->
	<table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4" >
		<tr><td bgcolor="EFEFE4" class="normal"> 
			<div align="left"><strong>CONTACT INFORMATION</strong></div>
        	<div align="center" ></div>
        	</td>
        </tr> 
		<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr><td colspan="2" class="small" align="left">
						<div id="nameNote">
							Note: You are required to have proof of any name change.  This will be audited and compared with the information from the Social Security Administration and if there is not a match you will be contacted. In addition, you are required to update your new name on your I-9 form.  Please contact your direct manager or your Human Resources representative to update your I-9 form.
                    	</div>
					</td></tr>
					<tr><td width="37%" valign="middle" class="normal"> 
						<div align="right"><strong>First:
						</strong></div></td>
						<td class="normal"><div align="left">&nbsp; 
						<input type="text" name="totable_first" maxlength="30" size="15" value="<?php selectContact($link, 'first'); ?>" onfocus="displayNameNote()" class="entertext" id="first">
						<span ><strong>M.I.:
						</strong></span> 
                        <input type="text" name="totable_mi" maxlength="1" size="1" value="<?php selectContact($link, 'mi'); ?>" onfocus="displayNameNote()" class="entertext" id="mi">
						<strong><span>Last:
						</span></strong> 
                        <input type="text" name="totable_last" maxlength="30" size="15" value="<?php selectContact($link, 'last'); ?>" onfocus="displayNameNote()" class="entertext" id="last">
                        <span><select name="totable_suffix" onchange="displayNameNote()" class="entertext" id="suffix"><option value="" selected="selected"></option>
							      <option value="JR">JR</option>
							      <option value="SR">SR</option>
	                              <option value="II">II</option>
	                              <option value="III">III</option>
	                              <option value="IV">IV</option></select></span> 
						</div></td>
					</tr>
					<tr><td colspan="2" class="small" align="left">
						<div id="adrNote">
                    		Note: Your change may affect your State and/or Local Tax withholdings.  Please visit www.myTHDHR.com or contact the HR Service Center at 1-866-myTHDHR (1-866-698-4347) or email myTHDHR@homedepot.com to obtain the appropriate Federal, State, or Local Tax forms to submit to payroll.
                    	</div>
					</td></tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Address line 1:</strong></div></td>
						<td ><div align="left"><strong>&nbsp; 
						<input type="text" name="totable_addr2" maxlength="24" size="35" value="<?php selectContact($link, 'addr1'); ?>" onfocus="displayAdrNote()" class="entertext" id="addr1">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Address line 2:</strong></div></td>
						<td><div align="left"><strong>&nbsp; 
						<input type="text" name="totable_addr2" maxlength="24" size="35" value="<?php selectContact($link, 'addr2'); ?>" onfocus="displayAdrNote()" class="entertext" id="addr2">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>City:</strong></div></td>
						<td><div align="left"><strong> &nbsp; 
						<input type="text" name="totable_city" size="24" value="<?php selectContact($link, 'city'); ?>" onfocus="displayAdrNote()" class="entertext" id="city">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>State:</strong></div></td>
						<td><div align="left"><strong> &nbsp; 
						<select name="state" size="1" onchange="displayAdrNote()" class="entertext" id="state"><option value=""></option>
													<option value="AK">AK</option>
													<option value="AL">AL</option>
													<option value="AR">AR</option>
													<option value="AZ">AZ</option>
													<option value="CA">CA</option>
													<option value="CO">CO</option>
													<option value="CT">CT</option>
													<option value="DC">DC</option>
													<option value="DE">DE</option>
													<option value="FL" selected="selected">FL</option>
													<option value="GA">GA</option>
													<option value="GU">GU</option>
													<option value="HI">HI</option>
													<option value="IA">IA</option>
													<option value="ID">ID</option>
													<option value="IL">IL</option>
													<option value="IN">IN</option>
													<option value="KS">KS</option>
													<option value="KY">KY</option>
													<option value="LA">LA</option>
													<option value="MA">MA</option>
													<option value="MD">MD</option>
													<option value="ME">ME</option>
													<option value="MI">MI</option>
													<option value="MN">MN</option>
													<option value="MO">MO</option>
													<option value="MS">MS</option>
													<option value="MT">MT</option>
													<option value="NC">NC</option>
													<option value="ND">ND</option>
													<option value="NE">NE</option>
													<option value="NH">NH</option>
													<option value="NJ">NJ</option>
													<option value="NM">NM</option>
													<option value="NV">NV</option>
													<option value="NY">NY</option>
													<option value="OH">OH</option>
													<option value="OK">OK</option>
													<option value="OR">OR</option>
													<option value="PA">PA</option>
													<option value="PR">PR</option>
													<option value="RI">RI</option>
													<option value="SC">SC</option>
													<option value="SD">SD</option>
													<option value="TN">TN</option>
													<option value="TX">TX</option>
													<option value="UT">UT</option>
													<option value="VA">VA</option>
													<option value="VI">VI</option>
													<option value="VT">VT</option>
													<option value="WA">WA</option>
													<option value="WI">WI</option>
													<option value="WV">WV</option>
													<option value="WY">WY</option></select>
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>ZIP Code:</strong></div></td>
						<td><div align="left"><strong> &nbsp; 
						<input type="text" name="totable_zip" maxlength="10" size="10" value="<?php selectContact($link, 'zip'); ?>" onfocus="displayAdrNote()" class="entertext" id="zip">
						</strong></div></td>
						</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Primary:</strong></div></td>
						<td><div align="left"><strong>&nbsp; 
						<input type="text" name="totable_primaryphone1" maxlength="3" size="3" value="<?php selectContact($link, 'primaryphone1'); ?>" class="entertext" id="primaryphone1"> - 
						<input type="text" name="totable_primaryphone2" maxlength="3" size="3" value="<?php selectContact($link, 'primaryphone2'); ?>" class="entertext" id="primaryphone2"> -
						<input type="text" name="primaryphone3" maxlength="4" size="4" value="<?php selectContact($link, 'primaryphone3'); ?>" class="entertext" id="primaryphone3">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Secondary:</strong></div></td>
						<td><div align="left"><strong>&nbsp; 
						<input type="text" name="totable_secondaryphone1" maxlength="3" size="3" value="<?php selectContact($link, 'secondaryphone1'); ?>" class="entertext" id="secondaryphone1"> - 
						<input type="text" name="totable_secondaryphone2" maxlength="3" size="3" value="<?php selectContact($link, 'secondaryphone2'); ?>" class="entertext" id="secondaryphone2"> -
						<input type="text" name="totable_secondaryphone3" maxlength="4" size="4" value="<?php selectContact($link, 'secondaryphone3'); ?>" class="entertext" id="secondaryphone3">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Work Email Address:</strong></div></td>
						<td><div align="left"><strong>&nbsp; 
						</strong><font size="2">NO EMAIL ADDRESS ON FILE</font></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Personal Email Address:</strong></div></td>
						<td><div align="left"><strong>&nbsp; 
						<input type="text" name="personalEmail" size="35" value="" class="entertext" id="personalEmail">
						</strong></div></td>
					</tr>
				</table>
		</td></tr>
	</table>
</td></tr>
<tr><td>
	<br />
</td></tr>
<tr><td> 
			<!-- US Emergency Contact Info -->
<table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4">
		<tr><td bgcolor="EFEFE4" class="normal"> 
		<div align="left"><strong>EMERGENCY CONTACT</strong></div>
		<div align="center" ></div></td>
		</tr>
		<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr><td width="37%" class="normal"> 
						<div align="right"><strong>Emergency Contact:
						</strong></div></td>
						<td><div align="left"><strong>&nbsp; 
						<input type="text" name="totable_emergency1" maxlength="30" size="35" value="<?php selectContact($link, 'emergency1'); ?>" class="entertext" id="emergency1">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Phone Number:
						</strong></div></td>
						<td ><div align="left"><strong>&nbsp; 
						<input type="text" name="totable_emergency1contact11" maxlength="3" size="3" value="<?php selectContact($link, 'emergency1contact11'); ?>" class="entertext" id="emergenc1ycontact11"> - 
						<input type="text" name="totable_emergency1contact12" maxlength="3" size="3" value="<?php selectContact($link, 'emergency1contact12'); ?>" class="entertext" id="emergency1contact12"> -
						<input type="text" name="totable_emergency1contact13" maxlength="4" size="4" value="<?php selectContact($link, 'emergency1contact13'); ?>" class="entertext" id="emergency1contact13">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Phone Number:
						</strong></div></td>
						<td ><div align="left"><strong>&nbsp; 
						
						<input type="text" name="totable_emergency1contact21" maxlength="3" size="3" value="<?php selectContact($link, 'emergency1contact21'); ?>" class="entertext" id="emergenc1ycontact21"> - 
						<input type="text" name="totable_emergencycontact22" maxlength="3" size="3" value="<?php selectContact($link, 'emergency1contact22'); ?>" class="entertext" id="emergency1contact22"> -
						<input type="text" name="totable_emergency1contact23" maxlength="4" size="4" value="<?php selectContact($link, 'emergency1contact23'); ?>" class="entertext" id="emergency1contact23">
	

			
	</strong></div></td>
					</tr>
					<tr><td >&nbsp;</td>
						<td ><div align="left"></div></td>
					 </tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Secondary Contact:
						</strong></div></td>
						<td ><div align="left"><strong> &nbsp; 
						<input type="text" name="totable_emergency2" maxlength="30" size="35" value="<?php selectContact($link, 'emergency2'); ?>" class="entertext" id="emergency2">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Phone Number:
						</strong></div></td>
						<td ><div align="left"><strong>&nbsp;



						<input type="text" name="totable_emergency2contact11" maxlength="3" size="3" value="<?php selectContact($link, 'emergency2contact11'); ?>" class="entertext" id="emergency2contact11"> - 
						<input type="text" name="totable_emergency2contact12" maxlength="3" size="3" value="<?php selectContact($link, 'emergency2contact12'); ?>" class="entertext" id="emergency2contact12"> -
						<input type="text" name="totable_emergency2contact13" maxlength="4" size="4" value="<?php selectContact($link, 'emergency2contact13'); ?>" class="entertext" id="emergency2contact13">
						</strong></div></td>
					</tr>
					<tr><td class="normal"> 
						<div align="right"><strong>Phone Number:
						</strong></div></td>
						<td ><div align="left"><strong>&nbsp; 
						
						<input type="text" name="totable_emergency2contact21" maxlength="3" size="3" value="<?php selectContact($link, 'emergency2contact21'); ?>" class="entertext" id="emergency2contact21"> - 
						<input type="text" name="totable_emergency2contact22" maxlength="3" size="3" value="<?php selectContact($link, 'emergency2contact22'); ?>" class="entertext" id="emergency2contact22"> -
						<input type="text" name="totable_emergency2contact23" maxlength="4" size="4" value="<?php selectContact($link, 'emergency2contact23'); ?>" class="entertext" id="emergency2contact23">
	




						</strong></div></td>
					</tr>
					<tr><td>&nbsp;</td>
						<td ><div align="left"></div></td>
					</tr>
					<tr><td class="normal"> 
					</tr>
					<tr><td class="normal"> 
					</tr>
					<tr><td class="normal"> 
					</tr>
			</table></td>
		</tr>
	</table>
</td></tr>
<tr><td>
	<br />
</td></tr>
    <!-- requested from Andrew Cunningham on Aug 12 2011 -->
			<!-- US Military Service -->
<tr><td>
<table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4">
		<tr><td bgcolor="EFEFE4" class="normal"> 
			<div align="left"><strong>MILITARY STATUS</strong></div>
			<div align="center"></div></td>
		</tr>
		<tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">    
				<tr><td height="22" width="30%"><div class="normal" align="right" ><span> <strong>Military Service:</strong></span></div></td>											
					<td class="normal"><div>&nbsp;
						<select name="milStatus" style="width: 500px; " class="entertext" id="milStatus"><option value="1" selected="selected">NOT INDICATED</option>
									<option value="2">NO MILITARY SERVICE</option>
									<option value="3">RECENTLY SEPARATED (3 YRS) VET</option>
									<option value="4">OTHER PROTECTED VET</option>
									<option value="5">ARMED FORCES SERVICE MEDAL VET</option>
									<option value="6">RECENT SEP(3 YRS)VET, ARMD FCS SVC MEDAL VET</option>
									<option value="7">RECENT SEP(3 YRS)VET, ARMD FCS SVC MEDAL VET, OTHER PROT VET</option>
									<option value="8">OTHER PROTECTED VET, RECENT SEP (3 YRS)VET</option>
									<option value="9">OTHER PROTECTED VET, ARMD FCS SVC MEDAL VET</option></select></div>
						</td>
						</tr>
						<tr>   
						<td height="22" class="normal"><div class="normal" align="right" >
						<span><strong>Disabled Veteran:</strong></span> </td>
						<td class="normal"><div>&nbsp;&nbsp;<select name="disVeteran" class="entertext" id="disVeteran"><option value="" selected="selected"></option> 
                                <option value="N">No</option>
                                <option value="Y">Yes</option></select>
						</div></td>
				</tr>
			</table>
		</td></tr>
	</table>
</td></tr>
<tr><td>
	<br />
</td></tr>	
<tr><td>
			<!-- US Personal Attributes -->
<table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4">
		<tr><td bgcolor="EFEFE4" class="normal"> 
			<div align="left"><strong>PERSONAL ATTRIBUTES </strong></div>
			<div align="center" ></div></td>
		</tr>
		<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr><td width="37%" height="22" class="normal"> 
						<div align="right"><strong>Race: 
						</strong></div></td>
						<td><div> 
						<strong>&nbsp; 
						<select name="race" class="entertext" id="race"><option value="A" selected="selected">Two or more races</option>
	                            <option value="B">Asian</option>
	                            <option value="C">Native Hawaiian/Other Pacific Islander</option>
	                            <option value="1">White</option>
	                            <option value="2">Black or African American</option>
	                            <option value="3">Hispanic or Latino</option>
	                            <option value="5">Native American</option></select>
						</strong></div></td>
					</tr>
					<tr><td height="22" class="normal"> 
						<div align="right"><strong><span>Gender: 
						</span></strong></div></td>
						<td><strong>&nbsp; 
						<select name="gender" class="entertext" id="gender"><option value="M" selected="selected">Male</option>
                                <option value="F">Female</option></select>
						</strong></td>
					</tr>
				</table></td>
		</tr>
	</table>
</td></tr>	
<tr><td>
	<br />
</td></tr>
<tr><td>
			<!-- US Language Skills -->
<table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#EFEFE4">
		<tr><td bgcolor="EFEFE4" class="normal"> 
			<div align="left"><strong>LANGUAGE SKILLS ABILITY</strong></div>
			<div align="center" ></div></td>
		</tr>
		<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="5" class="small" align="left">
					<div id="langNote">
						<span class="small"><strong>Please select all language(s) in which you are <i>willing</i> and <i>able</i> to serve customers.</strong></span>
            		</div>
            		&nbsp;
					</td></tr>
					<tr>
						<td width="5%" class="normal"> 
							<strong>&nbsp;</strong>
						</td>
						<td width="15%" align="left">
							<div> 
						 			<input type="checkbox" name="langSel" value="EN" checked="checked" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>English</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="IT" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Italian</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="KO" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Korean</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="EL" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Greek</strong></span>
							</div>
						</td>
						<td width="15%" align="left">
							<div> 
						 			<input type="checkbox" name="langSel" value="ES" checked="checked" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Spanish</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="ZH" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Chinese</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="VI" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Vietnamese</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="AR" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Arabic</strong></span>
							</div>
						</td>
						<td width="15%" align="left">
							<div> 
						 			<input type="checkbox" name="langSel" value="FR" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>French</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="TL" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Tagalog</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="PT" checked="checked" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Portuguese</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="HI" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Hindi</strong></span>
							</div>
						</td>
						<td width="50%" align="left">
							<div> 
						 			<input type="checkbox" name="langSel" value="DE" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>German</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="PL" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			   <span class="normal"><strong>Polish</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="JA" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 		    <span class="normal"><strong>Japanese</strong></span>
							</div>
							<div> 
						 			<input type="checkbox" name="langSel" value="IS" onclick="enableOrDisableCheckBoxes();">&nbsp;
						 			<span class="normal"><strong>American Sign Language</strong></span>
							</div>
						</td>
					</tr>
				</table></td>
		</tr>
	</table>
</td></tr>
<tr><td>
	<br />
</td></tr>
<tr><td>
</td></tr>
<tr><td>
<br /> 
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td class="normal"><div align="left">Press Submit to update your information in the system. Press Exit to exit the page without saving. </div></td>
		</tr>
		<tr><td><br /> 
			<div align="left">
				<input type="submit" id="sub" value="submit" name="send" class="entertext"/>
			</div>
			<br />
			</td>
		</tr>
	</table>
</td></tr>
</table>
<input type="hidden" name="workEmail" value="NO EMAIL ADDRESS ON FILE">
<input type="hidden" name="empStatus" value="A">
<input type="hidden" name="empTermDate" value="12/31/9999">
<input type="hidden" name="addressFlag" value="N">
<input type="hidden" name="nameFlag" value="N">
</form>

