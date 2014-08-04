//login button clicked
$('#login-button').unbind().bind('click',function() {
	//load login form
	$('#login-wrapper').load("view/forms/login.html", function() {
		$('input').first().focus(); //focus first input
		$('input[value=Login]').unbind().bind('click', function() {
			if(!validate('user','text',0)||!validate('pass','text',0)) return false;
			if(!validate('honey','trap',0)) return;
			$.post('/index.php', $('#login-form').serialize()+"&login="+encodeURIComponent(true), function(data) {
				console.log(data);
				$('#login-wrapper').html(data);
			});
			return false;
		});
	});
});

$('#login-wrapper').on('click','input[value=ToRegister]', function(){
	if($('input[name=user]').val()) var user = $('input[name=user]').val();
	if($('input[name=pass]').val()) var pass = $('input[name=pass]').val();
	$('#login-wrapper').load('view/forms/register.html', function(){
		if(user) {
			$('input[name=user]').val(user);
			$('input[name=pass]').focus();
		}
		if(pass) {
			$('input[name=pass]').val(pass);
			$('input[name=pass2]').focus();
		}
		if(!user&&!pass) $('input').first().focus(); //focus first input
		$('input[value=Register]').unbind().bind('click', function(){
			if(!validate('user','text',0)||!validate('pass','text',0)||!validate('pass2','text',0)) return false;
			if(!validate('pass','password','pass2')) return false;
			$.post('/index.php', $('#login-form').serialize()+"&register="+encodeURIComponent(true), function(data) {
				console.log(data);
				$('#login-wrapper').html(data);
			});
			return false;
		});
	});
	return false;
});

function validate(inputName, type, check) {
	switch (type) {
		case 'text':
			if($('input[name='+inputName+']').val()) {
				$('input[name='+inputName+']').removeClass('error');
				return true;
			} else {
				$('input[name='+inputName+']').addClass('error');
				return false;
			}
		break;
		case 'trap':
			if($('input[name='+inputName+']').val()) return false;
			else return true;
		break;
		case 'password':
			if($('input[name='+inputName+']').val()===$('input[name='+check+']').val()) {
				$('input[name='+inputName+']').removeClass('error');
				$('input[name='+check+']').removeClass('error');
				return true;
			} else {
				notify('Passwords don\'t match!')
				$('input[name='+inputName+']').addClass('error');
				$('input[name='+check+']').addClass('error');
				return false;
			}
		break;
		default: console.log(type+' is not valid for this function!');
	}
}

function notify(message) {
	$('#notifications').append(''+
		'<div class="error">'+
		'<button class="note-close"></button>'+
		message+
		'</div>');
}