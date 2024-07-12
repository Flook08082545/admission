<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#edu_qualification').change(function() {
    var id_edu_qualification = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db2.php",
      data: {id:id_edu_qualification,function:'edu_qualification'},
      success: function(data){
          $('#stady_plan').html(data); 
      }
    });
  });
</script>