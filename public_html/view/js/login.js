$(document).ready(function() {
	var user;
	//open login form into hidden div
	$('#login-button').click(function() {
		$('#login-wrapper').load("view/forms/login.html", function() {
			//check which submit button was clicked
			var registerClicked = false;
			var loginClicked = false;
			var verifyClicked = false;
			$('input[value=Login]').click(function(){
				//console.log('loginclicked');
				loginClicked=true;
			});
			$('input[value=Register]').click(function(){
				//console.log('registerclicked');
				registerClicked=true;
			});
			$('#login-wrapper').on('click','input[value=Verify]',function(){
				//console.log('verifyclicked');
				verifyClicked=true;
			});
			
			$('input').first().focus(); //focus first input
			
			$(this).unbind('submit').bind('submit',function() {
				//bot trap
				if($('input[name=honey]').val()) {
					return;
				}
				//get all inputs besides submit
				var input = $('input').not('input[type=Submit],input[type=hidden]');
				//check input is valid(isn't empty)
				var check;
				$(input).each(function(){
					if(!$(this).val()) {
						$(this).addClass("error");
						check = false
					} else {
						$(this).removeClass("error");
						check = true;
					}
					//console.log(check);
				});
				if(!check) {
					//input isn't valid so break out of function
					return false;
				} else if(loginClicked) {
					//input is valid so send it to model
					loginClicked=false; //so doesn't fire again unless clicked again
					var item = $.post('pubmod/json/login.php', $('#login-form').serialize());
					item.done(function(data){
						//response. Notify user if error or welcome them if logged in successfully
						if(data=="User doesn\'t exist!") {
							notification(data); //this should never happen but just in case
						} else if(data=="Incorrect username or password!") {
							notification(data);
						} else {
							user = data;
							$('#login-wrapper').html('Welcome '+data+'!');
							$('#notifications').empty();
							checkVerify(data);
						}
					});
					item.error(function(){
						//errors go to hidden notifications div
						notification('Error: Something broke');
					});
					return false; //don't reload page on submit
				} else if(registerClicked) {
					//input is valid so send it to model
					registerClicked=false; //so doesn't fire again unless clicked again
					var item = $.post('pubmod/json/register.php', $('#login-form').serialize());
					item.done(function(data){
						//response. Check if username or password is long enough.
						//Then check if duplicate username. Inform user upon success or failure.
						if(data=='Username is too short! Must be at least 5 characters.'||data=='Password is too short! Must be at least 5 characters.') {
							notification(data);
						} else if(data.indexOf('Duplicate')>-1) {
							notification('Username is already taken!');
						} else {
							user = data;
							$('#login-wrapper').html('Successfully registered as '+data+'!');
							$('#notifications').empty();
							checkVerify(data);
						}
					});
					item.error(function(){
						//errors go to hidden notifications div
						$('#notifications').html('Ajax failed!');
					});
					return false; //don't reload page on submit
				} else if(verifyClicked) {
					//input is valid so send it to model
					verifyClicked=false; //so doesn't fire again unless clicked again
					var val = $('input[name=email]').val();
					if(val.length>50) {
						$('input[name=email]').addClass('error');
						notification('Email must be under 50 characters!');
						return false;
					}
					var item = $.post('pubmod/json/verify.php', $('#verify-form').serialize()+"&user="+encodeURIComponent(user));
					console.log('ajax to email server');
					item.done(function(data){
						//response.
						$('#login-wrapper').html(data);
					});
					item.error(function(){
						//errors go to hidden notifications div
						$('#notifications').html('Ajax failed!');
					});
					return false; //don't reload page on submit
				}
			});
		});
	});
	$('#notifications').on('click', '.note-close', function(){
		$(this).parent().remove();
	});
	$('#notifications').on('click', '#verify-button', function(){
		$('#notifications').empty();
		$('#login-wrapper').load('view/forms/verify.html');
		$('input').first().focus(); //focus first input
	});
});

function notification(message) {
	$('#notifications').append(''+
		'<div class="error">'+
		'<button class="note-close"></button>'+
		message+
		'</div>');
}

function checkVerify(username) {
	$.post('../../pubmod/json/verify.php', {name: username}, function(data){
		if(data=="false") $('#notifications').html(' '+username+' is not verified! <button id="verify-button">Click to begin verification.</button>');
	});
}