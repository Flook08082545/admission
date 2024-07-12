<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#edu_qualification_edit').change(function() {
    var id_edu_qualification_edit = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db3.php",
      data: {id:id_edu_qualification_edit,function:'edu_qualification_edit'},
      success: function(data){
          $('#Study_plan_edit').html(data); 
      }
    });
  });
</script>