<?php
    session_start();
    require('../config.php');
    //print_r( $_POST );

    $selected_ethnicity = $_POST['ethnicity'];
    if( $selected_ethnicity == -1 ){
        $selected_ethnicity = $_POST['other_ethnicity'];
    }
    $selected_nationality = $_POST['nationality'];
    if( $selected_nationality == -1 ){
        $selected_nationality = $_POST['other_nationality'];
    }   
    $selected_religion = $_POST['religion'];
    if( $selected_religion == -1 ){
        $selected_religion = $_POST['other_religion'];
    }
    $address_id = $_POST["address_id"];
    $app_id = $_POST["app_id"];
    $TCAS_round = $_SESSION["TCAS_round"];
    $national_id = $_SESSION["national_id"];
    $th_prefix = $_POST["th_prefix"];
    $th_firstname = $_POST["th_firstname"];
    $th_lastname = $_POST["th_lastname"];
    $en_prefix = $_POST["en_prefix"];
    $en_firstname = $_POST["en_firstname"];
    $en_lastname = $_POST["en_lastname"];
    $app_birthday = $_POST["app_birthday"];
    $house_number = $_POST["house_number"];
    $group = $_POST["group"];
    $province = $_POST["Ref_prov_id"];
    $district = $_POST["Ref_dist_id"];
    $sub_district = $_POST["Ref_subdist_id"];
    $zip_code = $_POST["zip_code"];
    $phone_number = $_POST["phone_number"];
    $phone_number_home = $_POST["phone_number_home"];
    $email = $_POST["email"];
    $occupation = $_POST["occupation"];
    $income = $_POST["income"];
    $street = $_POST["street"];

    // CHECK existing record
    $sql_query = "SELECT * FROM `applications` WHERE `national_id` = '$national_id'";
    $result = mysqli_query($mysqli,$sql_query);
    $record_number = mysqli_num_rows($result);
    $result_app = mysqli_fetch_array($result);
    $national_id_app = $result_app["national_id"];

    // print( $record_number );
    if($national_id != ""){
    $sql_queryp = "SELECT * FROM `adress_nation` WHERE `national_id` = '$national_id_app'";
    $resulti = $mysqli->query($sql_queryp);
    $record_numberi = mysqli_num_rows( $resulti );
    }

    if( $record_number == 1 ){
        $update_sql = "UPDATE `applications` SET `national_id` = '$national_id', `tcas_round` = '$TCAS_round', `prefix_th` = '$th_prefix', `fname_th` = '$th_firstname', `lname_th` = '$th_lastname', `prefix_en` = '$en_prefix', `fname_en` = '$en_firstname', `lname_en` = '$en_lastname', `bday` = '$app_birthday', `ethnicity` = '$selected_ethnicity', `nationality` = '$selected_nationality', `religion` = '$selected_religion', `telephone_number` = '$phone_number', `telephone_home` = '$phone_number_home', `email` = '$email', `parents_occupation` = '$occupation', `income_parents` = '$income' WHERE `applications`.`app_id` = $app_id";
        mysqli_query($mysqli,$update_sql);

        if($record_numberi == 1){
        $update_sqli = "UPDATE `adress_nation` SET `national_id` = '$national_id', `house_number` = '$house_number', `street` = '$street', `group` = '$group', `province` = '$province', `district` = '$district', `sub_district` = '$sub_district', `post_code` = '$zip_code' WHERE `adress_nation`.`address_id` = $address_id ";
        mysqli_query($mysqli,$update_sqli);
        }else if($record_numberi != 1){
        $insert_sqli = "INSERT INTO `adress_nation` (`address_id`, `national_id`, `house_number`, `street`, `group`, `province`, `district`, `sub_district`, `post_code`) VALUES (NULL, '$national_id', '$house_number', '$street', '$group', '$province', '$district', '$sub_district', '$zip_code')";
        mysqli_query($mysqli,$insert_sqli);
        }
    }else{
        $insert_sql = "INSERT INTO `applications` (`app_id`, `national_id`, `tcas_round`, `prefix_th`, `fname_th`, `lname_th`, `prefix_en`, `fname_en`, `lname_en`, `bday`, `ethnicity`, `nationality`, `religion`, `telephone_number`, `telephone_home`, `email`, `parents_occupation`, `income_parents`) VALUES (NULL, ' $national_id', '$TCAS_round', '$th_prefix', '$th_firstname', '$th_lastname', '$en_prefix', '$en_firstname', '$en_lastname', '$app_birthday', '$selected_ethnicity', '$selected_nationality', '$selected_religion', '$phone_number', '$phone_number_home', '$email', '$occupation', '$income')";
        mysqli_query($mysqli,$insert_sql);

        $insert_sqli = "INSERT INTO `adress_nation` (`address_id`, `national_id`, `house_number`, `street`, `group`, `province`, `district`, `sub_district`, `post_code`) VALUES (NULL, '$national_id', '$house_number', '$street', '$group', '$province', '$district', '$sub_district', '$zip_code')";
        mysqli_query($mysqli,$insert_sqli);
    }

?>
<script>
			alert("บันทึกเรียบร้อยแล้ว");
			location.href='../views/major.php?national_id=<?php echo $national_id;?>&TCAS_round=<?php echo $TCAS_round;?>';
		</script>