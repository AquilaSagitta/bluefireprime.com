<html>
	<head>
		<title><?php echo 'Vertical | Home'; ?></title>
		<meta></meta>
		<link rel="stylesheet" type="text/css" href="view/css/main.css"/>
		<script src="jquery.js"></script>
	</head>

	<body>
	<div id="logo">
		<h1>Vertical</h1>
	</div>
	<div id="nav">
		<ul>
			<li id="nav-map">Map</li>
			<li id="nav-feed">Feed</li>
		</ul>
	</div>
	<div id="search">
		<form id="search-bar" class="ajax">
			<input id="search-bar-query" type="text" name="searchQuery" placeholder="Search"></input>
			
			<input type="submit" value="Search"></input>
		</form>
	</div>
	<div id="tags"></div>
	<div id="notifications"></div>
	<button class="posts-toggle">Hide</button>
	<button class="posts-toggle" style="display:none">Show</button>
	<div id="posts"></div>
	<div id="content"></div>
	
	<!--Scripts!-->
	<script src="view/js/feed.js"></script>
	<script src="view/js/formHandler.js"></script>
	<script src="view/js/header.js"></script>
	<script src="view/js/map.js"></script>
	<script src="view/js/posts.js"></script>

</body>
</html>