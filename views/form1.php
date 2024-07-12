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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Athiti:wght@500&family=IBM+Plex+Sans+Thai:wght@500;600&family=Noto+Sans+Thai:wght@200&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/form-validation.css" rel="stylesheet">
  </head>
    <style>
        .app_subsection{
            padding-top:20px; 
            color:red; 
            font-weight:800; 
            font-size:120%;
        }
    </style>

  <body class="bg-light" style="font-family: 'Noto Sans Thai', sans-serif;font-family: 'Prompt', sans-serif;">

    <div class="container">
      <div class="py-5 text-center">
        <img class="mb-4" src="../assets/images/KU_Logo.png" alt="" width="100">
        <h2>กรอกข้อมูลส่วนตัว</h2>
        <?php if($national_id == $national_id_new){?>
        <p class="lead">ผู้สมัคร : <?php echo $record_number["fname_th"];?></p>
        <?php }else{?>
        <p class="lead">ผู้สมัครใหม่</p>
        <?php }?>
      </div>
        <?php
        $national_id = $_SESSION['national_id'];
        $sqli = "SELECT * FROM applications WHERE national_id = $national_id";
        $query = mysqli_query($mysqli,$sqli);
        $row = mysqli_fetch_array($query);
        $app_id = $row["app_id"];
        $national_id_app = $row["national_id"];
        $prefix_th=$row["prefix_th"];
        $prefix_en=$row["prefix_en"];
        $religion=$row["religion"];
        $nationality=$row["nationality"];
        $ethnicity=$row["ethnicity"];

            if(isset($_SESSION["national_id"]) AND $_SESSION["national_id"] === $national_id_app){
                
        $sqlp = "SELECT * FROM adress_nation WHERE national_id = $national_id_app";
        $queryp = mysqli_query($mysqli,$sqlp);
        $rowp = mysqli_fetch_array($queryp);
        $address_id = $rowp["address_id"];
        $Province_id = $rowp["province"];
        $District_id = $rowp["district"];
        $Sub_district = $rowp["sub_district"];
        ?>
      <form class="form-signin" action="../functions/form1_function.php" method="POST">
        <div>
            ข้อมูลส่วนบุคคลอ้างอิงจากบัตรประชาชน

            <div class="app_subsection">
                ข้อมูลภาษาไทย
            </div>
            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-4 col-12 form-group">                
                    <label for="th_prefix">คำนำหน้า</label><br>
                    <select name="th_prefix" id="th_prefix" class="form-select" aria-label="Default select example">
                    <option value="นาย" <?php if($prefix_th=='นาย'){?>selected="selected"<?php }?>>นาย</option>
                    <option value="นาง" <?php if($prefix_th=='นาง'){?>selected="selected"<?php }?>>นาง</option>
                    <option value="นางสาว" <?php if($prefix_th=='นางสาว'){?>selected="selected"<?php }?>>นางสาว</option>
                    <option value="เด็กชาย" <?php if($prefix_th=='เด็กชาย'){?>selected="selected"<?php }?>>เด็กชาย</option>
                    <option value="เด็กหญิง" <?php if($prefix_th=='เด็กหญิง'){?>selected="selected"<?php }?>>เด็กหญิง</option>                      
                    </select>
                </div>                                
                <div class="col-lg-4 col-12 form-group">
                    <label for="th_firstname">ชื่อ</label> 
                    <input type="text" class="form-control" id="th_firstname" name="th_firstname" placeholder="ชื่อภาษาไทย" value="<?php echo $row["fname_th"];?>" required autofocus>
                </div>
                <div class="col-lg-4 col-12 form-group">
                    <label for="th_lastname">นามสกุล</label> 
                    <input type="text" class="form-control" id="th_lastname" name="th_lastname" placeholder="นามสกุลภาษาไทย" value="<?php echo $row["lname_th"];?>" required autofocus>
                </div>
            </div>

            
            <div class="app_subsection">
                ข้อมูลอังกฤษ
            </div>
            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-4 col-12  form-group">                
                    <label for="en_prefix">Title</label><br>
                    <select class="form-select" aria-label="Default select example" name="en_prefix" id="en_prefix">
                        <option value="Mr." <?php if($prefix_en == "Mr."){?>selected="selected"<?php }?>>Mr.</option></option>>Mr.</option>
                        <option value="Ms." <?php if($prefix_en == "Ms."){?>selected="selected"<?php }?>>Ms.</option>
                        <option value="Mrs."<?php if($prefix_en == "Mrs."){?>selected="selected"<?php }?>>Mrs.</option>                        
                    </select>
                </div>                                
                <div class="col-lg-4 col-12 form-select">
                    <label for="en_firstname">Firstname</label> 
                    <input type="text" class="form-control" id="en_firstname" name="en_firstname" placeholder="Firstname" value="<?php echo $row["fname_en"];?>" required autofocus>
                </div>
                <div class="col-lg-4 col-12 form-group">
                    <label for="en_lastname">Lastname</label> 
                    <input type="text" class="form-control" id="en_lastname" name="en_lastname" placeholder="Lastname" value="<?php echo $row["lname_en"];?>" required autofocus>
                </div>
            </div>
                        
            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-12 col-12 form-group">               
                    <label for="app_birthday">วัน/เดือน/ปี เกิด</label> 
                    <input type="text" class="form-control" id="app_birthday" name="app_birthday" placeholder="Birthday" value="<?php echo $row["bday"];?>"> 
                </div>
            </div>


            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-4 col-12  form-group">                
                    <label for="ethnicity">เชื้อชาติ</label><br>
                    <select name="ethnicity" id="ethnicity">
                        <option value="ไทย" <?php if($ethnicity == "พุทธ"){?>selected="selected"<?php }?>>ไทย</option>
                        <option value="-1" <?php if($ethnicity == "พุทธ"){?>selected="selected"<?php }?>>อื่นๆ</option>                        
                    </select>
                    <input type="text" name="other_ethnicity" id="other_ethnicity" style="display:none;" value="<?php echo $row['ethnicity'];?>">
                </div>                                
                <div class="col-lg-4 col-12 form-group">
                <label for="nationality">สัญชาติ</label><br>
                    <select name="nationality" id="nationality">
                        <option value="ไทย" <?php if($nationality == "พุทธ"){?>selected="selected"<?php }?>>ไทย</option>
                        <option value="-1" <?php if($nationality == "พุทธ"){?>selected="selected"<?php }?>>อื่นๆ</option>                        
                    </select>
                    <input type="text" name="other_nationality" id="other_nationality" style="display:none;" value="<?php echo $row['nationality'];?>">
                </div>
                <div class="col-lg-4 col-12 form-group">
                <label for="religion">ศาสนา</label><br>
                    <select name="religion" id="religion">
                        <option value="พุทธ" <?php if($religion == "พุทธ"){?>selected="selected"<?php }?>>พุทธ</option>
                        <option value="คริสต์" <?php if($religion == "คริสต์"){?>selected="selected"<?php }?>>คริสต์</option>
                        <option value="อิสลาม" <?php if($religion == "อิสลาม"){?>selected="selected"<?php }?>>อิสลาม</option>
                        <option value="-1" <?php if($religion == "-1"){?>selected="selected"<?php }?>>อื่นๆ</option>                        
                    </select>
                    <input type="text" name="other_religion" id="other_religion" style="display:none;" value="<?php echo $row['religion'];?>">
                </div>
            </div>


            <div class="app_subsection">
                ข้อมูลติดต่อ
            </div>
            <div class="col-lg-12 col-12 row">                
                <div  class="col-lg-4 col-12">
                    ที่อยู่ที่สามารถติดต่อได้
                </div>

                <div  class="col-lg-8 col-12">
                    <div class="col-lg-12 col-12">                
                        <?php
                        if(isset($rowp)){
                            ?>
                            <div class="col-12 form-group form-inline">
                            <label for="province">บ้านเลขที่ : </label> 
                            <input type="text" class="form-control" id="house_number" name="house_number" placeholder="" value="<?php echo $rowp['house_number'];?>">
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="group">หมู่ที : </label> 
                            <input type="text" class="form-control" id="group" name="group" placeholder="" value="<?php echo $rowp['group'];?>">
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="street">ถนน : </label> 
                            <input type="text" class="form-control" id="street" name="street" placeholder="" value="<?php echo $rowp['street'];?>">
                        </div>
                            <?php 
                            $sqlp_province = "SELECT * FROM provinces WHERE id = $Province_id";
                            $query_province = mysqli_query($mysqli,$sqlp_province);
                            $row_province = mysqli_fetch_array($query_province);
                        ?>
                                                <label for="sel1">จังหวัด:</label>
                            <select class="form-control" name="Ref_prov_id" id="provinces_1">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php
                            $sql_provinces = "SELECT * FROM provinces";
                            $query_provinces = mysqli_query($mysqli, $sql_provinces);
                        
                                    While($row_provinces_new = mysqli_fetch_array($query_provinces)){
                                        $Province_address_id = $row_provinces_new["id"];
                                        ?>
                            <option value="<?php echo $Province_address_id;?>"<?php if($Province_address_id == $row_province["id"]){?>selected="selected"<?php }?>><?php echo $row_provinces_new['name_th'];?></option>
                            <?php }?>
                            </select>
                            <br>
                            <?php
                                $sqlp_amphures = "SELECT * FROM amphures WHERE id = $District_id";
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
                                $sqlp_district = "SELECT * FROM districts WHERE id = $Sub_district";
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
                            <?php }else if(!isset($rowp)){?>
                                <div class="col-12 form-group form-inline">
                            <label for="province">บ้านเลขที่ : </label> 
                            <input type="text" class="form-control" id="house_number" name="house_number" placeholder="" style="font-size:10px;">
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="group">หมู่ที : </label> 
                            <input type="text" class="form-control" id="group" name="group" placeholder="">
                            <label for="street">ถนน : </label> 
                            <input type="text" class="form-control" id="street" name="street" placeholder="">
                        </div>
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
                        <br>

                        <label for="sel1">รหัสไปรษณีย์:</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control">
                            <?php }?>
                            <div class="col-12 form-group form-inline" style="margin-top:15px;">
                            <label for="phone_number">เบอร์โทรศัพท์มือถือ : </label> 
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="" value="<?php echo $row['telephone_number'];?>"> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="phone_number_home">เบอร์โทรศัพท์บ้าน : </label> 
                            <input type="text" class="form-control" id="phone_number_home" name="phone_number_home" placeholder="" value="<?php echo $row['telephone_home'];?>"> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="email">อีเมล : </label> 
                            <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php echo $row['email'];?>"> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="occupation">อาชีพผู้ปกครอง : </label> 
                            <input type="text" class="form-control" id="occupation" name="occupation" placeholder="" value="<?php echo $row['parents_occupation'];?>"> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="income">รายได้ผู้ปกครอง(รายเดือน) : </label> 
                            <input type="text" class="form-control" id="income" name="income" placeholder="" value="<?php echo $row['income_parents'];?>"> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div style="padding-top:18px;">
        <input type="hidden" name="address_id" value="<?php echo $address_id;?>">
            <input type="hidden" name="app_id" value="<?php echo $app_id;?>">
            <button class="btn btn-sm btn-primary btn-block" type="submit">บันทึก</button>
        </div>
                    </form>
<?php }else{?>
<form class="form-signin" action="../functions/form1_function.php" method="POST">
        <div>
            ข้อมูลส่วนบุคคลอ้างอิงจากบัตรประชาชน

            <div class="app_subsection">
                ข้อมูลภาษาไทย
            </div>
            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-4 col-12 form-group">                
                    <label for="th_prefix">คำนำหน้า</label>
                    <?php 

                    ?>
                    <select name="th_prefix" id="th_prefix">
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>                        
                    </select>
                </div>                                
                <div class="col-lg-4 col-12 form-group">
                    <label for="th_firstname">ชื่อ</label> 
                    <input type="text" class="form-control" id="th_firstname" name="th_firstname" placeholder="ชื่อภาษาไทย">
                </div>
                <div class="col-lg-4 col-12 form-group">
                    <label for="th_lastname">นามสกุล</label> 
                    <input type="text" class="form-control" id="th_lastname" name="th_lastname" placeholder="นามสกุลภาษาไทย">
                </div>
            </div>

            
            <div class="app_subsection">
                ข้อมูลอังกฤษ
            </div>
            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-4 col-12  form-group">                
                    <label for="en_prefix">Title</label><br>
                    <select class="form-select" aria-label="Default select example" name="en_prefix" id="en_prefix">
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>                        
                    </select>
                </div>                                
                <div class="col-lg-4 col-12 form-group">

                    <?php
                        $en_firstname_value = "";
                        if( isset( $_SESSION['app_data']['firstname_en'] ) ){
                            $en_firstname_value = $_SESSION['app_data']['firstname_en'] ; 
                        }                    
                    ?>

                    <label for="en_firstname">Firstname</label> 
                    <input type="text" class="form-control" id="en_firstname" name="en_firstname" placeholder="Firstname" value="<?php echo $en_firstname_value;  ?>">
                </div>
                <div class="col-lg-4 col-12 form-group">
                    <label for="en_lastname">Lastname</label> 
                    <input type="text" class="form-control" id="en_lastname" name="en_lastname" placeholder="Lastname">
                </div>
            </div>
                        
            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-12 col-12 form-group">
                    <?php
                        $birthday_value = "";
                        if( isset( $_SESSION['app_data']['birthday'] ) ){
                            $birthday_value = $_SESSION['app_data']['birthday'] ; 
                        }                    
                    ?>                
                    <label for="app_birthday">วัน/เดือน/ปี เกิด</label> 
                    <input type="text" class="form-control" id="app_birthday" name="app_birthday" placeholder="Birthday" value="<?php echo $birthday_value; ?>"> 
                </div>
            </div>


            <div class="col-lg-12 col-12 row">               
                <div class="col-lg-4 col-12  form-group">                
                    <label for="ethnicity">เชื้อชาติ</label><br>
                    <select name="ethnicity" id="ethnicity">
                        <option value="ไทย">ไทย</option>
                        <option value="-1">อื่นๆ</option>                        
                    </select>
                    <input type="text" name="other_ethnicity" id="other_ethnicity" style="display:none;">
                </div>                                
                <div class="col-lg-4 col-12 form-group">
                <label for="nationality">สัญชาติ</label><br>
                    <select name="nationality" id="nationality">
                        <option value="ไทย">ไทย</option>
                        <option value="-1">อื่นๆ</option>                        
                    </select>
                    <input type="text" name="other_nationality" id="other_nationality" style="display:none;">
                </div>
                <div class="col-lg-4 col-12 form-group">
                <label for="religion">ศาสนา</label><br>
                    <select name="religion" id="religion">
                        <option value="พุทธ">พุทธ</option>
                        <option value="คริสต์">คริสต์</option>
                        <option value="อิสลาม">อิสลาม</option>
                        <option value="-1">อื่นๆ</option>                        
                    </select>
                    <input type="text" name="other_religion" id="other_religion" style="display:none;">
                </div>
            </div>


            <div class="app_subsection">
                ข้อมูลติดต่อ
            </div>
            <div class="col-lg-12 col-12 row">                
                <div  class="col-lg-4 col-12">
                    ที่อยู่ที่สามารถติดต่อได้
                </div>

                <div  class="col-lg-8 col-12">
                    <div class="col-lg-12 col-12">                
                    <div class="col-12 form-group form-inline">
                            <label for="province">บ้านเลขที่ : </label> 
                            <input type="text" class="form-control" id="house_number" name="house_number" placeholder="">
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="group">หมู่ที : </label> 
                            <input type="text" class="form-control" id="group" name="group" placeholder="">
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="street">ถนน : </label> 
                            <input type="text" class="form-control" id="street" name="street" placeholder="">
                        </div>
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
       <br>

      <label for="sel1">รหัสไปรษณีย์:</label>
       <input type="text" name="zip_code" id="zip_code" class="form-control">
                        <div class="col-12 form-group form-inline" style="margin-top:15px;">
                            <label for="phone_number">เบอร์โทรศัพท์มือถือ : </label> 
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder=""> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="phone_number_home">เบอร์โทรศัพท์บ้าน : </label> 
                            <input type="text" class="form-control" id="phone_number_home" name="phone_number_home" placeholder=""> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="email">อีเมล : </label> 
                            <input type="email" class="form-control" id="email" name="email" placeholder=""> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="occupation">อาชีพผู้ปกครอง : </label> 
                            <input type="text" class="form-control" id="occupation" name="occupation" placeholder=""> 
                        </div>
                        <div class="col-12 form-group form-inline">
                            <label for="income">รายได้ผู้ปกครอง(รายเดือน) : </label> 
                            <input type="text" class="form-control" id="income" name="income" placeholder=""> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div style="padding-top:18px;">
            <button class="btn btn-sm btn-primary btn-block" type="submit">บันทึก</button>
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
        $("#app_birthday" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $("#ethnicity").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_ethnicity").show();
                $("#other_ethnicity").focus();
            }
        });

        $("#nationality").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_nationality").show();
                $("#other_nationality").focus();
            }
        });
        $("#religion").change(function(){
            console.log( $(this).val() );
            if( $(this).val() == -1 ){
                $("#other_religion").show();
                $("#other_religion").focus();
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
    <?php include('script.php');?>
    <?php include('script1.php');?>
  </body>
</html>
