$(document).ready(function () {
	$("#nav-map").click(function() {
		$("#content").load('view/map.php');
	});
	$("#nav-feed").click(function() {
		$("#content").load('view/feed.php');
	});
});