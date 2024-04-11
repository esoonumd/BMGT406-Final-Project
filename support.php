<?php
function tableExists($pdo, $table) {

		// Try a select statement against the table
		// Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
		try {
				$result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
		} catch (Exception $e) {
				// We got an exception == table not found
				return FALSE;
		}

		// Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
		return $result !== FALSE;
}

function generatePage($title, $body) {
$page = <<<EOPAGE
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>UMCP Event Signup</title>
  <link type="text/css" href='css/layout.css' rel="stylesheet">
  <link rel="shortcut icon" href="images/umd.jpeg" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<body class="container">
	<!-- #header -->
	<header class="container">
		
	</header>
	<!-- /#header -->

	<!-- #navigation -->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href="http://www.umd.edu" title="UMCP" rel="home">UMCP</a></li>
				<li class="nav-item active"><a class="nav-link" href="./InsertUsers.html" title="Insert Users" rel="IU">Insert Users</a></li>
				<li class="nav-item active"><a class="nav-link" href="./InsertEvents.html" title="Insert Events" rel="IE">Insert Events</a></li>
			</ul>
		</div>
	</nav>
	<!-- /#navigation -->

		<article class="container">
				
				$body
			
		</article>
	<!-- #footer -->
	<footer>
		
		<div id="fb-like">

			<iframe src="https://www.facebook.com/plugins/like.php?href=http://www.umiacs.umd.edu/~louiqa/2016/BMGT406/" style="border:none; width:450px; height:80px"></iframe>

		</div>
	</footer>
</body>	
</html>
EOPAGE;

return $page;
}
?>
