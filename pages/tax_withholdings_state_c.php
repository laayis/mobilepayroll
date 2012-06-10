
<script type="text/javascript" scr="/js/tax_state.js"></script>

<h1>ESS State Withholding Electronic Form</h1>
<hr />

<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
<TR>
  <TD VALIGN="top">
	<SPAN CLASS="small">
	  Name: <strong>WINICIUS SIQUEIRA</strong>&nbsp;
	  Associate ID: <strong>115838849</strong>
	</SPAN>
	<BR /><BR />
	<TABLE WIDTH="100%" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
	  <TR>
		<TD>
		  <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="2">
			<TR>
			  <TD CLASS="small">
				<P>Please use this form to view or change your State Tax Withholdings. Your current information is shown below. If your State is incorrect, please call the HR Service Center. If you would like to make changes, please do so in the appropriate field(s). If you make ANY changes to this form you MUST complete the Declaration section below.<BR /><BR /></P>
			  </TD>
			</TR>
		  </TABLE>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="8">
			<span class="heading1"><strong>Enter State Withholdings<br /></strong></span>
			<span class="normal">Required fields are marked with</span>
			<strong><img src="/EssTax/images/png_required_blue_right_arrow.png" width="14" height="14" /></strong>
			</td>
			</tr>
			<tr bgcolor="EBEBDB">
			<td class="small" width="8%">
			<div align="center"><strong>Effective Date</strong></div>
			</td>
			<td class="small" width="5%">
			<div align="center"><strong>State</strong></div>
			</td>
			<td class="small" width="12%">
			<div align="center"><strong>Resident/<br/>Non-resident</strong></div>
			</td>
			<td class="small" width="45%">
			<div align="center"><strong>Marital Status</strong></div>
			</td>
			<td class="small" width="10%">
			<div align="center"><strong>Dependents</strong></div>
			</td>
			<td class="small" width="15%">
			<div align="center"><strong>Additional Tax Amount</strong></div>
			</td>
			<td class="small" colspan="5%">
			<div align="center"><strong>Tax Exempt</strong></div>
			</td>
			</tr>
			<tr>
			<td class="small"><strong>05/30/2012</strong></td>
			<td class="small">
			<div align="center"><strong>FL</strong></div>
			</td>
			<td class="small">
			<div align="center"><strong>R</strong></div>
			</td>
			<td class="small" valign="bottom">
			<div align="center">
			<input type="hidden" name="opts0" value="SINGLE" />
			<input type="hidden" name="opts0" value="MARRIED" />
			<img id="icon0" src="/EssTax/images/png_required_blue_right_arrow.png" width="14" height="14" />
			<select name="stateWithholdings[0].maritalStatusCd" onchange="document.getElementById('icon0').title=this.form.opts0[this.selectedIndex].value" disabled="disabled" class="entertext"><option value="S" selected="selected">SINGLE</option>
			<option value="M">MARRIED</option></select>
			</div>
			</td>
			<td class="small" valign="bottom">
			<div align="center">
			<img src="/EssTax/images/png_required_blue_right_arrow.png" width="14" height="14" />
			<input type="text" name="stateWithholdings[0].dependents" maxlength="2" size="2" value="0" disabled="disabled" class="entertext">
			</div>
			</td>
			<td class="small">
			<div align="center">
			$<input type="text" name="stateWithholdings[0].additionalTaxAmount" maxlength="10" size="10" value="0.0" disabled="disabled" class="entertext">
			</div>
			</td>
			<td class="small" colspan="2">
			<div align="center"><strong>No</strong></div>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td valign="bottom">&nbsp;</td>
			<td valign="bottom">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			</tr>
			</table>
		</TD>
	  </TR>
	</TABLE>
	<BR />      
	<TABLE WIDTH="100%" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
	  <TR>
		<TD>
		  <TABLE WIDTH="100%" BORDER="0" ALIGN="center" CELLPADDING="3" CELLSPACING="0">
			<TR>
			  <TD CLASS="small">
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
				  <TR>
					<TD><SPAN CLASS="heading1"><STRONG>Tax Exempt Status (Optional)</STRONG></SPAN></TD>
				  </TR>
				</TABLE>
				You may be exempt from paying State Taxes. If you already know that you are eligible to claim exemption State Taxes, you must read and agree with the statement below, then check &quot;I am exempt from State Taxes.&quot; Otherwise, skip this section.<BR /><BR />
			  </TD>
			</TR>
			<TR>
			  <TD CLASS="heading1" BGCOLOR="EBEBDB"><STRONG>(Optional) Claim Exemption</STRONG></TD>
			</TR>
			<TR>
			  <TD>
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
				  <TR>
					<TD WIDTH="20" VALIGN="top">
					  <INPUT TYPE="radio" NAME="claimExemption" ONCLICK="this.form.noClaimExemption.checked=false" disabled="disabled")/>
					</TD>
					<TD>
					  <SPAN CLASS="small">I am exempt from State Taxes.</SPAN><BR /><BR />
					  <SPAN CLASS="small">
						1)Last year I had a right to a refund of ALL State income tax withheld because I had NO tax liability;<BR/>
						<strong>AND</strong><br/>2) This year I expect a refund of ALL State income tax withheld because I had NO tax liability.
					  </SPAN><BR /><BR />
					</TD>
				  </TR>
				</TABLE>
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
				  <TR>
					<TD WIDTH="20">
					  <INPUT TYPE="radio" NAME="noClaimExemption" ONCLICK="this.form.claimExemption.checked=false" disabled="disabled")/>
					</TD>
					<TD><SPAN CLASS="small">I am no longer exempt from State Taxes.</SPAN></TD>
				  </TR>
				</TABLE>
			  </TD>
			</TR>
			<TR>
			  <TD>&nbsp;</TD>
			</TR>
		  </TABLE>
		</TD>
	  </TR>
	</TABLE>
	<BR />
	<TABLE WIDTH="100%" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
	  <TR>
		<TD>
		  <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="2">
			<TR>
			  <TD CLASS="small" HEIGHT="199">
				<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="2">
				  <TR>
					<TD>
					  <SPAN CLASS="heading1"><STRONG>Declaration (Required)</STRONG></SPAN>
					</TD>
				  </TR>
				</TABLE>
				I certify under penalty of perjury that I am entitled to the number of withholding allowances or the exemption from withholding status claimed on this form. Also, I authorize my employer to deduct per pay period the additional amount listed above.<BR /><BR />
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
				  <TR>
					<TD WIDTH="20"><INPUT TYPE="checkbox" NAME="declaration" disabled="disabled")/></TD>
					<TD CLASS="small">&nbsp;I have read, understand and agree with the above declaration.</TD>
				  </TR>
				</TABLE>
				<P><BR />
				  <SPAN CLASS="rsmall">
					To continue, you must agree to the declaration above and check the box.<BR />
					To leave the page without making changes, click ESS Overview.
				  </SPAN>
				</P>
				<BR />
				<P>
				  <INPUT TYPE="submit" NAME="button1" CLASS="entertext" VALUE='Submit'
					disabled="disabled")/>
				</P>
			  </TD>
			</TR>
		  </TABLE>
		</TD>
	  </TR>
	</TABLE>
</TD>
</TR>
</TABLE>

