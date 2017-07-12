function chk_me() 
{
	var chkbox = document.getElementById('chk_remember').checked;

	if(document.getElementById('chk_remember').checked)
	{
		document.getElementById('chk_remember').value = chkbox;
	}
}