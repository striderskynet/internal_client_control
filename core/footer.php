<link rel="stylesheet" type="text/css" href="assets/css/app.css">
<?php if ( isset ( $_SESSION['userUUID'] ) && $populate ) { ?>
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


<div class="push"></div>
</div>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-4 mb-md-0 text-muted text-decoration-none lh-1">
        <i class="fa fa-user"></i>
      </a>
      <span class="text-muted">&copy; 2022 Olazabal's, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-twitter"></i></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-instagram"></i></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-facebook"></i></a></li>
      </ul>
  </footer>
</body>
</html>