<script type="text/javascript">
  $(document).on('click', '.delete-object', function() {

   var id = $(this).attr('delete-id');

   bootbox.confirm({
    message: "<h4>Are you sure?</h4>",
    buttons: {
      confirm: {
        label: '<span class="glyphicon glyphicon-ok"></span> Yes',
        className: 'btn-danger'
      },
      cancel: {
        label: '<span class="glyphicon glyphicon-remove"></span> No',
        className: 'btn-primary'
      }
    },
    callback: function(result) {
      if(result == true) {
        $.post('delete_user.php', {
         object_id: id
       }, function(data) {
         location.reload();
       }). fail(function() {
         alert('Unable to delete.');
       });
      }
    }
  });
  return false;
});
</script>



</div>
<!-- container -->


<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- bootbox JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
