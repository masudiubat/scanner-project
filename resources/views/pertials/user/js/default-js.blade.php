<!-- jQuery 2.2.3 -->
<script src="{{url('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<!--<script src="{{url('assets/plugins/morris/morris.min.js')}}"></script>-->
<!-- Sparkline -->
<script src="{{url('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{url('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{url('assets/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{url('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('assets/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="{{url('assets/dist/js/pages/dashboard.js')}}"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/dist/js/demo.js')}}"></script>

<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- Confirmation message -->
<script src="{{url('assets/js/jquery.confirm.min.js')}}"></script>

<!-- Menu Active -->
<script src="{{url('assets/js/active-menu.js')}}"></script>



<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

<script>
    $(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

<script>
    $(".confirm").confirm({
        text: "Are you sure to delete this?",
        title: "Confirmation required",
    });
</script>

<script>
    $(".verificationconfirm").confirm({
        text: "Are you sure to verify this request?",
        title: "Confirmation required",
    });
</script>










<script>
    function myFunction() {
        console.log("Yes! you are here!");
        var adminid = "{{ Session::get('admin_id')}}";
        var url = "{{url('/admin-image-id')}}/" + adminid;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function (data) {
            console.log(data.adminImage['image']);
            var image = "{{url('assets/admin/images/admin')}}/" + data.adminImage['image'];
            console.log(image);
            $('#output').html('<img src="' + image  + '" />');                   
        });
    }
</script>








<script>
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>


<script>
  $('#editUrlModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var url = button.data('url') // Extract info from data-* attributes
    var urlid = button.data('urlid') // Extract info from data-* attributes
    
    var modal = $(this)
    modal.find('.modal-body #url').val(url)
    modal.find('.modal-body #urlid').val(urlid)
  })


</script>

<script>
    $(document).ready(function() {
    $("#downloadtxt").click(function(){
        alert($(this).val());
    }); 
});

</script>

@if(Session::has('data'))
<script>
    $('#confirmationModal').modal('show');
</script>                   
@endif


<script>
    /*
    $('.preventsubmission').click( function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log(url);
        $.ajax({
            url: url,
            method: "GET",
        });
    });
    */
</script>