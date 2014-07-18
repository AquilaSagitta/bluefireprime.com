$(document).ready(function() {
	//open login form into hidden div
	$('#login-button').click(function() {
		$('#login-wrapper').load("view/forms/login.html", function() {
			$('input').first().focus(); //focus first input
			$(this).submit(function() {
				//get all inputs besides submit
				var input = $('input').not('input[type=Submit]');
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
					console.log(check);
				});
				if(!check) {
					//input isn't valid so break out of function
					return false;
				} else {
					//input is valid so send it to model
					var item = $.post('pubmod/json/login.php', $('#login-form').serialize());
					item.done(function(data){
						//response. Notify user if error or welcome them if logged in successfully
						if(data=="User doesn\'t exist!") {
							$('#notifications').html(data); //this should never happen but just in case
						} else if(data=="Incorrect username or password!") {
							$('#notifications').html(data);
						} else {
							$('#login-wrapper').html('Welcome '+data+'!');
						}
					});
					item.error(function(){
						//errors go to hidden notifications div
						$('#notifications').html('Error: Something broke');
					});
					return false; //don't reload page on submit
				}
			});
		});
	});
});