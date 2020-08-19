<!DOCTYPE html>
<html>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "happytest";
	$conn = mysqli_connect($servername, $username, $password, $db);
    

 	$results = $conn->query("SELECT u.id, u.first_name, u.last_name, tu.team_id, GROUP_CONCAT( t.name ) as 'names' FROM users u left join teams_users tu on u.id = tu.user_id left join teams t on tu.team_id = t.id group by u.id");
 	
 	$users = array();
 	
 	while($user = $results->fetch_assoc()) {
		$users[] = array(
			'ID' => $user["id"],
			'NAME' => $user["first_name"] . "   " . $user["last_name"],
			'TEAMS' => $user["names"]
		);
	}
?>

<head>
	<title>The Happiest Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style>
		th {
			font-size: 30px;
		}
		td {
			font-size: 15px;
		}
	</style>
</head>
<body>
	<div class="container" style="margin-top: 10%">
		<table class="table table-bordered">
			<tr>
				<th class="col-sm">ID</th>
				<th class="col-sm">NAME</th>
				<th class="col-sm">TEAMS</th>
			</tr>
			<?php if(count($users) > 0) { ?>
				<?php foreach($users as $id=>$user) { ?>
					<tr>
						<td class="col-sm"><?php echo $user['ID'] ?></td>
						<td class="col-sm"><?php echo $user['NAME'] ?></td>
						<td class="col-sm"><?php echo $user['TEAMS'] ?></td>
					</tr>
	    		<?php } ?>	
	    	<?php } ?>
	    	
	    	<?php if(count($users) === 0) { ?>
	    		<tr>
	    			<td colspan="3">No DATA</td>
	    		</tr>
	    	<?php } ?>
		</table>
	</div>		
</body>
</html>