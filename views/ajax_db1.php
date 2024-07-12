<?php
session_start();
require('../config.php');
?>
<?php

if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
    ?>
    <?php
    $id = $_POST['id'];
  	$sql = "SELECT * FROM amphures WHERE province_id='$id'";
  	$query = mysqli_query($mysqli, $sql);
  	echo '<option value="" selected disabled>-กรุณาเลือกอำเภอ-</option>';
  	While($value = mysqli_fetch_array($query)){ 
      $Districts_id = $value["id"];
      ?>
      <option value="<?php echo $value['id']?>" <?php if($Districts_id == $App_districts_id){?>selected="selected"<?php }?>><?php echo $value['name_th'] ?></option>';
      <?php }?>
  <?php }?>
<?php 
if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE amphure_id='$id'";
    $query = mysqli_query($mysqli, $sql);
    echo '<option value="" selected disabled>-กรุณาเลือกตำบล-</option>';
    While($value2 = mysqli_fetch_array($query)){ 
  ?>
  <option value="<?php echo $value2['id']?>"><?php echo $value2['name_th']?></option>';
  <?php }?>
  <?php }?>
  <?php 
  if (isset($_POST['function']) && $_POST['function'] == 'districts') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE id='$id'";
    $query3 = mysqli_query($mysqli, $sql);
    $result = mysqli_fetch_assoc($query3);
    echo $result['zip_code'];
    exit();
  }
?>