<?php
session_start();



require('../fpdf185/fpdf.php');
require('../config.php');

if($_SESSION["national_id"] AND $_SESSION["TCAS_round"] == 1){
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->AddFont('sarabun','','THSarabun.php');
$pdf->AddFont('sarabunB','','THSarabun Bold.php');

//$pdf ->Image('../assets/images/KU_Symbol_Eng.png',92,10,30);

$national_id = $_GET['national_id'];
$major_id = $_GET["major_id"];
$Study_plan_id = $_GET["Study_plan_id"];

$pdf->setFont('sarabunB','','18');



//$sql_query = " SELECT * FROM education_student WHERE National_id = '".$_SESSION['National_id']."' ";
//$result = $mysqli->query($sql_query);
//$record_number = mysqli_num_rows( $result );


    $sql = "SELECT * FROM `applications` WHERE national_id = $national_id";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($query);

    $sqlp = "SELECT * FROM `adress_nation` WHERE national_id = $national_id";
    $queryp = mysqli_query($mysqli,$sqlp);
    $rowp = mysqli_fetch_assoc($queryp);
    
    $provinces_id = $rowp["province"];
    $district = $rowp["district"];
    $Sub_district = $rowp["sub_district"];
    
    
    $sqlq = "SELECT * FROM `provinces` WHERE id = $provinces_id";
    $queryq = mysqli_query($mysqli,$sqlq);
    $rowq = mysqli_fetch_assoc($queryq);

    $sqlw = "SELECT * FROM `amphures` WHERE id = $district";
    $queryw = mysqli_query($mysqli,$sqlw);
    $roww = mysqli_fetch_assoc($queryw);
    
    $sqle = "SELECT * FROM `districts` WHERE id = $Sub_district";
    $querye = mysqli_query($mysqli,$sqle);
    $rowe = mysqli_fetch_assoc($querye);

$pdf->Image('logo/1.png',90,10,30);
$pdf->SetY(38);
$pdf->Cell(0,9,iconv('utf-8','cp874','ใบรับสมัคร'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','การคัดเลือกเข้าศึกษาต่อในมหาวิทยาลัยเกษตรศาสตร์'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','วิทยาเขตเฉลิมพรเกียรติ จังหวัดสกลนคร'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','ประจำปีการศึกษา 2566 รอบที่ '.$row['tcas_round']),0,1,'C');
$pdf->Ln();

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874','รหัสบัตรประจำตัวประชาชน : '.$row ['national_id'].'                ชื่อ - นามสกุล : '.$row ['fname_th'].'  '.$row['lname_th']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','วัน เดือน ปีเกิด : '.$row ['bday'].'            สัญชาติ : '.$row ['ethnicity'].'       เชื้อชาติ : '.$row['nationality'].'        ศาสนา : '.$row['religion']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','บ้านเลขที่  : '.$rowp ['house_number'].'  หมู่ที่ : '.$rowp ['group'].'  ตำบล : '.$rowe['name_th'].'  อำเภอ : '.$roww['name_th'].'  จังหวัด : '.$rowq['name_th'].' '.$rowe['zip_code']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874',' โทรศัพท์บ้าน '.$row ['telephone_home'].'   โทรศัพท์มือถือ : '.$row ['telephone_number'].' Email : '.$row['email']),0,1);

$sql = "SELECT * FROM `education_student` WHERE national_id = $national_id";
$query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);
    $major_id = $row["major_id"];
    $education_id = $row["education_qualification"];
    $Study_plan = $row["study_plan"];


    $sqlu = "SELECT * FROM `educational_qualification` WHERE education_id = $education_id";
    $queryu = mysqli_query($mysqli,$sqlu);
    $rowu = mysqli_fetch_assoc($queryu);

    $sqlt = "SELECT * FROM `stady_plan` WHERE stady_plan_id = $Study_plan";
$queryt = mysqli_query($mysqli,$sqlt);
$rowt = mysqli_fetch_assoc($queryt);

$sqli = "SELECT * FROM `major` WHERE major_id = $major_id";
$queryi = mysqli_query($mysqli,$sqli);
$rowi = mysqli_fetch_assoc($queryi);
$group_id = $rowi["group_id"];

$sqlp = "SELECT * FROM `group` WHERE group_id = $group_id";
$queryp = mysqli_query($mysqli,$sqlp);
$rowp = mysqli_fetch_assoc($queryp);

