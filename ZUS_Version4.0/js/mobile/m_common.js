// page onsite redirect
function visit(url)
{
	window.location.href='<?php echo $home; ?>'+url;
}

// change view tab
function changeViewTab(classPrefix, tabId)
{
	$(classPrefix).addClass('back');
	$(classPrefix+'.tab-'+tabId).removeClass('back');
}