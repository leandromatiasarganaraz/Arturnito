</div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="">ARturnito</a>.</strong> All rights reserved.
  </footer>
</div>

 <script type="text/javascript">
          $(document).ready(function() {
            $('#submit').click(function() {
              alertify.confirm('', '¿Seguro desea cerrar sesion?', function(){ window.location="../../global/logout.php"; }
                , function(){ window.location="../../index.php";});
                 return false;
            });
          });
      
function ventanaSecundariaPantalla (URL){ 
   window.open(URL,"ventana","width=800,height=800,scrollbars=NO") 
} 
function ventanaSecundariaTurnos (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=NO") 
} 
</script>