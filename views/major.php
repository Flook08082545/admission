<?php
    session_start();
    require('../config.php');
    $national_id = $_SESSION["national_id"];
        $sql_query = " SELECT * FROM `applications` WHERE national_id = $national_id";
        $result = mysqli_query($mysqli,$sql_query);
        $record_number = mysqli_fetch_array($result);
        $national_id_new = $record_number["national_id"];
        $fname_th = $record_number["fname_th"];
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>ข้อมูลส่วนตัว</title>
    <link rel="icon" href="../assets/images/KU_Logo.png">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/form-validation.css" rel="stylesheet">
  </head>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;300;400&family=Prompt:ital,wght@0,200;1,200&display=swap');
    </style>

  <body class="container bg-light" style="font-family: 'Noto Sans Thai', sans-serif;font-family: 'Prompt', sans-serif;">
       
    <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->      
    <div class="container">
    <?php 
        if($_GET["national_id"] != "" AND $_GET['TCAS_round'] == 1){
    ?>
      <div class="py-5 text-center">
        <img class="mb-4" src="../assets/images/KU_Logo.png" alt="" width="100">
        <h2>เลือกหลักสูตร</h2>
        <?php if($national_id == $national_id_new){?>
            <p class="lead">ผู้สมัคร : <?php echo $record_number["fname_th"];?></p>
        <?php }else{?>
        <p class="lead">ผู้สมัครใหม่</p>
        <?php }?>
      </div>
        <hr>

      <!------------------------------------------------------------------------------------------------>
        
      <?php
                        $national_id = $_GET["national_id"];
                          $sql_provinces = "SELECT * FROM `education_student` WHERE national_id = $national_id";
                          $query = mysqli_query($mysqli, $sql_provinces);
                          $result = mysqli_fetch_array($query);
                          $education_student_id=$result["education_id"];
                          $national_id_education = $result["national_id"];
                          $education = $result["education_qualification"];
                          $Study_plan = $result["study_plan"];
                          $Average_GPA=$result["average_GPA"];
                          $School=$result["school"];
                          $Province_of_school=$result["province_of_school"];
                          $District_of_school = $result["district_of_school"];
                          $Sub_district_of_school = $result["subdistrict_of_school"];
                          $major_id = $result["major_id"];
                          $file = $result["file"];
                        


                          if(isset($national_id) AND $national_id === $national_id_education){
                            ?>
      <form class="form-signin" action="../functions/major_function.php" method="POST" enctype="multipart/form-data">
      <div>
                        <p style="font-weight: bold;" class="lead"><?php echo isset($_SESSION['national_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['national_id'] : "ผู้สมัครใหม่";  ?></p>
            </div>

      <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->                          
     <div class="app_subsection">
                ข้อมูลการศึกษา
            </div>
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลการเรียน :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines"> 
                    <?php 
                            $sqlp_province = "SELECT * FROM provinces WHERE id = $Province_of_school";
                            $query_province = mysqli_query($mysqli,$sqlp_province);
                            $row_province = mysqli_fetch_array($query_province);
                        ?>
                                                <label for="sel1">จังหวัด:</label>
                            <select class="form-control" name="Ref_prov_id" id="provinces_1">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php

                            $sql_provinces = "SELECT * FROM `provinces`";
                            $query_provinces = mysqli_query($mysqli, $sql_provinces);
                        
                                    While($row_provinces_new = mysqli_fetch_array($query_provinces)){
                                        $Province_address_id = $row_provinces_new["id"];
                                        ?>
                            <option value="<?php echo $Province_address_id;?>"<?php if($Province_address_id == $row_province["id"]){?>selected="selected"<?php }?>><?php echo $row_provinces_new['name_th'];?></option>
                            <?php }?>
                            </select>
                            <br>
                            <?php
                                $sqlp_amphures = "SELECT * FROM amphures WHERE id = $District_of_school";
                                $queryp_amphures = mysqli_query($mysqli,$sqlp_amphures);
                                $rowp_amphures = mysqli_fetch_array($queryp_amphures);
                                ?>
                            <label for="sel1">อำเภอ:</label>
                            <select class="form-control" name="Ref_dist_id" id="amphures_1">
                            <?php 
                            $sql_amphures = "SELECT * FROM `amphures`";
                            $query_amphures = mysqli_query($mysqli, $sql_amphures);
                                    While($Amphures_address_id = mysqli_fetch_array($query_amphures)){
                                        $amphures_id = $Amphures_address_id["id"];
                                        ?>
                         <option value="<?php echo $amphures_id;?>" <?php if($amphures_id == $rowp_amphures["id"]){?>selected="selected"<?php }?>><?php echo $Amphures_address_id['name_th']?></option>
                            <?php }?>
                        </select>
                        <br>
                            <?php
                                $sqlp_district = "SELECT * FROM districts WHERE id = $Sub_district_of_school";
                                $query_district = mysqli_query($mysqli,$sqlp_district);
                                $row_district = mysqli_fetch_array($query_district);
                                ?>
                            <label for="sel1">ตำบล:</label>
                            <select class="form-control" name="Ref_subdist_id" id="districts_1">
                            <?php 
                                    $sql_district = "SELECT * FROM `districts`";
                                    $query_district = mysqli_query($mysqli, $sql_district);
                                    While($District_address_id = mysqli_fetch_array($query_district)){
                                        $Districts_id = $District_address_id["id"];
                                        ?>
                                        <option value="<?php echo $Districts_id;?>" <?php if($Districts_id == $row_district["id"]){?>selected="selected"<?php }?>><?php echo $District_address_id['name_th']?></option>
                            <?php }?>
                            </select>
                            <label for="sel1">รหัสไปรษณีย์:</label>
                            <input type="text" name="zip_code" id="zip_code_1" class="form-control" value="<?php if(isset($row_district)){?><?php echo $row_district["zip_code"];?><?php }?>">               
                        <div class="col-12 input-group" style="margin-top: 10px;">
                            <label style="padding-right: 10px; " for="School_name">โรงเรียน/สถานศึกษา : </label> 
                            <input style="margin-left : 10px; font-size: 14px; text-align: center;" type="text" class="form-control" id="School_name" name="School_name" placeholder="กรุณากรอกชื่อโรงเรียน" value="<?php echo $School;?>"> 
                        </div>
                        <?php

                            $educational_qualification = "SELECT * FROM educational_qualification";
                            $query_educational = mysqli_query($mysqli, $educational_qualification);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="edu_qualification">วุฒิการศึกษา : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px; width: 230px" name="edu_qualification" id="edu_qualification_edit">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php 
                                While($result_educational = mysqli_fetch_array($query_educational)){
                                    $education_id = $result_educational["education_id"];
                                    $education_type = $result_educational["education_type"];
                                    ?>
                                <option value="<?php echo $education_id;?>" <?php if($education_id==$education){?>selected="selected"<?php }?>><?php echo $education_type;?></option>   
                                <?php } ?>                       
                                </select>
                        </div>          
                        <?php
                            $stady_plan_edit = "SELECT * FROM stady_plan WHERE education_id = $education";
                            $query_stady_plan_edit = mysqli_query($mysqli, $stady_plan_edit);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="Study_plan">แผนการเรียน : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px;" name="Study_plan" id="Study_plan_edit">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php 
                                While($result_stady_plan_edit = mysqli_fetch_array($query_stady_plan_edit)){
                                    $stady_plan_id = $result_stady_plan_edit["stady_plan_id"];
                                    $stady_plan_name = $result_stady_plan_edit["stady_plan"];
                                    ?>
                                    
                                    <option value="<?php echo $stady_plan_id;?>" <?php if($stady_plan_id==$Study_plan){?>selected="selected"<?php }?>><?php echo $result_stady_plan_edit['stady_plan'];?></option>
                                    <?php } ?>  
                                    <option value="-1" <?php if($stady_plan_id == "-1"){?>selected="selected"<?php }?>>อื่นๆ</option>          
                                </select>
                                <input type="text" name="other_stady_plan_round1" id="other_Study_plan_edit" style="<?php if($stady_plan_id != "-1"){?>display:none;<?php }?> width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ">
                                </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-12 input-group">
                            <label style="padding-right: 10px;" for="gpax">เกรดเฉลี่ยสะสม : </label> 
                            <input type="text" class="form-control" id="gpax" name="gpax" value="<?php echo $Average_GPA;?>" required> 
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-10 input-group">
                            <label style="padding-right: 10px;" for="gpax">อัพโหลดระเบียบแสดงผลการเรียน : </label> 
                            <input type="file" class="form-control" id="files" name="files" value="<?php echo $file;?>" style="font-size:12px;">
                            <?php if($file != ""){?>
                                <a href="../functions/uploads/<?php echo $file;?>" style="margin-lseft:20px;margin-top:7px;padding-top:5px;padding-left:10px;padding-right:10px; background-color:#008cff;color:#fff;text-decoration: none; border-radius:15px;">แสดงผลการเรียน</a>
                                <?php }else{?>
                                    ไม่มีไฟล์
                            <?php }?>
                    </div>
                </div>
            </div>
      
    <!----------------------------------------------------------------------------------------------------------------------------------------------------->

        <div>
            <div class="app_subsection">
                เลือกหลักสูตรที่ต้องการสมัคร : 
            </div>      
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลหลักสูตรการศึกษา :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                

                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>' <?php if($f["major_id"] == $major_id){?>selected<?php }?>><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------->

        </div>
        <input type="hidden" name="group_id" value="<?php echo $f["group_id"]?>">
        <input type="hidden" name="education_id" value="<?php echo $education_student_id;?>">
        <input type="hidden" name="major_id" value="<?php echo $major_id;?>">
        <input type="hidden" name="national_id" value="<?php echo $_GET["national_id"];?>">
        <div style="padding-top:18px;">
            <button class="btn btn-primary btn-block" type="submit">บันทึก</button>
        </div>
    </form>
<?php }else{?>
  <form class="form-signin" action="../functions/major_function.php" method="POST" enctype="multipart/form-data">
      <div>
      <p style="font-weight: bold;" class="lead"><?php echo isset($_SESSION['national_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['national_id'] : "ผู้สมัครใหม่";  ?></p>
            </div>

      <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->                          
     <div class="app_subsection">
                ข้อมูลการศึกษา
            </div>
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลการเรียน :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                
                        <?php
                            $sql_provinces = "SELECT * FROM provinces";
                            $query = mysqli_query($mysqli, $sql_provinces);
                        ?>
                        <label for="sel1">จังหวัด:</label>
            <select class="form-control" name="Ref_prov_id" id="provinces">
            <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
            <?php While($value = mysqli_fetch_array($query)){?>
                                    <option value="<?php echo $value['id']?>"><?php echo $value['name_th'];?></option>
                                    <?php } ?>
            </select>
            <br>

            <label for="sel1">อำเภอ:</label>
            <select class="form-control" name="Ref_dist_id" id="amphures">
            </select>
            <br>
            <label for="sel1">ตำบล:</label>
            <select class="form-control" name="Ref_subdist_id" id="districts">
            </select>
            <label for="sel1">รหัสไปรษณีย์:</label>
       <input type="text" name="zip_code" id="zip_code" class="form-control">
      <div class="col-12 input-group" style="margin-top:20px;">
                            <label style="padding-right: 10px; " for="School_name">โรงเรียน/สถานศึกษา : </label>  
                            <input style="margin-left : 10px; font-size: 14px; text-align: center;" type="text" class="form-control" id="School_name" name="School_name" placeholder="กรุณากรอกชื่อโรงเรียน"> 
                        </div>
                        <?php
                            $educational_qualification = "SELECT * FROM educational_qualification";
                            $query_educational = mysqli_query($mysqli, $educational_qualification);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="edu_qualification">วุฒิการศึกษา : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px; width: 230px" name="edu_qualification" id="edu_qualification" value="">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php While($result_educational = mysqli_fetch_array($query_educational)){?>
                                    <option value="<?php echo $result_educational['education_id']?>"><?php echo $result_educational['education_type'];?></option>
                                    <?php } ?>             
                                </select>
                                
                        </div>          
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="stady_plan">แผนการเรียน : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px;" name="Study_plan" id="stady_plan">
                                <option value="" selected disabled>-กรุณาเลือกแผนการเรียน-</option>
                                </select>
                                <input type="text" name="other_stady_plan_round1" id="other_stady_plan" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-12 input-group">
                            <label style="padding-right: 10px;" for="gpax">เกรดเฉลี่ยสะสม : </label> 
                            <input type="text" class="form-control" id="gpax" name="gpax"> 
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-10 input-group">
                            <label style="padding-right: 10px;" for="gpax">อัพโหลดระเบียบแสดงผลการเรียน : </label> 
                            <input type="file" class="form-control" id="files" name="files"> 
                        </div>
                    </div>
                </div>
            </div>
      
    <!----------------------------------------------------------------------------------------------------------------------------------------------------->

        <div>
            <div class="app_subsection">
                เลือกหลักสูตรที่ต้องการสมัคร : 
            </div>      
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลหลักสูตรการศึกษา :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                


                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>'><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                            <input type="text" name="other_Study_plan" id="major_text" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------->

        </div>
        <input type="hidden" name="education_id" value="<?php echo $education_id;?>">
        <input type="hidden" name="national_id" value="<?php echo $_GET["national_id"];?>">
        <div style="padding-top:18px;">
            <button class="btn btn-primary btn-block" type="submit">บันทึก</button>
        </div>
    </form>
  <?php }?>
  <br>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
      <?php }else if($_SESSION['national_id'] != "" AND $_SESSION['TCAS_round'] == 2){?>
        <div class="py-5 text-center">
        <img class="mb-4" src="../assets/images/KU_Logo.png" alt="" width="100">
        <h2>เลือกหลักสูตร</h2>
        <?php if($national_id == $national_id_new){?>
        <p class="lead">ผู้สมัคร : <?php echo $record_number["fname_th"];?></p>
        <?php }else{?>
        <p class="lead">ผู้สมัครใหม่</p>
        <?php }?>
      </div>
        <hr>

      <!------------------------------------------------------------------------------------------------>
        
      <?php
                        $national_id = $_GET["national_id"];
                          $sql_provinces = "SELECT * FROM `education_student_round2` WHERE national_id = $national_id";
                          $query = mysqli_query($mysqli, $sql_provinces);
                          $result = mysqli_fetch_array($query);
                          $education_student_id=$result["education_id"];
                          $national_id_education = $result["national_id"];
                          $education = $result["education_qualification"];
                          $Study_plan = $result["study_plan"];
                          $Average_GPA=$result["average_GPA"];
                          $School=$result["school"];
                          $Province_of_school=$result["province_of_school"];
                          $District_of_school = $result["district_of_school"];
                          $Sub_district_of_school = $result["subdistrict_of_school"];
                          $major_id_1 = $result["major_id_1"];
                          $major_id_2 = $result["major_id_2"];
                          $major_id_3 = $result["major_id_3"];
                          $major_id_4 = $result["major_id_4"];
                          $file = $result["file"];

                          if(isset($national_id) AND $national_id === $national_id_education){
                            ?>
      <form class="form-signin" action="../functions/major_function.php" method="POST" enctype="multipart/form-data">
      <div>
      <p style="font-weight: bold;" class="lead"><?php echo isset($_SESSION['national_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['national_id'] : "ผู้สมัครใหม่";  ?></p>
            </div>

      <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->                          
     <div class="app_subsection">
                ข้อมูลการศึกษา
            </div>
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลการเรียน :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                
                    <?php 
                            $sqlp_province = "SELECT * FROM provinces WHERE id = $Province_of_school";
                            $query_province = mysqli_query($mysqli,$sqlp_province);
                            $row_province = mysqli_fetch_array($query_province);
                        ?>
                                                <label for="sel1">จังหวัด:</label>
                            <select class="form-control" name="Ref_prov_id" id="provinces_1">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php

                                $sql_geographies = "SELECT * FROM geographies WHERE id = 3";
                                $query_geographies = mysqli_query($mysqli,$sql_geographies);
                                $result_geographies = mysqli_fetch_array($query_geographies);
                                $geography_id = $result_geographies["id"];
    
                                $sql_provinces = "SELECT * FROM provinces WHERE geography_id = $geography_id";
                                    $query_provinces = mysqli_query($mysqli, $sql_provinces);
                        
                                    While($row_provinces_new = mysqli_fetch_array($query_provinces)){
                                        $Province_address_id = $row_provinces_new["id"];
                                        ?>
                            <option value="<?php echo $Province_address_id;?>"<?php if($Province_address_id == $row_province["id"]){?>selected="selected"<?php }?>><?php echo $row_provinces_new['name_th'];?></option>
                            <?php }?>
                            </select>
                            <br>
                            <?php
                                $sqlp_amphures = "SELECT * FROM amphures WHERE id = $District_of_school";
                                $queryp_amphures = mysqli_query($mysqli,$sqlp_amphures);
                                $rowp_amphures = mysqli_fetch_array($queryp_amphures);
                                ?>
                            <label for="sel1">อำเภอ:</label>
                            <select class="form-control" name="Ref_dist_id" id="amphures_1">
                            <?php 
                            $sql_amphures = "SELECT * FROM `amphures`";
                            $query_amphures = mysqli_query($mysqli, $sql_amphures);
                                    While($Amphures_address_id = mysqli_fetch_array($query_amphures)){
                                        $amphures_id = $Amphures_address_id["id"];
                                        ?>
                         <option value="<?php echo $amphures_id;?>" <?php if($amphures_id == $rowp_amphures["id"]){?>selected="selected"<?php }?>><?php echo $Amphures_address_id['name_th']?></option>
                            <?php }?>
                        </select>
                        <br>
                            <?php
                                $sqlp_district = "SELECT * FROM districts WHERE id = $Sub_district_of_school";
                                $query_district = mysqli_query($mysqli,$sqlp_district);
                                $row_district = mysqli_fetch_array($query_district);
                                ?>
                            <label for="sel1">ตำบล:</label>
                            <select class="form-control" name="Ref_subdist_id" id="districts_1">
                            <?php 
                                    $sql_district = "SELECT * FROM `districts`";
                                    $query_district = mysqli_query($mysqli, $sql_district);
                                    While($District_address_id = mysqli_fetch_array($query_district)){
                                        $Districts_id = $District_address_id["id"];
                                        ?>
                                        <option value="<?php echo $Districts_id;?>" <?php if($Districts_id == $row_district["id"]){?>selected="selected"<?php }?>><?php echo $District_address_id['name_th']?></option>
                            <?php }?>
                            </select>
                            <label for="sel1">รหัสไปรษณีย์:</label>
                            <input type="text" name="zip_code" id="zip_code_1" class="form-control" value="<?php if(isset($row_district)){?><?php echo $row_district["zip_code"];?><?php }?>">               
                            <div class="col-12 input-group" style="margin-top: 10px;">
                            <label style="padding-right: 10px; " for="School_name">โรงเรียน/สถานศึกษา : </label> 
                            <input style="margin-left : 10px; font-size: 14px; text-align: center;" type="text" class="form-control" id="School_name" name="School_name" placeholder="กรุณากรอกชื่อโรงเรียน" value="<?php echo $School;?>"> 
                        </div>
                        <?php

                            $educational_qualification = "SELECT * FROM educational_qualification";
                            $query_educational = mysqli_query($mysqli, $educational_qualification);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="edu_qualification">วุฒิการศึกษา : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px; width: 230px" name="edu_qualification" id="edu_qualification_edit">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php 
                                While($result_educational = mysqli_fetch_array($query_educational)){
                                    $education_id = $result_educational["education_id"];
                                    $education_type = $result_educational["education_type"];
                                    ?>
                                <option value="<?php echo $education_id;?>" <?php if($education_id==$education){?>selected="selected"<?php }?>><?php echo $education_type;?></option>   
                                <?php } ?>                       
                                </select>
                                
                        </div>          
                        <?php
                            $stady_plan_edit = "SELECT * FROM stady_plan WHERE education_id = $education";
                            $query_stady_plan_edit = mysqli_query($mysqli, $stady_plan_edit);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="Study_plan">แผนการเรียน : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px;" name="Study_plan" id="Study_plan_edit">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php 
                                While($result_stady_plan_edit = mysqli_fetch_array($query_stady_plan_edit)){
                                    $stady_plan_id = $result_stady_plan_edit["stady_plan_id"];
                                    $stady_plan_name = $result_stady_plan_edit["stady_plan"];
                                    ?>
                                    
                                    <option value="<?php echo $stady_plan_id;?>" <?php if($stady_plan_id==$Study_plan){?>selected="selected"<?php }?>><?php echo $result_stady_plan_edit['stady_plan'];?></option>
                                    <?php } ?>  
                                    <option value="-1" <?php if($Study_plan=='-1'){?>selected="selected"<?php }?>>อื่นๆ</option>                        
                                </select>
                                <input type="text" name="other_stady_plan_round2" id="other_Study_plan_edit_round2" style="<?php if($stady_plan_id != "-1"){?>display:none;<?php }?> width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ">
                              </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-12 input-group">
                            <label style="padding-right: 10px;" for="gpax">เกรดเฉลี่ยสะสม : </label> 
                            <input type="text" class="form-control" id="gpax" name="gpax" value="<?php echo $Average_GPA;?>" required> 
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-10 input-group">
                            <label style="padding-right: 10px;" for="gpax">อัพโหลดระเบียบแสดงผลการเรียน : </label> 
                            <input type="file" class="form-control" id="files" name="files" value="<?php echo $file;?>" style="font-size:12px;"> 
                            <?php if($file != ""){?>
                                <a href="../functions/uploads/<?php echo $file;?>" style="margin-left:20px;margin-top:7px;padding-top:5px;padding-right:10px;padding-right:10px; background-color:#008cff;color:#fff;text-decoration: none; border-radius:15px;">แสดงผลการเรียน</a>
                                <?php }else{?>
                                    ไม่มีไฟล์
                            <?php }?>
                    </div>
                </div>
            </div>
      
    <!----------------------------------------------------------------------------------------------------------------------------------------------------->

        <div>
            <div class="app_subsection">
                เลือกหลักสูตรที่ต้องการสมัคร : 
            </div>      
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลหลักสูตรการศึกษา :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                

                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                  $sql_major = "SELECT * FROM major";
                  $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_array($query_major) ) {
                                $major_new = $f["major"];
                            ?>
                            <option value='<?php echo $f['major_id']?>' <?php if($f["major_id"] == $major_id_1){?>selected<?php }?>><?php echo $major_new?><?php echo $f['major_id'] ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major1" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                  $sql_major = "SELECT * FROM major";
                  $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_array($query_major) ) {
                                $major_new = $f["major"];
                            ?>
                            <option value='<?php echo $f['major_id']?>' <?php if($f["major_id"] == $major_id_2){?>selected<?php }?>><?php echo $major_new?><?php echo $f['major_id'] ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major2" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                  $sql_major = "SELECT * FROM major";
                  $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_array($query_major) ) {
                                $major_new = $f["major"];
                            ?>
                            <option value='<?php echo $f['major_id']?>' <?php if($f["major_id"] == $major_id_3){?>selected<?php }?>><?php echo $major_new?><?php echo $f['major_id'] ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major3" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                  $sql_major = "SELECT * FROM major";
                  $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_array($query_major) ) {
                                $major_new = $f["major"];
                            ?>
                            <option value='<?php echo $f['major_id']?>' <?php if($f["major_id"] == $major_id_4){?>selected<?php }?>><?php echo $major_new?><?php echo $f['major_id'] ?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------->
        </div>
        <input type="hidden" name="group_id" value="<?php echo $f["group_id"]?>">
        <input type="hidden" name="education_id" value="<?php echo $education_student_id;?>">
        <input type="hidden" name="major_id" value="<?php echo $major_id;?>">
        <input type="hidden" name="national_id" value="<?php echo $_GET["national_id"];?>">
        <div style="padding-top:18px;">
            <button class="btn btn-primary btn-block" type="submit">บันทึก</button>
        </div>
    </form>
<?php }else{?>
  <form class="form-signin" action="../functions/major_function.php" method="POST" enctype="multipart/form-data">
      <div>
      <p style="font-weight: bold;" class="lead"><?php echo isset($_SESSION['national_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['national_id'] : "ผู้สมัครใหม่";  ?></p>
            </div>

      <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->                          
     <div class="app_subsection">
                ข้อมูลการศึกษา
            </div>
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลการเรียน :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                
                        <?php
                            if($_SESSION["TCAS_round"] == 2){
                                $sql_geographies = "SELECT * FROM geographies WHERE id = 3";
                                $query_geographies = mysqli_query($mysqli,$sql_geographies);
                                $result_geographies = mysqli_fetch_array($query_geographies);
                                $geography_id = $result_geographies["id"];
    
                                $sql_provinces = "SELECT * FROM provinces WHERE geography_id = $geography_id";
                                }else{
                                $sql_provinces = "SELECT * FROM provinces";
                                }
                            $query = mysqli_query($mysqli, $sql_provinces);
                        ?>
                        <label for="sel1">จังหวัด:</label>
            <select class="form-control" name="Ref_prov_id" id="provinces">
            <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
            <?php While($value = mysqli_fetch_array($query)){?>
                                    <option value="<?php echo $value['id']?>"><?php echo $value['name_th'];?></option>
                                    <?php } ?>
            </select>
            <br>

            <label for="sel1">อำเภอ:</label>
            <select class="form-control" name="Ref_dist_id" id="amphures">
            </select>
            <br>
            <label for="sel1">ตำบล:</label>
            <select class="form-control" name="Ref_subdist_id" id="districts">
            </select>
            <label for="sel1">รหัสไปรษณีย์:</label>
       <input type="text" name="zip_code" id="zip_code" class="form-control">
       <div class="col-12 input-group" style="margin-top: 10px;">
                            <label style="padding-right: 10px; " for="School_name">โรงเรียน/สถานศึกษา : </label>  
                            <input style="margin-left : 10px; font-size: 14px; text-align: center;" type="text" class="form-control" id="School_name" name="School_name" placeholder="กรุณากรอกชื่อโรงเรียน"> 
                        </div>
                        <?php
                            $educational_qualification = "SELECT * FROM educational_qualification";
                            $query_educational = mysqli_query($mysqli, $educational_qualification);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="edu_qualification">วุฒิการศึกษา : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px; width: 230px" name="edu_qualification" id="edu_qualification" value="">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php While($result_educational = mysqli_fetch_array($query_educational)){?>
                                    <option value="<?php echo $result_educational['education_id']?>"><?php echo $result_educational['education_type'];?></option>
                                    <?php } ?>             
                                </select>
                                
                        </div>          
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="stady_plan">แผนการเรียน : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px;" name="Study_plan" id="stady_plan">
                                <option value="" selected disabled>-กรุณาเลือกแผนการเรียน-</option>
                                </select>
                                <input type="text" name="other_stady_plan_round2" id="other_stady_plan" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-12 input-group">
                            <label style="padding-right: 10px;" for="gpax">เกรดเฉลี่ยสะสม : </label> 
                            <input type="text" class="form-control" id="gpax" name="gpax"> 
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-10 input-group">
                            <label style="padding-right: 10px;" for="gpax">อัพโหลดระเบียบแสดงผลการเรียน : </label> 
                            <input type="file" class="form-control" id="files" name="files"> 
                        </div>
                    </div>
                </div>
            </div>
      
    <!----------------------------------------------------------------------------------------------------------------------------------------------------->

        <div>
            <div class="app_subsection">
                เลือกหลักสูตรที่ต้องการสมัคร : 
            </div>      
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลหลักสูตรการศึกษา :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                


                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>'><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                            <input type="text" name="other_Study_plan" id="major_text" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major1" id="major1" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>'><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                            <input type="text" name="other_Study_plan" id="major_text" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major2" id="major2" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>'><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                            <input type="text" name="other_Study_plan" id="major_text" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major3" id="major3" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>'><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                            <input type="text" name="other_Study_plan" id="major_text" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------->

        </div>
        <input type="hidden" name="education_id" value="<?php echo $education_student_id;?>">
        <input type="hidden" name="national_id" value="<?php echo $_GET["national_id"];?>">
        <div style="padding-top:18px;">
            <button class="btn btn-primary btn-block" type="submit">บันทึก</button>
        </div>
    </form>
  <?php }?>
  <br>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    <?php }else if($_GET["national_id"] != "" AND $_GET['TCAS_round'] == 4){?>
      <div class="py-5 text-center">
        <img class="mb-4" src="../assets/images/KU_Logo.png" alt="" width="100">
        <h2>เลือกหลักสูตร</h2>
        <?php if($national_id == $national_id_new){?>
        <p class="lead">ผู้สมัคร : <?php echo $record_number["fname_th"];?></p>
        <?php }else{?>
        <p class="lead">ผู้สมัครใหม่</p>
        <?php }?>
      </div>
        <hr>

      <!------------------------------------------------------------------------------------------------>
        
      <?php
                        $national_id = $_GET["national_id"];
                          $sql_provinces = "SELECT * FROM `education_student_round4` WHERE national_id = $national_id";
                          $query = mysqli_query($mysqli, $sql_provinces);
                          $result = mysqli_fetch_array($query);
                          $education_student_id=$result["education_id"];
                          $national_id_education = $result["national_id"];
                          $education = $result["education_qualification"];
                          $Study_plan = $result["study_plan"];
                          $Average_GPA=$result["average_GPA"];
                          $School=$result["school"];
                          $Province_of_school=$result["province_of_school"];
                          $District_of_school = $result["district_of_school"];
                          $Sub_district_of_school = $result["subdistrict_of_school"];
                          $major_id = $result["major_id"];
                          $file = $result["file"];

                          if(isset($national_id) AND $national_id === $national_id_education){
                            ?>
      <form class="form-signin" action="../functions/major_function.php" method="POST" enctype="multipart/form-data">
      <div>
      <p style="font-weight: bold;" class="lead"><?php echo isset($_SESSION['national_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['national_id'] : "ผู้สมัครใหม่";  ?></p>
            </div>

      <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->                          
     <div class="app_subsection">
                ข้อมูลการศึกษา
            </div>
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลการเรียน :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                
                    <?php 
                            $sqlp_province = "SELECT * FROM provinces WHERE id = $Province_of_school";
                            $query_province = mysqli_query($mysqli,$sqlp_province);
                            $row_province = mysqli_fetch_array($query_province);
                        ?>
                                                <label for="sel1">จังหวัด:</label>
                            <select class="form-control" name="Ref_prov_id" id="provinces_1">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php

                            $sql_provinces = "SELECT * FROM `provinces`";
                            $query_provinces = mysqli_query($mysqli, $sql_provinces);
                        
                                    While($row_provinces_new = mysqli_fetch_array($query_provinces)){
                                        $Province_address_id = $row_provinces_new["id"];
                                        ?>
                            <option value="<?php echo $Province_address_id;?>"<?php if($Province_address_id == $row_province["id"]){?>selected="selected"<?php }?>><?php echo $row_provinces_new['name_th'];?></option>
                            <?php }?>
                            </select>
                            <br>
                            <?php
                                $sqlp_amphures = "SELECT * FROM amphures WHERE id = $District_of_school";
                                $queryp_amphures = mysqli_query($mysqli,$sqlp_amphures);
                                $rowp_amphures = mysqli_fetch_array($queryp_amphures);
                                ?>
                            <label for="sel1">อำเภอ:</label>
                            <select class="form-control" name="Ref_dist_id" id="amphures_1">
                            <?php 
                            $sql_amphures = "SELECT * FROM `amphures`";
                            $query_amphures = mysqli_query($mysqli, $sql_amphures);
                                    While($Amphures_address_id = mysqli_fetch_array($query_amphures)){
                                        $amphures_id = $Amphures_address_id["id"];
                                        ?>
                         <option value="<?php echo $amphures_id;?>" <?php if($amphures_id == $rowp_amphures["id"]){?>selected="selected"<?php }?>><?php echo $Amphures_address_id['name_th']?></option>
                            <?php }?>
                        </select>
                        <br>
                            <?php
                                $sqlp_district = "SELECT * FROM districts WHERE id = $Sub_district_of_school";
                                $query_district = mysqli_query($mysqli,$sqlp_district);
                                $row_district = mysqli_fetch_array($query_district);
                                ?>
                            <label for="sel1">ตำบล:</label>
                            <select class="form-control" name="Ref_subdist_id" id="districts_1">
                            <?php 
                                    $sql_district = "SELECT * FROM `districts`";
                                    $query_district = mysqli_query($mysqli, $sql_district);
                                    While($District_address_id = mysqli_fetch_array($query_district)){
                                        $Districts_id = $District_address_id["id"];
                                        ?>
                                        <option value="<?php echo $Districts_id;?>" <?php if($Districts_id == $row_district["id"]){?>selected="selected"<?php }?>><?php echo $District_address_id['name_th']?></option>
                            <?php }?>
                            </select>
                            <label for="sel1">รหัสไปรษณีย์:</label>
                            <input type="text" name="zip_code" id="zip_code_1" class="form-control" value="<?php if(isset($row_district)){?><?php echo $row_district["zip_code"];?><?php }?>">               
                            <div class="col-12 input-group" style="margin-top: 10px;">
                            <label style="padding-right: 10px; " for="School_name">โรงเรียน/สถานศึกษา : </label> 
                            <input style="margin-left : 10px; font-size: 14px; text-align: center;" type="text" class="form-control" id="School_name" name="School_name" placeholder="กรุณากรอกชื่อโรงเรียน" value="<?php echo $School;?>"> 
                        </div>
                        <?php
                            $educational_qualification = "SELECT * FROM educational_qualification";
                            $query_educational = mysqli_query($mysqli, $educational_qualification);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="edu_qualification">วุฒิการศึกษา : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px; width: 230px" name="edu_qualification" id="edu_qualification_edit">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php 
                                While($result_educational = mysqli_fetch_array($query_educational)){
                                    $education_id = $result_educational["education_id"];
                                    $education_type = $result_educational["education_type"];
                                    ?>
                                <option value="<?php echo $education_id;?>" <?php if($education_id==$education){?>selected="selected"<?php }?>><?php echo $education_type;?></option>   
                                <?php } ?>                       
                                </select>
                                
                        </div>          
                        <?php
                            $stady_plan_edit = "SELECT * FROM stady_plan WHERE education_id = $education";
                            $query_stady_plan_edit = mysqli_query($mysqli, $stady_plan_edit);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="Study_plan">แผนการเรียน : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px;" name="Study_plan" id="Study_plan_edit">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php 
                                While($result_stady_plan_edit = mysqli_fetch_array($query_stady_plan_edit)){
                                    $stady_plan_id = $result_stady_plan_edit["stady_plan_id"];
                                    $education_id_edit = $result_stady_plan_edit["education_id"];
                                    ?>
                                    
                                    <option value="<?php echo $stady_plan_id;?>" <?php if($stady_plan_id==$Study_plan){?>selected="selected"<?php }?>><?php echo $result_stady_plan_edit['stady_plan'];?></option>
                                    <?php } ?>  
                                    <option value="-1" <?php if($Study_plan=='-1'){?>selected="selected"<?php }?>>อื่นๆ</option>                        
                                </select>
                                <input type="text" name="other_stady_plan_round4" id="other_Study_plan_edit_round4" style="<?php if($stady_plan_id != "-1"){?>display:none;<?php }?> width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                              </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-12 input-group">
                            <label style="padding-right: 10px;" for="gpax">เกรดเฉลี่ยสะสม : </label> 
                            <input type="text" class="form-control" id="gpax" name="gpax" value="<?php echo $Average_GPA;?>" required> 
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-10 input-group">
                            <label style="padding-right: 10px;" for="gpax">อัพโหลดระเบียบแสดงผลการเรียน : </label> 
                            <input type="file" class="form-control" id="files" name="files" value="<?php echo $file;?>" style="font-size:12px;">
                            <?php if($file != ""){?>
                                <a href="../functions/uploads/<?php echo $file;?>" style="margin-lseft:20px;margin-top:7px;padding-top:5px;padding-left:10px;padding-right:10px; background-color:#008cff;color:#fff;text-decoration: none; border-radius:15px;">แสดงผลการเรียน</a>
                                <?php }else{?>
                                    ไม่มีไฟล์
                            <?php }?>
                    </div>
                </div>
            </div>
      
    <!----------------------------------------------------------------------------------------------------------------------------------------------------->

        <div>
            <div class="app_subsection">
                เลือกหลักสูตรที่ต้องการสมัคร : 
            </div>      
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลหลักสูตรการศึกษา :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                

                        <?php ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                  $sql_major = "SELECT * FROM major";
                  $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_array($query_major) ) {
                                $major_new = $f["major"];
                            ?>
                            <option value='<?php echo $f['major_id']?>' <?php if($f["major_id"] == $major_id){?>selected<?php }?>><?php echo $major_new?><?php echo $f['major_id'] ?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------->

        </div>
        <input type="hidden" name="group_id" value="<?php echo $f["group_id"]?>">
        <input type="hidden" name="education_id" value="<?php echo $education_student_id;?>">
        <input type="hidden" name="major_id" value="<?php echo $major_id;?>">
        <input type="hidden" name="national_id" value="<?php echo $_GET["national_id"];?>">
        <div style="padding-top:18px;">
            <button class="btn btn-primary btn-block" type="submit">บันทึก</button>
        </div>
    </form>
<?php }else{?>
  <form class="form-signin" action="../functions/major_function.php" method="POST" enctype="multipart/form-data">
      <div>
      <p style="font-weight: bold;" class="lead"><?php echo isset($_SESSION['national_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['national_id'] : "ผู้สมัครใหม่";  ?></p>
            </div>

      <!------------------------------------------------------- ข้อมูลหลักสูตร ------------------------------------------------------->                          
     <div class="app_subsection">
                ข้อมูลการศึกษา
            </div>
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลการเรียน :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                
                        <?php
                            $sql_provinces = "SELECT * FROM provinces";
                            $query = mysqli_query($mysqli, $sql_provinces);
                        ?>
                        <label for="sel1">จังหวัด:</label>
            <select class="form-control" name="Ref_prov_id" id="provinces">
            <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
            <?php While($value = mysqli_fetch_array($query)){?>
                                    <option value="<?php echo $value['id']?>"><?php echo $value['name_th'];?></option>
                                    <?php } ?>
            </select>
            <br>

            <label for="sel1">อำเภอ:</label>
            <select class="form-control" name="Ref_dist_id" id="amphures">
            </select>
            <br>
            <label for="sel1">ตำบล:</label>
            <select class="form-control" name="Ref_subdist_id" id="districts">
            </select>
            <label for="sel1">รหัสไปรษณีย์:</label>
       <input type="text" name="zip_code" id="zip_code" class="form-control">
       <div class="col-12 input-group" style="margin-top: 10px;">
                            <label style="padding-right: 10px; " for="School_name">โรงเรียน/สถานศึกษา : </label>  
                            <input style="margin-left : 10px; font-size: 14px; text-align: center;" type="text" class="form-control" id="School_name" name="School_name" placeholder="กรุณากรอกชื่อโรงเรียน"> 
                        </div>
                        <?php
                            $educational_qualification = "SELECT * FROM educational_qualification";
                            $query_educational = mysqli_query($mysqli, $educational_qualification);
                                ?>
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="edu_qualification">วุฒิการศึกษา : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px; width: 230px" name="edu_qualification" id="edu_qualification" value="">
                                <option value="">-กรุณาเลือกวุฒิการศึกษา-</option>   
                                <?php While($result_educational = mysqli_fetch_array($query_educational)){?>
                                    <option value="<?php echo $result_educational['education_id']?>"><?php echo $result_educational['education_type'];?></option>
                                    <?php } ?>             
                                </select>
                                
                        </div>          
                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="stady_plan">แผนการเรียน : </label><br>
                                <select class="btn btn-outline-primary btn-sm" style="margin-left : 10px;" name="Study_plan" id="stady_plan">
                                <option value="" selected disabled>-กรุณาเลือกแผนการเรียน-</option>
                                </select>
                                <input type="text" name="other_stady_plan_round4" id="other_stady_plan" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-12 input-group">
                            <label style="padding-right: 10px;" for="gpax">เกรดเฉลี่ยสะสม : </label> 
                            <input type="text" class="form-control" id="gpax" name="gpax"> 
                        </div>
                        <div style="margin-top: 10px; width: 1000px;" class="col-10 input-group">
                            <label style="padding-right: 10px;" for="gpax">อัพโหลดระเบียบแสดงผลการเรียน : </label> 
                            <input type="file" class="form-control" id="files" name="files"> 
                        </div>
                    </div>
                </div>
            </div>
      
    <!----------------------------------------------------------------------------------------------------------------------------------------------------->

        <div>
            <div class="app_subsection">
                เลือกหลักสูตรที่ต้องการสมัคร : 
            </div>      
            <div class="col-lg-12 col-12 row">                    
                <div style="margin-top: 10px;" class="col-lg-3 col-12">
                    ข้อมูลหลักสูตรการศึกษา :
                </div>
                <div style="margin-top: 10px;"  class="col-lg-9 col-12">
                    <div class="col-lg-12 col-12 form-group form-inlines">                


                        <div style="margin-top: 10px;" class="col-lg-12 col-12 input-group">                
                            <label for="major">หลักสูตรการศึกษา : </label><br>
                            <select name="major" id="major" class="btn btn-outline-primary btn-sm" style="  text-align: left; margin-left : 10px;" >
                            <option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option> 
                            
                            <?php 
                              $sql_major = "SELECT * FROM major";
                              $query_major = mysqli_query($mysqli,$sql_major);
                              while($f = mysqli_fetch_assoc($query_major) ) {
                                $major_id_new = $f["major_id"];
                            ?>
                            <option value='<?php echo $major_id_new;?>'><?php echo $f['major']?><?php echo $major_id_new;?></option>
                            <?php }?>
                            </select>
                            <input type="text" name="other_Study_plan" id="major_text" style="display:none; width: 150px; margin-left: 15px" placeholder="กรุณาระบุอื่นๆ ">
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------->

        </div>
        <input type="hidden" name="education_id" value="<?php echo $education_id;?>">
        <input type="hidden" name="national_id" value="<?php echo $_GET["national_id"];?>">
        <div style="padding-top:18px;">
            <button class="btn btn-primary btn-block" type="submit">บันทึก</button>
        </div>
    </form>
  <?php }?>
  <br>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
      <?php }?>
    </div>


    <link rel="stylesheet" href="../assets/jquery-ui/jquery-ui.css">
    
    <script src="../assets/jquery-ui/jquery.js"></script>
    <script src="../assets/jquery-ui/jquery-ui.js"></script>
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {



        'use strict';

        // $("#app_birthday" ).datepicker();
        $("#Birth_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

        $("#stady_plan").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_stady_plan").show();
                $("#other_stady_plan").focus();
            }else{
                $("#other_stady_plan").hide();
            }

        });
        $("#Study_plan_edit").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_Study_plan_edit").show();
                $("#other_Study_plan_edit").focus();
            }else{
                $("#other_Study_plan_edit").hide();
            }


        });
        $("#major").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == "<?php echo $major_id_new;?>"){
                
                $("#major_text").show();
            }else{
              $("#major_text").hide();
            }

        });

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {

        });
        $("#Study_plan_edit").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_Study_plan_edit_round2").show();
                $("#other_Study_plan_edit_round2").focus();
            }else{
                $("#other_Study_plan_edit_round2").hide();
            }
      })();
    </script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {

        });
        $("#Study_plan_edit").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_Study_plan_edit_round4").show();
                $("#other_Study_plan_edit_round4").focus();
            }else{
                $("#other_Study_plan_edit_round4").hide();
            }
      })();
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#gpax").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if(input != ""){
                    $.ajax({
                        url:"datashow.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#major").html(data);
                            $("#major").css("display","block");
                        }
                    });
                }else{
                   // $("#major").css("display","none");
                   $.ajax({
                        url:"datashow.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#major").html(data);
                            $("#major").css("display","block");
                        }
                    });
                }
            });
        });
        $(document).ready(function(){
            $("#gpax").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if(input != ""){
                    $.ajax({
                        url:"datashow.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#major1").html(data);
                            $("#major1").css("display","block");
                        }
                    });
                }else{
                    $("#major1").css("display","none");
                }
            });
        });
        $(document).ready(function(){
            $("#gpax").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if(input != ""){
                    $.ajax({
                        url:"datashow.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#major2").html(data);
                            $("#major2").css("display","block");
                        }
                    });
                }else{
                    $("#major2").css("display","none");
                }
            });
        });
        $(document).ready(function(){
            $("#gpax").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if(input != ""){
                    $.ajax({
                        url:"datashow.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#major3").html(data);
                            $("#major3").css("display","block");
                        }
                    });
                }else{
                    $("#major3").css("display","none");
                }
            });
        });
    </script>
    <?php include("script1.php");?>
    <?php include("script2.php");?>
    <?php include("script3.php");?>
    <?php include("script4.php");?>
  </body>
</html>
