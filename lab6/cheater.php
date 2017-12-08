<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>

		<?php
		# Ex 4 :
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if(
			!isset($_POST["name"])||!isset($_POST["name"])||!isset($_POST["course"])
			||!isset($_POST["grade"])||!isset($_POST["cardnumber"])||!isset($_POST["cardtype"])
			||empty($_POST["name"])||empty($_POST["id"])||empty($_POST["course"])
			||empty($_POST["grade"])||empty($_POST["cardnumber"])||empty($_POST["cardtype"])
		){
		?>

		<!-- Ex 4 :
			Display the below error message :
		-->


			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="./gradestore.html">Try again?</a></p>



		<?php
		# Ex 5 :
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		}
		elseif (!preg_match('/^[a-zA-Z]+(-[a-zA-Z]+)*([\s]?[a-zA-Z]+(-[a-zA-Z]+)*)?$/', $_POST["name"])) {
		?>
		<h1>Sorry</h1>
		<p>You didn't provide a valid name. <a href="./gradestore.html">Try again?</a></p>
		<!-- Ex 5 :
			Display the below error message :
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		-->

		<?php
		# Ex 5 :
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5.
		} elseif (
			(!preg_match('/^[4][0-9]{15}/', $_POST['cardnumber'])&& preg_match("/visa/", $_POST['cardtype']))||(!preg_match('/^[5][0-9]{0,15}/', $_POST['cardnumber']) && preg_match("/mastercard/", $_POST['cardtype']))
		) {
		?>

		<!-- Ex 5 :
			Display the below error message :

		-->
		<h1>Sorry</h1>
		<p>You didn't provide a valid credit card number. <a href="./gradestore.html">Try again?</a></p>
		<?php
		# if all the validation and check are passed
		 }else {
		?>

			<h1>Thanks, looser!</h1>
			<p>Your information has been recorded.</p>

			<!-- Ex 2: display submitted data -->
			<ul>
				<li>Name:<?= $_POST["name"]; ?> </li>
				<li>ID: <?= $_POST["id"]; ?></li>
				<li>Course: <?= processCheckbox($_POST["course"]);?></li>
				<li>Grade: <?= $_POST["grade"]; ?></li>
				<li>Credit <?= $_POST["cardnumber"];?>  (<?= $_POST["cardtype"]; ?>)</li>
			</ul>

			<!-- Ex 3 :
				<p>Here are all the loosers who have submitted here:</p> -->
			<?php
				$filename = "loosers.txt";
				$contents=$_POST['name'].';'.$_POST['id'].';'.$_POST['cardnumber'].';'.$_POST['cardtype'];
	   			file_put_contents("loosers.txt",$contents."\n",FILE_APPEND);
				/* Ex 3:
				 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
				 * For example, "Scott Lee;20110115238;4300523877775238;visa"
				 */
			?>

			<!-- Ex 3: Show the complete contents of "loosers.txt".
				 Place the file contents into an HTML <pre> element to preserve whitespace -->
			<p>Here are all the loosers who have submitted here:</p>

			<?php
				$fileget = file_get_contents($filename);
				$filegets = explode("\n", $fileget);
				foreach($filegets as $items){
			?>
				<pre><?= $items ?></br></pre>

			<?php
				}
			?>

		<?php
		}
		?>

		<?php
			/* Ex 2:
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 *
			 * The function checks whether the checkbox is selected or not and
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				$course = implode(",", $names);

				return $course;
			}


		?>

	</body>
</html>
