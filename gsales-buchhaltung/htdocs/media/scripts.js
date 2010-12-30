// DataTable-Container
var dataTableContainer;

$(document).ready(function() {
	// Tabs initialisieren
	$('#tabs').tabs({fxAutoHeight:true});
	// Datentabellen initialisieren
	addDataTable();
	// Navigations-Pfeile animieren
	$('#navArrow').live( 'click', function() {
		var $state = $(this).attr('class');
		if ($state == 'open') {
			$(this).attr({'src':'/media/img/bg_nav_arrow.gif','class':'close'});
			$(this).siblings('ul').slideUp('normal');
		} else {
			$(this).attr({'src':'/media/img/bg_nav_open.gif','class':'open'});
			$(this).siblings('ul').slideDown('normal');
		}
	});
	// Ausloggen-IMG Hover
	$('#logout').hover(function() {
		$(this).attr('src','/media/img/disconnect.png');
	}, function() {
		$(this).attr('src','/media/img/connect.png');
	});
	// Ausloggen-IMG Clickhandler
	$('#logout').click(function() {
		window.location.href='/logout.php';
	});
});

/*
 * DataTables General formattings
 */
function addDataTable()
{
	if ($('.dataTable').attr('id') != 'undefined') return;
	var set = $('.dataTable').attr('id');
	var pos = set.indexOf('-');
	var displayLength = 15;
	if (pos > 0) {
		var displayLength = new Number(set.substr(pos+1,set.length));
		set = set.substr(0,pos);
		console.log(set+' || '+displayLength);
	}
	dataTableContainer = $('.dataTable').dataTable({
		'bLengthChange':	false,
		'bFilter':			false,
		'iDisplayLength':	displayLength,
		'oLanguage':		{ 'sUrl': '/libs/jquery/plugins/german.datatable.txt' },
		'sAjaxSource': '/ajax.php?tbl='+set
	});	
}