$pdf->setFont('sarabunB','','18');
$pdf->Cell(0,10,iconv('utf-8','cp874','ข้อมูลการศึกษา'),0,1);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874','ผลการเรียนเฉลี่ยสะสม : '.$rowu['education_type'].' ('.$rowt['stady_plan'].')  รวมเป็น '.$row['average_GPA']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','ชื่อโรงเรียน : '.$row ['school']),0,1);


$pdf->setFont('sarabunB','','18');
$pdf->Cell(0,9,iconv('utf-8','cp874','สมัครเข้าศึกษา  : '.$rowp ['group']),0,1);
$pdf->Cell(0,9,iconv('utf-8','cp874','หลักสูตร   : '.$rowi ['major']),0,1);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,7,iconv('utf-8','cp874','             ข้าพเจ้าขอรับรองว่ามีคุณสมบัติครบตามประกาศรับสมัครของมหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตเฉลิมพระเกียรติ  '),0,1);
$pdf->Cell(0,7,iconv('utf-8','cp874','จังหวัดสกลนคร ทุกประการ หากตรตรวจสอบในภายหลังพบว่าขาดคุณสมบัติ ข้าพเจ้ายินดีให้มหาวิทยาลัยตัดสิทธิ์ในการเข้าศึกษา'),0,1);
$pdf->Cell(0,7,iconv('utf-8','cp874','โดยไม่มีข้ออุทธรณ์ใดๆ ทั้งสิ้น'),0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$sql = "SELECT * FROM `applications` WHERE national_id = $national_id";
$query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874',' ลงชื่อ '.$row ['fname_th'].'  '.$row['lname_th'].' ผู้สมัคร '),0,1,'R');
$pdf->Cell(0,8,iconv('utf-8','cp874',' ( '.$row ['fname_th'].'  '.$row['lname_th'].' ) '),0,1,'R');

$pdf->Output();

}else if($_SESSION["national_id"] AND $_SESSION["TCAS_round"] == 2){
    $pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->AddFont('sarabun','','THSarabun.php');
$pdf->AddFont('sarabunB','','THSarabun Bold.php');

//$pdf ->Image('../assets/images/KU_Symbol_Eng.png',92,10,30);

$national_id = $_GET['national_id'];
$major_id = $_GET["major_id"];
$major_id_1 = $_GET["major_id_1"];
$major_id_2 = $_GET["major_id_2"];
$major_id_3 = $_GET["major_id_3"];

$pdf->setFont('sarabunB','','18');



//$sql_query = " SELECT * FROM education_student WHERE National_id = '".$_SESSION['National_id']."' ";
//$result = $mysqli->query($sql_query);
//$record_number = mysqli_num_rows( $result );


    $sql = "SELECT * FROM `applications` WHERE national_id = $national_id";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($query);

    $sqlp = "SELECT * FROM `adress_nation` WHERE national_id = $national_id";
    $queryp = mysqli_query($mysqli,$sqlp);
    $rowp = mysqli_fetch_assoc($queryp);
    
    $provinces_id = $rowp["province"];
    $district = $rowp["district"];
    $Sub_district = $rowp["sub_district"];
    
    
    $sqlq = "SELECT * FROM `provinces` WHERE id = $provinces_id";
    $queryq = mysqli_query($mysqli,$sqlq);
    $rowq = mysqli_fetch_assoc($queryq);

    $sqlw = "SELECT * FROM `amphures` WHERE id = $district";
    $queryw = mysqli_query($mysqli,$sqlw);
    $roww = mysqli_fetch_assoc($queryw);
    
    $sqle = "SELECT * FROM `districts` WHERE id = $Sub_district";
    $querye = mysqli_query($mysqli,$sqle);
    $rowe = mysqli_fetch_assoc($querye);

$pdf->Image('logo/1.png',90,10,30);
$pdf->SetY(38);
$pdf->Cell(0,9,iconv('utf-8','cp874','ใบรับสมัคร'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','การคัดเลือกเข้าศึกษาต่อในมหาวิทยาลัยเกษตรศาสตร์'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','วิทยาเขตเฉลิมพรเกียรติ จังหวัดสกลนคร'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','ประจำปีการศึกษา 2566 รอบที่ '.$row['tcas_round']),0,1,'C');
$pdf->Ln();

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874','รหัสบัตรประจำตัวประชาชน : '.$row ['national_id'].'                ชื่อ - นามสกุล : '.$row ['fname_th'].'  '.$row['lname_th']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','วัน เดือน ปีเกิด : '.$row ['bday'].'            สัญชาติ : '.$row ['ethnicity'].'       เชื้อชาติ : '.$row['nationality'].'        ศาสนา : '.$row['religion']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','บ้านเลขที่  : '.$rowp ['house_number'].'  หมู่ที่ : '.$rowp ['group'].'  ตำบล : '.$rowe['name_th'].'  อำเภอ : '.$roww['name_th'].'  จังหวัด : '.$rowq['name_th'].' '.$rowe['zip_code']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874',' โทรศัพท์บ้าน '.$row ['telephone_home'].'   โทรศัพท์มือถือ : '.$row ['telephone_number'].' Email : '.$row['email']),0,1);

$sql = "SELECT * FROM `education_student_round2` WHERE major_id_1 = $major_id AND major_id_2 = $major_id_1 AND major_id_3 = $major_id_2 AND major_id_4 = $major_id_3";
$query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);
    $major_id = $row["major_id_1"];
    $major_id_1 = $row["major_id_2"];
    $major_id_2 = $row["major_id_3"];
    $major_id_3 = $row["major_id_4"];
    $education_id = $row["education_qualification"];
    $Study_plan = $row["study_plan"];


    $sqlu = "SELECT * FROM `educational_qualification` WHERE education_id = $education_id";
    $queryu = mysqli_query($mysqli,$sqlu);
    $rowu = mysqli_fetch_assoc($queryu);

    $sqlt = "SELECT * FROM `stady_plan` WHERE stady_plan_id = $Study_plan";
