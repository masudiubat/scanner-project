<!-- jQuery 2.2.3 -->
<script src="{{url('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.6 -->
<script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<!--<script src="{{url('assets/plugins/morris/morris.min.js')}}"></script>-->


<!-- FastClick -->
<script src="{{url('assets/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="{{url('assets/dist/js/pages/dashboard.js')}}"></script>-->




<!-- Confirmation message -->
<script src="{{url('assets/js/jquery.confirm.min.js')}}"></script>

<!-- Datepeaker js -->
<script src="{{url('assets/js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{url('assets/js/bootstrap-datetimepicker.fr.js')}}"></script>
<script src="{{url('assets/js/common-scripts.js')}}"></script>

<!-- DataTables -->
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- active menu script -->
<script src="{{asset('assets/js/active-menu.js')}}" type="text/javascript"></script>
<!-- active menu script -->

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
        text: "Are you sure to disable this!",
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

<!-- End Script for Change Password Modal -->
<!-- JQuery for calendar -->