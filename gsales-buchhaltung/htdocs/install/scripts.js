$(document).ready(function() {
	$('#install').submit(function() {
		var dirs = $.extend({
			data: $('#dirs-data').val(),
			compile: $('#dirs-compile').val(),
			cache: $('#dirs-cache').val()
		});
		var db = $.extend({
			adapter: $('#db-adapter').val(),
			hostspec: $('#db-hostspec').val(),
			username: $('#db-username').val(),
			pw: $('#db-password').val(),
			database: $('#db-name').val(),
		});
		var api = $('#api-key').val();
		checkDirs(dirs);
		checkDb(db);
		return false;
	});
});

function checkDirs(dirs) {
	$.post('/install/index.php',{ check: 'dirs', datadir: dirs.data, compile: dirs.compile, cache: dirs.cache }, function(res) {
		var wId = res.substr(0,res.indexOf(':'));
		var msg = res.substr(res.indexOf(':'), res.length);
		if (res != 'OK') {
			$(wId).css({ borderColor : 'red' });
			$(wId).after('<img src="/media/img/folder_error.png" alt="'+msg+'" title="'+msg+'" style="margin-left:5px;" />');
			$('#msg').html('<img src="/media/img/warning_48.png" align="absmiddle" style="width:30px;height:30px;" /> ' + msg).show();
		}
	});
}

function checkDb(dbdata) {
	$.post('/install/index.php', {check: 'db', data: dbdata }, function(res) {
		var wId = res.substr(0,res.indexOf(':'));
		var msg = res.substr(res.indexOf(':'), res.length);
		if (res != 'OK') {
			$(wId).css({ borderColor: 'red' });
			$(wId).after('<img src="/media/img/database_error.png" alt="'+msg+'" title="'+msg+'" style="margin-left:5px;" />');
			$('#msg').html('<img src="/media/img/warning_48.png" align="absmiddle" style="width:30px;height:30px;" /> '+msg).show();
		}
	});
}