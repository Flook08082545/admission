<?php
session_start();
require('../config.php');
?>

<!-------------------------------อำเภอ--------------------------------->
<?php

if (isset($_POST['function']) && $_POST['function'] == 'edu_qualification') {
    ?>
    <?php 
    $id = $_POST["id"];
  	$sql = "SELECT * FROM stady_plan WHERE education_id='$id'";
  	$query = mysqli_query($mysqli, $sql);
  	echo '<option value="" selected disabled>-กรุณาเลือกแผนการเรียน-</option>';
  	While($value = mysqli_fetch_array($query)){ 
      ?>
      <option value="<?php echo $value['stady_plan_id'];?>"><?php echo $value['stady_plan'];?></option>';
      <?php }?>
      <option value="-1">อื่นๆ</option>
  <?php }?>