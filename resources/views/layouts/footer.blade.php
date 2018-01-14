<script>
    function shit() {


        $.ajax('/faculties/1', {
            success: function(data) {
                document.write(data);
            },
            error: function() {
                alert('fucke');
            }
        });
    }
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- jQuery 3 -->
<script src="/components/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/components/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/adminlte.js"></script>