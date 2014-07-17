<html>
	<head>
		<title>Chat</title>
		<script src="jquery.js"></script>
		<script>
		$(document).ready(function() {
			$("#messages").load('../model/ajax/ajaxLoad.php')
			
			$("#type").change(function() {
				
				typeQuery($(this).val());
			});
			
			$("#userArea").submit(function() {
				
				$.post('../model/ajax/ajaxPost.php', $('#userArea').serialize(), function(data) {
					$("#messages").append('<div>'+data+'</div>');
				});
				
				return false;
			});
			
		});
		
		function typeQuery(type) {
			switch (type) {
			case 'chat':
				$('#userArea').load('view/forms/chat.html');
				break;
			case 'aar':
				$('#userArea').load('view/forms/aar.html');
				break;
			case 'alert':
				$('#userArea').load('view/forms/alert.html');
				break;
			}
		}
		</script>
	</head>
	
	<body>
		<!-- Display !-->
		<div id="messages"></div>
		
		<!-- Post !-->
		<form id="userArea">
		<label>Message</label>
			<input type="text" maxlength="255" name="message" />

			<label>Type</label>
			<select id="type">
			<option name="default" value="default" selected="selected">Chat</option>
			<option name="aar" value="aar">After Action</option>
			<option name="alert" value="alert">Alert</option>
			</select>

			<label></label>
			<input type="submit" value="Post Message"/>
		</form>
	</body>
</html>