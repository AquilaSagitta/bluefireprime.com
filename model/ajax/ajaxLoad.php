		<script src="jquery.js"></script>
		<script>
		$(document).ready(function() {
			$(".delete").click(function() {
				var item = $(this).parent();
				var id = $(this).attr('rel');
				
				$.post('model/ajax/ajaxDelete.php', {'id' : id}, function(data) {
					$(item).hide();
				});
			});
		});
		</script>

<?php
	include('../config.php');
	
	foreach ($data as $key => $value)
	{
		echo '<div>' . $value['message'] . ' <a href="#" class="delete" rel="'.$value['id'].
		'">Delete</a></div>';
	}
?>