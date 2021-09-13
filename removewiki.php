<?php
// This allows a user to delete a wiki on the platform.
// PLEASE NOTE: This page is not completed yet.
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Pull the information from the database
$sql = "SELECT * FROM wikis";
$stmt = mysqli_prepare($link, $sql);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$selected_id = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($_POST["selected_id"] === "Select one wiki to delete"){
		$selected_id_err = "Please select a valid option";
	} else {
		$selected_id = trim($_POST["selected_id"]);
		// Pull folder location for selected wiki
		while($row = mysqli_fetch_array($result)){
			if($selected_id == $row['id']){
				$wiki_dir = $row['wikifolder'];
				$wiki_local = $row['wikilocal'];
			}
		}
		echo $wiki_dir;
		echo $wiki_local;
		// Delete files and folder
		echo shell_exec("rm {$wiki_dir}/api.php");
		echo shell_exec("rm {$wiki_dir}/autoload.php");
		echo shell_exec("rm {$wiki_dir}/CODE_OF_CONDUCT.md");
		echo shell_exec("rm {$wiki_dir}/composer.json");
		echo shell_exec("rm {$wiki_dir}/composer.lock");
		echo shell_exec("rm {$wiki_dir}/COPYING");
		echo shell_exec("rm {$wiki_dir}/CRDITS");
		echo shell_exec("rm {$wiki_dir}/docs");
		echo shell_exec("rm {$wiki_dir}/extensions");
		echo shell_exec("rm {$wiki_dir}/FAQ");
		echo shell_exec("rm {$wiki_dir}/HISTORY");
		echo shell_exec("rm {$wiki_dir}/img_auth.php");
		echo shell_exec("rm {$wiki_dir}/includes");
		echo shell_exec("rm {$wiki_dir}/index.php");
		echo shell_exec("rm {$wiki_dir}/INSTALL");
		echo shell_exec("rm {$wiki_dir}/jsduck.json");
		echo shell_exec("rm {$wiki_dir}/languages");
		echo shell_exec("rm {$wiki_dir}/load.php");
		echo shell_exec("rm {$wiki_dir}/LocalSettings.php");
		echo shell_exec("rm {$wiki_dir}/maintenance");
		echo shell_exec("rm {$wiki_dir}/mw-config");
		echo shell_exec("rm {$wiki_dir}/opensearch_desc.php");
		echo shell_exec("rm {$wiki_dir}/README.md");
		echo shell_exec("rm {$wiki_dir}/RELEASE-NOTES-1.35");
		echo shell_exec("rm {$wiki_dir}/resources");
		echo shell_exec("rm {$wiki_dir}/rest.php");
		echo shell_exec("rm {$wiki_dir}/SECURITY");
		echo shell_exec("rm {$wiki_dir}/skins");
		echo shell_exec("rm {$wiki_dir}/tests");
		echo shell_exec("rm {$wiki_dir}/thumb_handler.php");
		echo shell_exec("rm {$wiki_dir}/thumb.php");
		echo shell_exec("rm {$wiki_dir}/UPGRADE");
		echo shell_exec("rm {$wiki_dir}/vendor");
		echo shell_exec("rm {$wiki_dir}/cache/ -r");
		echo shell_exec("rm {$wiki_dir}/images/ -r");
		
		// Delete mysql database
		
		// Remove wiki from mwadmin db
	}

}
?>

<!DOCTYPE html>
<?php include_once("menu.php");?>
<html lang="en">
<head>
    <title>Delete Wiki - MWAdmin</title>
</head>
<body>
	<div class="content">
		<h2>Delete a wiki below</h2>
		<p style="color: red">Please Note this is not reversable</p>
		<p>Please select the wiki you wish to delete</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<select name="selected_id" id="selected_id" class="form-control">
				<option selected="selected" >Select one wiki to delete</option>
				<?php
				while($row = mysqli_fetch_array($result)){
					$id = $row['id'];
					$wikiname = $row['wikiname'];
					echo "<option value='$id'>$wikiname</option>";
				}
				?>
			</select>
			<input type="submit" class="btn btn-primary" value="Submit">
		</form>
		<?php
		mysqli_stmt_close($stmt);
		mysqli_close($link); ?>
	</div>
</body>
</html>