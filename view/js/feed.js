$(document).ready(function () {
	
	//load posts
	$("#nav").on("click", "#nav-feed", function() {
		$("#posts").load("view/posts.php");
	});
	
	//Type buttons to make new posts
	$("#content").on("click", "#content-type-chat", function() {
		$("#content-new").load('view/forms/chat.html' ,function () {
			$(this).find("input:visible:first").focus();
			$(this).find("input:visible:first").blur();
			$(this).find("input:visible:first").focus();
		});
	});
	$("#content").on("click", "#content-type-aar", function() {
		$("#content-new").load('view/forms/aar.html' ,function () {
			$(this).find("input:visible:first").focus();
			$(this).find("input:visible:first").blur();
			$(this).find("input:visible:first").focus();
		});
	});
	$("#content").on("click", "#content-type-ping", function() {
		$("#content-new").load('view/forms/ping.html' ,function () {
			$(this).find("input:visible:first").focus();
			$(this).find("input:visible:first").blur();
			$(this).find("input:visible:first").focus();
		});
	});
});
