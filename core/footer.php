
<link rel="stylesheet" type="text/css" href="assets/css/app.css">
<?php if ( isset ( $_SESSION['userUUID'] ) ) { ?>
<script src="assets/js/app.js"></script>
<script>
    if ( data != null ){
        rg = document.getElementById("row-group");
        rg.innerHTML = populateTable();
    }

    $(function(){
        $('.date_picker input').datepicker({
           format: "yyyy-mm-dd",
           todayBtn: "linked",
           todayHighlight: "true",
        });
    });
</script>
<?php } ?>

</body>
</html>