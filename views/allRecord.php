<html>
	<head>
		<meta charset="utf-8">
		<title>Records</title>
	</head>
	<body><h3>It's result</h3>
		<?php
			foreach ($mass as $k => $val) {
				echo("<div>".$val['name']." status updated: ".$val['status']."</div>");
			}
		?>
	</body>
</html>

