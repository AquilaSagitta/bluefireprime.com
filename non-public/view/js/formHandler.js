$(document).ready(function () {
	
	var empty_fields;
	
	//check for empty required fields
	$("#content, #search").on("blur", ".required", function() {
		console.log("blur fired");
		
		empty_fields = 0;
		$(".required").each(function() {
			if(!$(this).val()) {
				empty_fields++;
			}
			$("#notifications").html(empty_fields+"<br/>");
		});
	});

	//logic for search bar
	$("#search").on("submit", ".ajax", function() {
	
		//check if search bar else send to db
		if(!$(this).children("#search-bar-query").val()) {
			//send to advanced search
			$("#notifications").html("sent to adv search"+"<br/>");
		} else if($(this).children("#search-bar-query").val()!="") {
			//send to search logic
			$("#notifications").html("search logic"+"<br/>");
		}
		
		//stop page refresh on submit
		return false;
	});
	
	//NOTE:----------------------------------------
	//Enter key bypasses validation

	//logic for content forms
	$("#content").on("submit", ".ajax", function() {
		console.log("submit fired");
		
		//check for empty required fields
		if(!empty_fields) {
			
			var data = $(this).children("input").serialize();
			$("#notifications").html(data+"<br/>");
			$.post("../../model/ajax/ajaxPost.php", data, function(response) {
				$("#notifications").append(response+"<br/>");
			});
		}
		
		//stop page refresh on submit
		return false;
	});
});