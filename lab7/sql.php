<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <form action="./sql.php" method="post" enctype="multipart/form-data">

  <?php

	?>
  <input type="text" name ="dbname" size="100" maxlength="100" />
  <input type="text" name ="query" size="100" maxlength="100" />
  <div id="submitbutton">
    <input type="submit" value="submit" />
  </div>
  <?php
  $dbname = $_POST["dbname"];

  $db = new PDO("mysql:dbname=$dbname", "root", "root");
  $Query = $_POST["query"];
  $rows = $db->query($Query);

  foreach ($rows as $row){

  ?>
  <div>
    <?php
    // for($i = 0 ; $i < 6; $i ++){
    foreach ($row as $key => $value) {
      # code...

    ?>
    <li> <?= $value ?></li>

  <?php
}
  }
  ?>
  </div>
</body>
</html>