$queryt = mysqli_query($mysqli,$sqlt);
$rowt = mysqli_fetch_assoc($queryt);

$sql_major_1 = "SELECT * FROM `major` WHERE major_id = $major_id";
$queryi_major_1 = mysqli_query($mysqli,$sql_major_1);
$rowi_major_1 = mysqli_fetch_assoc($queryi_major_1);
$group_id_major_1 = $rowi_major_1["group_id"];

$sql_group_1 = "SELECT * FROM `group` WHERE group_id = $group_id_major_1";
$queryp_group_1 = mysqli_query($mysqli,$sql_group_1);
$rowp_group_1 = mysqli_fetch_assoc($queryp_group_1);

$sql_major_2 = "SELECT * FROM `major` WHERE major_id = $major_id_1";
$queryi_major_2 = mysqli_query($mysqli,$sql_major_2);
$rowi_major_2 = mysqli_fetch_assoc($queryi_major_2);
$group_id_major_2 = $rowi_major_2["group_id"];

$sql_group_2 = "SELECT * FROM `group` WHERE group_id = $group_id_major_2";
$queryp_group_2 = mysqli_query($mysqli,$sql_group_2);
$rowp_group_2 = mysqli_fetch_assoc($queryp_group_2);

$sql_major_3 = "SELECT * FROM `major` WHERE major_id = $major_id_2";
$queryi_major_3 = mysqli_query($mysqli,$sql_major_3);
$rowi_major_3 = mysqli_fetch_assoc($queryi_major_3);
$group_id_major_3 = $rowi_major_3["group_id"];

$sql_group_3 = "SELECT * FROM `group` WHERE group_id = $group_id_major_3";
$queryp_group_3 = mysqli_query($mysqli,$sql_group_3);
$rowp_group_3 = mysqli_fetch_assoc($queryp_group_3);

$sql_major_4 = "SELECT * FROM `major` WHERE major_id = $major_id_3";
$queryi_major_4 = mysqli_query($mysqli,$sql_major_4);
$rowi_major_4 = mysqli_fetch_assoc($queryi_major_4);
$group_id_major_4 = $rowi_major_4["group_id"];

$sql_group_4 = "SELECT * FROM `group` WHERE group_id = $group_id_major_4";
$queryp_group_4 = mysqli_query($mysqli,$sql_group_4);
$rowp_group_4 = mysqli_fetch_assoc($queryp_group_4);

$pdf->setFont('sarabunB','','18');
$pdf->Cell(0,10,iconv('utf-8','cp874','ข้อมูลการศึกษา'),0,1);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874','ผลการเรียนเฉลี่ยสะสม : '.$rowu['education_type'].' ('.$rowt['stady_plan'].')  รวมเป็น '.$row['average_GPA']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','ชื่อโรงเรียน : '.$row ['school']),0,1);


