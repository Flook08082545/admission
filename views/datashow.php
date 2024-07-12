<?php
    include("../config.php");
    if(isset($_POST["input"])){
        
        $input = $_POST["input"];
        if($input != ""){
            $query = "SELECT * FROM major WHERE grade <= '{$input}%'";
        }else{
            $query = "SELECT * FROM major";
        }
        $reuslt = mysqli_query($mysqli,$query);

        if(mysqli_num_rows($reuslt) > 0){
?>            
            <?php
                              While($f = mysqli_fetch_array($reuslt)){
                                $major_new = $f["major"];
                            ?>
                            <option value='<?php echo $f['major_id'];?>'><?php echo $major_new;?><?php echo $f['major_id'];?></option>
                            <?php }?>
            
        <?php }?>
<?php 
}else{
?>


<?php
}