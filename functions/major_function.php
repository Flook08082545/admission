<?php
    session_start();
    require('../config.php');
?>
<?php if($_SESSION["national_id"] AND $_SESSION["TCAS_round"] == 1) {?>
<?php
    $major=$_POST["major"];
    $textnew = $_POST["textnew"];
    $education_id = $_POST["education_id"];
    $national_id_new = $_POST["national_id"];
    $province = $_POST["Ref_prov_id"];
    $district = $_POST["Ref_dist_id"];
    $sub_district = $_POST["Ref_subdist_id"];
    $zip_code = $_POST["zip_code"];
    $edu_qualification = $_POST["edu_qualification"];
    $Study_plan = $_POST["Study_plan"];
    $school = $_POST["School_name"];
    $gpax = $_POST["gpax"];
    $major_id = $_POST["major_id"];

    $sql = "SELECT * FROM education_student WHERE national_id = $national_id_new";
    $query = mysqli_query($mysqli,$sql);
    $num = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $Study_plan_id = $row["study_plan"];
    $file_name_round1 = $row["file"];

    $sqli = "SELECT * FROM major WHERE major_id = $major";
    $queryi = mysqli_query($mysqli,$sqli);
    $resulti = mysqli_fetch_array($queryi);
    $grade_major = $resulti["grade"];

    $msgError='';

    if(isset($_FILES['files'])){
       $errors= array();
       $file_name = $_FILES['files']['name'];
       $file_size = $_FILES['files']['size'];
       $file_tmp = $_FILES['files']['tmp_name'];
       $file_type = $_FILES['files']['type'];
 
       // หานามสกุลไฟล์ที่เลือก
       $file_ext=strtolower(end(explode('.',$_FILES['files']['name'])));
       
       
       // กำหนดไฟล์ที่สามารถอับโหลดได้
       $extensions= array("jpeg","jpg","png","gif","doc","docx","xls","xlsx","pdf","ppt","pptx"); 
       
 
       //กำหนดชื่อไฟล์ใหม่เนื่องจากกลัวจะซ้ำ
       if($_FILES['files']['name'] == ""){
        $new_file_name = $file_name_round1;
      }else{
     $new_file_name=date("Ymd-His").".".$file_ext;
    }
 
       
       // ตรวจสอบว่าเป็นไฟล์ชนิดที่กำหนดหรือไม่
       if(in_array($file_ext,$extensions)=== false){
          $msgError="กรุณาเลือกไฟล์ที่กำหนดไว้ในระบบ <br>";
       }
       
       
       // ตรวจสอบขนาดไฟล์ว่าเกิน 2 MB หรือไม่
       if($file_size > 2097152) {
         $msgError.="ขนาดไฟล์ใหญ่เกิน 2 MB <br>";
       }
 
 
       // ถ้าไม่มี Error ให้อับโหลดไฟล์ได้
       if($msgError=='') {
          move_uploaded_file($file_tmp,"uploads/".$new_file_name);
          echo "อับโหลดเรียบร้อย";
       }else{
          echo $msgError;
       }
    }
?>

<?php 
if($num == 1){
    if($gpax >= $grade_major){
            $selected_stady_plan = $_POST["Study_plan"];
            if($selected_stady_plan == -1){
                $selected_stady_plan_name = $_POST["other_stady_plan_round1"];
                
                $sql_stady_plan = "SELECT * FROM stady_plan WHERE stady_plan_id = $Study_plan_id";
                $query_stady_plan = mysqli_query($mysqli,$sql_stady_plan);
                $num_stady_plan = mysqli_fetch_array($query_stady_plan);
                $selected_stady_plan = $num_stady_plan["stady_plan_id"];
                $Study_plan_name = $num_stady_plan["stady_plan"];

                if($selected_stady_plan_name == $Study_plan_name){
                    $update_sql_plan = "UPDATE `stady_plan` SET `education_id` = '$edu_qualification', `stady_plan` = '$selected_stady_plan_name' WHERE `stady_plan`.`stady_plan_id` = $selected_stady_plan";
                    mysqli_query($mysqli,$update_sql_plan);
                }else if($selected_stady_plan_name != $Study_plan_name){
                    $Study_plan_insert = "INSERT INTO `stady_plan` (`stady_plan_id`, `education_id`, `stady_plan`) VALUES (NULL, '$edu_qualification','$selected_stady_plan_name')";
                    mysqli_query($mysqli,$Study_plan_insert);
                    $selected_stady_plan = mysqli_insert_id($mysqli);
                }
            }
    $update_sql = "UPDATE `education_student` SET `national_id` = '$national_id_new', `school` = '$school', `education_qualification` = '$edu_qualification', `study_plan` = '$selected_stady_plan', `average_GPA` = '$gpax', `major_id` = '$major', `file` = '$new_file_name', `province_of_school` = '$province
    ', `district_of_school` = '$district', `subdistrict_of_school` = '$sub_district', `zip_code` = '$zip_code' WHERE `education_student`.`education_id` = $education_id";
    mysqli_query($mysqli,$update_sql);
?>
<script>
			alert("อัพเดทเรียบร้อยแล้ว");
			location.href='../views/print.php?national_id=<?php echo $national_id_new;?>&major_id=<?php echo $major;?>&Study_plan_id=<?php echo $Study_plan_id;?>';
		</script>
<?php }else if($gpax < $grade_major){?>
<script>
			alert("ไม่สารถใส่ข้อมูลนี้ได้เนื่องจากเกรดเฉลี่ยต่ำกว่าเงื่อนไขที่กำหนด!!");
			location.href='../views/login.html';
		</script>
<?php }?>
<?
}else if($num == 0){
    if($gpax >= $grade_major){
    $selected_stady_plan = $_POST["Study_plan"];
    if($selected_stady_plan == -1){
        $selected_stady_plan_name = $_POST["other_stady_plan_round1"];
        $Study_plan_insert = "INSERT INTO `stady_plan` (`stady_plan_id`, `education_id`, `stady_plan`) VALUES (NULL, '$edu_qualification', '$selected_stady_plan_name')";
        mysqli_query($mysqli,$Study_plan_insert);
        $selected_stady_plan = mysqli_insert_id($mysqli);
    }
        
    $insert_sql = "INSERT INTO `education_student` (`education_id`, `national_id`, `school`, `education_qualification`, `study_plan`, `average_GPA`, `major_id`, `file`, `province_of_school`, `district_of_school`, `subdistrict_of_school`, `zip_code`) VALUES (NULL, '$national_id_new', '$school', '$edu_qualification', '$selected_stady_plan', '$gpax', '$major', '$new_file_name', '$province', '$district', '$sub_district', '$zip_code')";
    mysqli_query($mysqli,$insert_sql);
    ?>
<script>
			alert("บันทึกเรียบร้อยแล้ว");
			location.href='../views/print.php?national_id=<?php echo $national_id_new;?>&major_id=<?php echo $major;?>';
		</script>
<?php }else if($gpax < $grade_major){?>
    <script>
			alert("ไม่สารถใส่ข้อมูลนี้ได้เนื่องจากเกรดเฉลี่ยต่ำกว่าเงื่อนไขที่กำหนด!!");
			location.href='../views/login.html';
		</script>
<?php }?>
<?php }?>
<?php }else if($_SESSION["national_id"] AND $_SESSION["TCAS_round"] == 2){?>
<?php
    $major=$_POST["major"];
    $major1=$_POST["major1"];
    $major2=$_POST["major2"];
    $major3=$_POST["major3"];
    $textnew = $_POST["textnew"];
    $education_id = $_POST["education_id"];
    $national_id_new = $_POST["national_id"];
    $province = $_POST["Ref_prov_id"];
    $district = $_POST["Ref_dist_id"];
    $sub_district = $_POST["Ref_subdist_id"];
    $zip_code = $_POST["zip_code"];
    $edu_qualification = $_POST["edu_qualification"];
    $Study_plan = $_POST["Study_plan"];
    $school = $_POST["School_name"];
    $gpax = $_POST["gpax"];
    $major_id = $_POST["major_id"];

    $sql = "SELECT * FROM education_student_round2 WHERE national_id = $national_id_new";
    $query = mysqli_query($mysqli,$sql);
    $num = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $Study_plan_id = $row["study_plan"];
    $file_name_round2 = $row["file"];

    $sqli = "SELECT * FROM major WHERE major_id = $major";
    $queryi = mysqli_query($mysqli,$sqli);
    $resulti = mysqli_fetch_array($queryi);
    $grade_major = $resulti["grade"];

    $msgError='';

    if(isset($_FILES['files'])){
       $errors= array();
       $file_name = $_FILES['files']['name'];
       $file_size = $_FILES['files']['size'];
       $file_tmp = $_FILES['files']['tmp_name'];
       $file_type = $_FILES['files']['type'];
 
       // หานามสกุลไฟล์ที่เลือก
       $file_ext=strtolower(end(explode('.',$_FILES['files']['name'])));
       
       
       // กำหนดไฟล์ที่สามารถอับโหลดได้
       $extensions= array("jpeg","jpg","png","gif","doc","docx","xls","xlsx","pdf","ppt","pptx"); 
       
 
       //กำหนดชื่อไฟล์ใหม่เนื่องจากกลัวจะซ้ำ
       if($_FILES['files']['name'] == ""){
        $new_file_name = $file_name_round2;
      }else{
     $new_file_name=date("Ymd-His").".".$file_ext;
    }
 
       
       // ตรวจสอบว่าเป็นไฟล์ชนิดที่กำหนดหรือไม่
       if(in_array($file_ext,$extensions)=== false){
          $msgError="กรุณาเลือกไฟล์ที่กำหนดไว้ในระบบ <br>";
       }
       
       
       // ตรวจสอบขนาดไฟล์ว่าเกิน 2 MB หรือไม่
       if($file_size > 2097152) {
         $msgError.="ขนาดไฟล์ใหญ่เกิน 2 MB <br>";
       }
 
 
       // ถ้าไม่มี Error ให้อับโหลดไฟล์ได้
       if($msgError=='') {
          move_uploaded_file($file_tmp,"uploads/".$new_file_name);
          echo "อับโหลดเรียบร้อย";
       }else{
          echo $msgError;
       }
    }
?>
<?php 
if($num == 1){
    if($gpax >= $grade_major){
            $selected_stady_plan = $_POST["Study_plan"];
            if($selected_stady_plan == -1){
                $selected_stady_plan_name = $_POST["other_stady_plan_round2"];
                
                $sql_stady_plan = "SELECT * FROM stady_plan WHERE stady_plan_id = $Study_plan_id";
                $query_stady_plan = mysqli_query($mysqli,$sql_stady_plan);
                $num_stady_plan = mysqli_fetch_array($query_stady_plan);
                $selected_stady_plan = $num_stady_plan["stady_plan_id"];
                $Study_plan_name = $num_stady_plan["stady_plan"];

                if($selected_stady_plan_name == $Study_plan_name){
                    $update_sql_plan = "UPDATE `stady_plan` SET `education_id` = '$edu_qualification', `stady_plan` = '$selected_stady_plan_name' WHERE `stady_plan`.`stady_plan_id` = $selected_stady_plan";
                    mysqli_query($mysqli,$update_sql_plan);
                }else if($selected_stady_plan_name != $Study_plan_name){
                    $Study_plan_insert = "INSERT INTO `stady_plan` (`stady_plan_id`, `education_id`, `stady_plan`) VALUES (NULL, '$edu_qualification','$selected_stady_plan_name')";
                    mysqli_query($mysqli,$Study_plan_insert);
                    $selected_stady_plan = mysqli_insert_id($mysqli);
                }
            }
    $update_sql = "UPDATE `education_student_round2` SET `national_id` = '$national_id_new', `school` = '$school', `education_qualification` = '$edu_qualification', `study_plan` = '$selected_stady_plan', `average_GPA` = '$gpax', `major_id_1` = '$major', `major_id_2` = '$major1', `major_id_3` = '$major2', `major_id_4` = '$major3', `file` = '$new_file_name', `province_of_school` = '$province', `district_of_school` = '$district', `subdistrict_of_school` = '$sub_district', `zip_code` = '$zip_code' WHERE `education_student_round2`.`education_id` = $education_id;";
    mysqli_query($mysqli,$update_sql);
?>
<script>
			alert("อัพเดทเรียบร้อยแล้ว");
			location.href='../views/print.php?national_id=<?php echo $national_id_new;?>&major_id=<?php echo $major;?>&major_id_1=<?php echo $major1;?>&major_id_2=<?php echo $major2;?>&major_id_3=<?php echo $major3;?>&Study_plan_id=<?php echo $Study_plan_id;?>';
		</script>
<?php }else if($gpax < $grade_major){?>
<script>
			alert("ไม่สารถใส่ข้อมูลนี้ได้เนื่องจากเกรดเฉลี่ยต่ำกว่าเงื่อนไขที่กำหนด!!");
			location.href='../views/login.html';
		</script>
<?php }?>
<?
}else if($num == 0){
    if($gpax >= $grade_major){
    $selected_stady_plan = $_POST["Study_plan"];
    if($selected_stady_plan == -1){
        $selected_stady_plan_name = $_POST["other_stady_plan_round1"];
        $Study_plan_insert = "INSERT INTO `stady_plan` (`stady_plan_id`, `education_id`, `stady_plan`) VALUES (NULL, '$edu_qualification', '$selected_stady_plan_name')";
        mysqli_query($mysqli,$Study_plan_insert);
        $selected_stady_plan = mysqli_insert_id($mysqli);
    }
    $insert_sql = "INSERT INTO `education_student_round2` (`education_id`, `national_id`, `school`, `education_qualification`, `study_plan`, `average_GPA`, `major_id_1`, `major_id_2`, `major_id_3`, `major_id_4`, `file`, `province_of_school`, `district_of_school`, `subdistrict_of_school`, `zip_code`) VALUES (NULL, '$national_id_new', '$school', '$edu_qualification', '$selected_stady_plan', '$gpax', '$major', '$major1', '$major2', '$major3', '$new_file_name', '$province', '$district', '$sub_district', '$zip_code')";
    mysqli_query($mysqli,$insert_sql);
    ?>
<script>
			alert("บันทึกเรียบร้อยแล้ว");
			location.href='../views/print.php?national_id=<?php echo $national_id_new;?>&major_id=<?php echo $major;?>&major_id_1=<?php echo $major1;?>&major_id_2=<?php echo $major2;?>&major_id_3=<?php echo $major3;?>';
		</script>
<?php }else if($gpax < $grade_major){?>
    <script>
			alert("ไม่สารถใส่ข้อมูลนี้ได้เนื่องจากเกรดเฉลี่ยต่ำกว่าเงื่อนไขที่กำหนด!!");
			location.href='../views/login.html';
		</script>
<?php }?>
<?php }?>
<?php }else if($_SESSION["national_id"] AND $_SESSION["TCAS_round"] == 4){?>
    <?php
    $major=$_POST["major"];
    $textnew = $_POST["textnew"];
    $education_id = $_POST["education_id"];
    $national_id_new = $_POST["national_id"];
    $province = $_POST["Ref_prov_id"];
    $district = $_POST["Ref_dist_id"];
    $sub_district = $_POST["Ref_subdist_id"];
    $zip_code = $_POST["zip_code"];
    $edu_qualification = $_POST["edu_qualification"];
    $Study_plan = $_POST["Study_plan"];
    $school = $_POST["School_name"];
    $gpax = $_POST["gpax"];

    $sql = "SELECT * FROM education_student_round4 WHERE national_id = $national_id_new";
    $query = mysqli_query($mysqli,$sql);
    $num = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $Study_plan_id = $row["study_plan"];
    $file_name_round4 = $row["file"];

    $sqli = "SELECT * FROM major WHERE major_id = $major";
    $queryi = mysqli_query($mysqli,$sqli);
    $resulti = mysqli_fetch_array($queryi);
    $grade_major = $resulti["grade"];

    $msgError='';

    if(isset($_FILES['files'])){
        $errors= array();
        $file_name = $_FILES['files']['name'];
        $file_size = $_FILES['files']['size'];
        $file_tmp = $_FILES['files']['tmp_name'];
        $file_type = $_FILES['files']['type'];
  
        // หานามสกุลไฟล์ที่เลือก
        $file_ext=strtolower(end(explode('.',$_FILES['files']['name'])));
        
        
        // กำหนดไฟล์ที่สามารถอับโหลดได้
        $extensions= array("jpeg","jpg","png","gif","doc","docx","xls","xlsx","pdf","ppt","pptx"); 
        
  
        //กำหนดชื่อไฟล์ใหม่เนื่องจากกลัวจะซ้ำ
        if($_FILES['files']['name'] == ""){
         $new_file_name = $file_name_round4;
       }else{
      $new_file_name=date("Ymd-His").".".$file_ext;
     }
  
        
        // ตรวจสอบว่าเป็นไฟล์ชนิดที่กำหนดหรือไม่
        if(in_array($file_ext,$extensions)=== false){
           $msgError="กรุณาเลือกไฟล์ที่กำหนดไว้ในระบบ <br>";
        }
        
        
        // ตรวจสอบขนาดไฟล์ว่าเกิน 2 MB หรือไม่
        if($file_size > 2097152) {
          $msgError.="ขนาดไฟล์ใหญ่เกิน 2 MB <br>";
        }
  
  
        // ถ้าไม่มี Error ให้อับโหลดไฟล์ได้
        if($msgError=='') {
           move_uploaded_file($file_tmp,"uploads/".$new_file_name);
           echo "อับโหลดเรียบร้อย";
        }else{
           echo $msgError;
        }
     }
?>

<?php 
if($num == 1){
    if($gpax >= $grade_major){
            $selected_stady_plan = $_POST["Study_plan"];
            if($selected_stady_plan == -1){
                $selected_stady_plan_name = $_POST["other_stady_plan_round4"];
                
                $sql_stady_plan = "SELECT * FROM stady_plan WHERE stady_plan_id = $Study_plan_id";
                $query_stady_plan = mysqli_query($mysqli,$sql_stady_plan);
                $num_stady_plan = mysqli_fetch_array($query_stady_plan);
                $selected_stady_plan = $num_stady_plan["stady_plan_id"];
                $Study_plan_name = $num_stady_plan["stady_plan"];

                if($selected_stady_plan_name == $Study_plan_name){
                    $update_sql_plan = "UPDATE `stady_plan` SET `education_id` = '$edu_qualification', `stady_plan` = '$selected_stady_plan_name' WHERE `stady_plan`.`stady_plan_id` = $selected_stady_plan";
                    mysqli_query($mysqli,$update_sql_plan);
                }else if($selected_stady_plan_name != $Study_plan_name){
                    $Study_plan_insert = "INSERT INTO `stady_plan` (`stady_plan_id`, `education_id`, `stady_plan`) VALUES (NULL, '$edu_qualification','$selected_stady_plan_name')";
                    mysqli_query($mysqli,$Study_plan_insert);
                    $selected_stady_plan = mysqli_insert_id($mysqli);
                }
            }
    $update_sql = "UPDATE `education_student_round4` SET `national_id` = '$national_id_new', `school` = '$school', `education_qualification` = '$edu_qualification', `study_plan` = '$selected_stady_plan', `major_id` = '$major', `file` = '$new_file_name', `province_of_school` = '$province', `district_of_school` = '$district', `subdistrict_of_school` = '$sub_district', `zip_code` = '$zip_code' WHERE `education_student_round4`.`education_id` = $education_id;
    ";
    mysqli_query($mysqli,$update_sql);
    //echo $update_sql;
    //exit();
?>
<script>
			alert("อัพเดทเรียบร้อยแล้ว");
			location.href='../views/print.php?national_id=<?php echo $national_id_new;?>&major_id=<?php echo $major;?>&Study_plan_id=<?php echo $Study_plan_id;?>';
		</script>
<?php }else if($gpax < $grade_major){?>
<script>
			alert("ไม่สารถใส่ข้อมูลนี้ได้เนื่องจากเกรดเฉลี่ยต่ำกว่าเงื่อนไขที่กำหนด!!");
			location.href='../views/login.html';
		</script>
<?php }?>
<?
}else if($num == 0){
    if($gpax >= $grade_major){
    $selected_stady_plan = $_POST["Study_plan"];
    if($selected_stady_plan == -1){
        $selected_stady_plan_name = $_POST["other_stady_plan_round1"];
        $Study_plan_insert = "INSERT INTO `stady_plan` (`stady_plan_id`, `education_id`, `stady_plan`) VALUES (NULL, '$edu_qualification', '$selected_stady_plan_name')";
        mysqli_query($mysqli,$Study_plan_insert);
        $selected_stady_plan = mysqli_insert_id($mysqli);
    }
        
    $insert_sql = "INSERT INTO `education_student_round4` (`education_id`, `national_id`, `school`, `education_qualification`, `study_plan`, `average_GPA`, `major_id`, `file`, `province_of_school`, `district_of_school`, `subdistrict_of_school`, `zip_code`) VALUES (NULL, '$national_id_new', '$school', '$edu_qualification', '$selected_stady_plan', '$gpax', '$major', '$new_file_name', '$province', '$district', '$sub_district', '$zip_code')";
    mysqli_query($mysqli,$insert_sql);
    //echo $insert_sql;
    //exit();
    ?>
<script>
			alert("บันทึกเรียบร้อยแล้ว");
			location.href='../views/print.php?national_id=<?php echo $national_id_new;?>&major_id=<?php echo $major;?>';
		</script>
<?php }else if($gpax < $grade_major){?>
    <script>
			alert("ไม่สารถใส่ข้อมูลนี้ได้เนื่องจากเกรดเฉลี่ยต่ำกว่าเงื่อนไขที่กำหนด!!");
			location.href='../views/login.html';
		</script>
<?php }?>
<?php }?>
<?php }?>