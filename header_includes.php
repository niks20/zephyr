<!-- The basic stylesheet (css) and javascript files to be included -->

<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link rel="stylesheet" href="css/jasny.fileinput.css" />
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jasny.fileinput.js"></script>

<script type="text/javascript">

	$(function()
	{
		var availableTags = <?php echo json_encode(get_merged_search_array()); ?>;
		$( "#search_bar" ).autocomplete({ source: availableTags });
	});

	$(function()
	{
		var availableTags = <?php echo json_encode(get_all_users_array_search()); ?>;
		$( "#user_search_bar" ).autocomplete({ source: availableTags });
	});

</script>