$pdf->setFont('sarabunB','','16');
$pdf->Cell(0,9,iconv('utf-8','cp874','สมัครเข้าศึกษา  : ('.$rowp_group_1['group'].')('.$rowp_group_2['group'].')'),0,1);
$pdf->Cell(0,9,iconv('utf-8','cp874','                      ('.$rowp_group_3['group'].')('.$rowp_group_4['group'].')'),0,1);
$pdf->Cell(0,9,iconv('utf-8','cp874','หลักสูตร   : ('.$rowi_major_1['major'].')('.$rowi_major_2['major'].')('.$rowi_major_3['major'].')('.$rowi_major_4['major'].')'),0,1);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,7,iconv('utf-8','cp874','             ข้าพเจ้าขอรับรองว่ามีคุณสมบัติครบตามประกาศรับสมัครของมหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตเฉลิมพระเกียรติ  '),0,1);
$pdf->Cell(0,7,iconv('utf-8','cp874','จังหวัดสกลนคร ทุกประการ หากตรตรวจสอบในภายหลังพบว่าขาดคุณสมบัติ ข้าพเจ้ายินดีให้มหาวิทยาลัยตัดสิทธิ์ในการเข้าศึกษา'),0,1);
$pdf->Cell(0,7,iconv('utf-8','cp874','โดยไม่มีข้ออุทธรณ์ใดๆ ทั้งสิ้น'),0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$sql = "SELECT * FROM `applications` WHERE national_id = $national_id";
$query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874',' ลงชื่อ '.$row ['fname_th'].'  '.$row['lname_th'].' ผู้สมัคร '),0,1,'R');
$pdf->Cell(0,8,iconv('utf-8','cp874',' ( '.$row ['fname_th'].'  '.$row['lname_th'].' ) '),0,1,'R');

$pdf->Output();
}else if($_SESSION["national_id"] AND $_SESSION["TCAS_round"] == 4){
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->AddFont('sarabun','','THSarabun.php');
    $pdf->AddFont('sarabunB','','THSarabun Bold.php');
    
    //$pdf ->Image('../assets/images/KU_Symbol_Eng.png',92,10,30);
    
    $national_id = $_GET['national_id'];
    $major_id = $_GET["major_id"];
    
    $pdf->setFont('sarabunB','','18');
    
    
    
    //$sql_query = " SELECT * FROM education_student WHERE National_id = '".$_SESSION['National_id']."' ";
    //$result = $mysqli->query($sql_query);
    //$record_number = mysqli_num_rows( $result );
    
    
        $sql = "SELECT * FROM `applications` WHERE national_id = $national_id";
        $query = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_assoc($query);
    
        $sqlp = "SELECT * FROM `adress_nation` WHERE national_id = $national_id";
        $queryp = mysqli_query($mysqli,$sqlp);
        $rowp = mysqli_fetch_assoc($queryp);
        
        $provinces_id = $rowp["province"];
        $district = $rowp["district"];
        $Sub_district = $rowp["sub_district"];
        
        
        $sqlq = "SELECT * FROM `provinces` WHERE id = $provinces_id";
        $queryq = mysqli_query($mysqli,$sqlq);
        $rowq = mysqli_fetch_assoc($queryq);
    
        $sqlw = "SELECT * FROM `amphures` WHERE id = $district";
        $queryw = mysqli_query($mysqli,$sqlw);
        $roww = mysqli_fetch_assoc($queryw);
        
        $sqle = "SELECT * FROM `districts` WHERE id = $Sub_district";
        $querye = mysqli_query($mysqli,$sqle);
        $rowe = mysqli_fetch_assoc($querye);
    
    $pdf->Image('logo/1.png',90,10,30);
    $pdf->SetY(38);
    $pdf->Cell(0,9,iconv('utf-8','cp874','ใบรับสมัคร'),0,1,'C');
    $pdf->Cell(0,9,iconv('utf-8','cp874','การคัดเลือกเข้าศึกษาต่อในมหาวิทยาลัยเกษตรศาสตร์'),0,1,'C');
    $pdf->Cell(0,9,iconv('utf-8','cp874','วิทยาเขตเฉลิมพรเกียรติ จังหวัดสกลนคร'),0,1,'C');
    $pdf->Cell(0,9,iconv('utf-8','cp874','ประจำปีการศึกษา 2566 รอบที่ '.$row['tcas_round']),0,1,'C');
    $pdf->Ln();
    
    $pdf->setFont('sarabun','','16');
    $pdf->Cell(0,8,iconv('utf-8','cp874','รหัสบัตรประจำตัวประชาชน : '.$row ['national_id'].'                ชื่อ - นามสกุล : '.$row ['fname_th'].'  '.$row['lname_th']),0,1);
    $pdf->Cell(0,8,iconv('utf-8','cp874','วัน เดือน ปีเกิด : '.$row ['bday'].'            สัญชาติ : '.$row ['ethnicity'].'       เชื้อชาติ : '.$row['nationality'].'        ศาสนา : '.$row['religion']),0,1);
    $pdf->Cell(0,8,iconv('utf-8','cp874','บ้านเลขที่  : '.$rowp ['house_number'].'  หมู่ที่ : '.$rowp ['group'].'  ตำบล : '.$rowe['name_th'].'  อำเภอ : '.$roww['name_th'].'  จังหวัด : '.$rowq['name_th'].' '.$rowe['zip_code']),0,1);
    $pdf->Cell(0,8,iconv('utf-8','cp874',' โทรศัพท์บ้าน '.$row ['telephone_home'].'   โทรศัพท์มือถือ : '.$row ['telephone_number'].' Email : '.$row['email']),0,1);
    
    $sql = "SELECT * FROM `education_student_round4` WHERE major_id = $major_id";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($query);
        $major_id = $row["major_id"];
        $education_id = $row["education_qualification"];
        $Study_plan = $row["study_plan"];
    
    
        $sqlu = "SELECT * FROM `educational_qualification` WHERE education_id = $education_id";
        $queryu = mysqli_query($mysqli,$sqlu);
        $rowu = mysqli_fetch_assoc($queryu);
    
        $sqlt = "SELECT * FROM `stady_plan` WHERE stady_plan_id = $Study_plan";
    $queryt = mysqli_query($mysqli,$sqlt);
    $rowt = mysqli_fetch_assoc($queryt);
    
    $sqli = "SELECT * FROM `major` WHERE major_id = $major_id";
    $queryi = mysqli_query($mysqli,$sqli);
    $rowi = mysqli_fetch_assoc($queryi);
    $group_id = $rowi["group_id"];
    
    $sqlp = "SELECT * FROM `group` WHERE group_id = $group_id";
    $queryp = mysqli_query($mysqli,$sqlp);
    $rowp = mysqli_fetch_assoc($queryp);
    
    $pdf->setFont('sarabunB','','18');
    $pdf->Cell(0,10,iconv('utf-8','cp874','ข้อมูลการศึกษา'),0,1);
    
    $pdf->setFont('sarabun','','16');
    $pdf->Cell(0,8,iconv('utf-8','cp874','ผลการเรียนเฉลี่ยสะสม : '.$rowu['education_type'].' ('.$rowt['stady_plan'].')  รวมเป็น '.$row['average_GPA']),0,1);
    $pdf->Cell(0,8,iconv('utf-8','cp874','ชื่อโรงเรียน : '.$row ['school']),0,1);
    
    
    $pdf->setFont('sarabunB','','18');
    $pdf->Cell(0,9,iconv('utf-8','cp874','สมัครเข้าศึกษา  : '.$rowp ['group']),0,1);
    $pdf->Cell(0,9,iconv('utf-8','cp874','หลักสูตร   : '.$rowi ['major']),0,1);
    
    $pdf->setFont('sarabun','','16');
    $pdf->Cell(0,7,iconv('utf-8','cp874','             ข้าพเจ้าขอรับรองว่ามีคุณสมบัติครบตามประกาศรับสมัครของมหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตเฉลิมพระเกียรติ  '),0,1);
    $pdf->Cell(0,7,iconv('utf-8','cp874','จังหวัดสกลนคร ทุกประการ หากตรตรวจสอบในภายหลังพบว่าขาดคุณสมบัติ ข้าพเจ้ายินดีให้มหาวิทยาลัยตัดสิทธิ์ในการเข้าศึกษา'),0,1);
    $pdf->Cell(0,7,iconv('utf-8','cp874','โดยไม่มีข้ออุทธรณ์ใดๆ ทั้งสิ้น'),0,1);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    
    $sql = "SELECT * FROM `applications` WHERE national_id = $national_id";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($query);
    
    $pdf->setFont('sarabun','','16');
    $pdf->Cell(0,8,iconv('utf-8','cp874',' ลงชื่อ '.$row ['fname_th'].'  '.$row['lname_th'].' ผู้สมัคร '),0,1,'R');
    $pdf->Cell(0,8,iconv('utf-8','cp874',' ( '.$row ['fname_th'].'  '.$row['lname_th'].' ) '),0,1,'R');
    
    $pdf->Output();

    }
?>