<br />
<br />
<br />

<table width="100%" class="login">
<tr>
	<td class="bold right">
	<label for="username" class="required">E-mail:</label>
	</td>

	<td class="">
	<input type="text" name="email" id="email" value="">
	</td>
</tr>

<tr>
	<td>&nbsp;
	<span>
		<a class="right tiny" href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">
		<img class="refresh" valign="center" src="/securimage/refresh.png" alt="Refresh Image" /><br />Try a different image.</a>
	</span>
	</td>

	<td>
	<img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" />
	</td>
</tr>

<tr>
	<td class="bold right">
		Type characters: 
	</td>
	<td>
		<input class="" type="text" name="captcha_code" size="10" maxlength="6" />
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
	<input class="" type="submit" name="login" id="login" value="Continue">
	</td>
</tr>

</table>

