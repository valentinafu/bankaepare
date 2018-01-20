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

    $(document).ready(
        setTimeout(function () {
            $('#uploadMessage').animate({opacity: 0, height: 0, margin: 0, padding: 0}, 1000, function () {
                $('#uploadMessage').remove();
            });
        }, 3000)
    );

    function shit() {
        $.ajax('/ajax_faculties/1', {
            success: function(data) {
                alert(degrees[0]['name']);



                var degrees = JSON.parse(data);
                var links = document.getElementById('sidebarElements');

                for (var i=0;i<links.childElementCount;i++)
                    links.removeChild(links.child)


                for (var i=o;i<degrees.length;i++) {
                    var li = document.createElement("li");
                    var a = document.createElement("a");
                    var span = document.createElement("sphpan");

                    span.setAttribute('onclick','shit();'); // for FF
                    span.onclick = function() {shit();}; // for IE
                    //span.appendChild(document.createTextNode(degrees[i]['name']));

                    //a.appendChild(span);
                    li.appendChild(a);
                    links.appendChild(li);
                }
            },
            error: function() {
                alert('fucke');
            }
        });
    }
</script>