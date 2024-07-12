<?php
    session_start();
    require('../config.php');
    // print_r( $_REQUEST );

    $national_id = $mysqli->real_escape_string( $_POST['inputNationalID'] );
    $tcas_round = $mysqli->real_escape_string( $_POST['inputTCASRound'] );
    $sql_query = " SELECT * FROM `applications` WHERE `national_id` = $national_id AND `tcas_round` = $tcas_round ";
    // echo $sql_query;

    $result = mysqli_query($mysqli,$sql_query);
    $record_number = mysqli_num_rows( $result );
    // print( $record_number );

    unset($_SESSION['app_data']);
    if($record_number == 1){
        // Associative array
        $personal_data = mysqli_fetch_assoc($result);
        $_SESSION['national_id'] = $personal_data['national_id'];        
        $_SESSION['TCAS_round'] = $personal_data['tcas_round'];
        $_SESSION["Fname_th"] = $personal_data["fname_th"];
    }    
    else{
        $_SESSION['national_id'] = $national_id;
        $_SESSION['TCAS_round'] = $tcas_round;
    }
    
    header("Location: ../views/form1.php");
    


?>