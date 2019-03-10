<!-- jQuery 2.2.3 -->
<script src="{{url('assets/user/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.6 -->
<script src="{{url('assets/user/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<!--<script src="{{url('assets/plugins/morris/morris.min.js')}}"></script>-->


<!-- FastClick -->
<script src="{{url('assets/user/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/user/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="{{url('assets/dist/js/pages/dashboard.js')}}"></script>-->




<!-- Confirmation message -->
<script src="{{url('assets/user/js/jquery.confirm.min.js')}}"></script>

<!-- Datepeaker js -->
<script src="{{url('assets/user/js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{url('assets/user/js/bootstrap-datetimepicker.fr.js')}}"></script>
<script src="{{url('assets/user/js/common-scripts.js')}}"></script>

<!-- DataTables -->
<script src="{{url('assets/user/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/user/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- active menu script -->
<script src="{{asset('assets/user/js/active-menu.js')}}" type="text/javascript"></script>
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

<script>
    $('.standard').change(function () {
        var standard = $('.standard').val();
        var url = "{{url('/selected-standard')}}/" + standard;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function (data) {            
            var $subject = $('#subject');
            $subject.empty();
            $subject.append('<option value="" > Select Subject</option>');
            for (var i = 0; i < data.subjectList.length; i++) {
                $subject.append('<option value=' + data.subjectList[i]['id'] + '>' + data.subjectList[i]['name'] +  '</option>');
            }
        });
    });
</script>


<script>
    $('.standard_for_topic').change(function () {
        var standard = $('.standard_for_topic').val();
        var url = "{{url('/standard-for-topic')}}/" + standard;
        console.log(url);
        $.ajax({
            url: url,
            method: "GET",
        }).done(function (data) {            
            var $subject = $('#subject_for_topic');
            $subject.empty();
            $subject.append('<option value="" > Select Subject</option>');
            for (var i = 0; i < data.subjectList.length; i++) {
                $subject.append('<option value=' + data.subjectList[i]['id'] + '>' + data.subjectList[i]['name'] +  '</option>');
            }
        });
    });
</script>

<script>
    $('.subject_for_topic').change(function () {
        var standard = $('.standard_for_topic').val();
        var subject = $('.subject_for_topic').val();
        var url = "{{url('/subject-for-topic')}}/" + subject + ',' + standard;
        console.log(url);
        $.ajax({
            url: url,
            method: "GET",
        }).done(function (data) {
            var $chapter = $('#chapter_for_topic');
            $chapter.empty();
            $chapter.append('<option value="" > Select Chapter</option>');
            for (var j = 0; j < data.chapterList.length; j++) {
                $subject.append('<option value=' + data.chapterList[j]['id'] + '>' + data.chapterList[j]['name'] +  '</option>');
            }     
        });
        
    });
</script>

<!-- End Script for Change Password Modal -->
<!-- JQuery for calendar -->