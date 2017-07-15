function chk_me() 
{
	var chkbox = document.getElementById('chk_remember').checked;

	if(document.getElementById('chk_remember').checked)
	{
		document.getElementById('chk_remember').value = chkbox;
	}
}

function copyToClipboard(element) 
{
	$('#btn-copied').fadeIn('slow');
	
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(element).text()).select();
	document.execCommand("copy");
	$temp.remove();
}