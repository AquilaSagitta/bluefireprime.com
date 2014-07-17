(function poll() {
	var request = $.ajax({url: "model/ajax/ajaxTest.php"})
	request.fail(function(jqXHR, textStatus, errorThrown) {
		if(textStatus === "timeout") {
			console.log("timedout");
		} else {
			console.log(errorThrown);
		}
	});
	request.done(function(data) {
		console.log("success");
		$('#posts').html(data);
	});
	request.always(function() {
		console.log("Polled");
		setTimeout(poll, 2000);
	});
})();

$(document).ready(function() {
	$('.posts-toggle').click(function() {
		$('#posts').toggle("slow");
		$('.posts-toggle').toggle();
	});
});