<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/components/jquery/jquery.min.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap.min.js"></script>
<script src="/components/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/adminlte.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#accordion" ).accordion(
            {
                event: "click",
                active: false,
                collapsible: true,
                autoHeight: false

            }
        );
    });
</script>

<script>
    $(function () {
        $('#example1').DataTable()
    })

    $(document).ready(function () {
        setTimeout(function () {
            $('#message').animate({opacity: 0, height: 0, margin: 0, padding: 0}, 1000, function () {
                $('#message').remove();
            });
        }, 3000);

        $('#selectFaculty').change(function () {
            var selectedFaculty = $('#selectFaculty option:selected').attr('value');

            $.ajax({
                url: '/ajax_degrees/' + selectedFaculty,
                type: 'GET',
                success: function (data) {
                    $('#selectDegree').empty();
                    for (var i = 0; i < data.length; i++) {
                        $('#selectDegree').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['name']));
                    }

                    updateSubject();
                }
            });
        });

        $('#selectDegree').change(updateSubject);

        function updateSubject() {
            var selectedDegree = $('#selectDegree option:selected').attr('value');
            $.ajax({
                url: '/ajax_subjects/' + selectedDegree,
                type: 'GET',
                success: function (data) {
                    $('#selectSubject').empty();
                    for (var i = 0; i < data.length; i++) {
                        $('#selectSubject').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['name']));
                    }
                }
            });
        }
    });
</script>