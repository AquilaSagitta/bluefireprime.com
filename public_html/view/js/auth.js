//login button clicked
$('#login-button').unbind().bind('click',function() {
	//load login form
	$('#login-wrapper').load("view/forms/login.html", function() {
		$('input').first().focus(); //focus first input
		$('input[value=Login]').unbind().bind('click', function() {
			if(!validate('user','text',0)||!validate('pass','text',0)) {
				notify('Fill required fields!');
				return false;
			}
			if(!validate('honey','trap',0)) return;
			$.post('/index.php', $('#login-form').serialize()+"&login="+encodeURIComponent(true), function(data) {
				console.log(data);
				$('#login-wrapper').html(data);
				if(!data.verified) notify('You\re not verified!<button id="getVerified">Verify</button>');
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
			if(!validate('user','text',0)||!validate('pass','text',0)||!validate('pass2','text',0)) {
				notify('Fill required fields!');
				return false;
			}
			if(!validate('pass','password','pass2')) {
				notify('Passwords don\'t match!');
				return false;
			}
			$.post('/index.php', $('#login-form').serialize()+"&register="+encodeURIComponent(true), function(data) {
				console.log($('#login-form').serialize()+"&register="+encodeURIComponent(true));
				$('#login-wrapper').html(data);
			});
			return false;
		});
	});
	return false;
});

$('#notifications').on('click','#getVerified', function(){
	$('#notifications').empty();
	$('#login-wrapper').load('/view/forms/verify.html', function(){
		$('input').first().focus(); //focus first input
		$('input[value=Verify]').unbind().bind('click', function(){
			if($('input[name=email]').val()>50) notify('Email too long! Must be shorter then 50 characters.');
			$.post('/index.php', $('#verify-form').serialize()+"&register="+encodeURIComponent(false), function(data){
				console.log(data);
				$('#login-wrapper').html(data);
			});
			return false;
		});
	});
});

$('#notifications').on('click','.note-close', function(){
	$(this).parent().remove();
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