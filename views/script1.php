<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#provinces_1').change(function() {
    var id_province = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db1.php",
      data: {id:id_province,function:'provinces'},
      success: function(data){
          $('#amphures_1').html(data); 
          $('#districts_1').html(' '); 
          $('#districts_1').val(' ');  
          $('#zip_code_1').val(' '); 
      }
    });
  });

  $('#amphures_1').change(function() {
    var id_amphures = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db1.php",
      data: {id:id_amphures,function:'amphures'},
      success: function(data){
          $('#districts_1').html(data);  
      }
    });
  });

   $('#districts_1').change(function() {
    var id_districts= $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db1.php",
      data: {id:id_districts,function:'districts'},
      success: function(data){
          $('#zip_code_1').val(data)
      }
    });
  
  });
</script>