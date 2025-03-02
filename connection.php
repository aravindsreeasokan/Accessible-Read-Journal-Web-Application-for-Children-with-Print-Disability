<?php
	$servername='localhost';
			$dbuser='aravind';
			$dbpass='aravind';
			$dbname='recommend_db';
			$con=mysqli_connect($servername,$dbuser,$dbpass,$dbname);
			if(!$con)
			{
				echo"Failed connecting to database";
			}
?>
