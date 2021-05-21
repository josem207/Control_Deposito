
 <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">          
              <p class="no-margin-bottom">2019 &copy; Jose I. Martinez.</p>
            </div>
          </div>
 </footer>

<!--para la base de este sistema web utilize un template de la pagina Bootstrapious, para poder centrarme mas en lo que es funcionalidad, aunque modifique bastante el tema para lograr dejarlo a mi gusto. -->

<!-- Archivos JavaScript de tema utilizado:  -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
    <script src="js/20front.js"></script> 

<!-- SCript para mostrar/ocultar contraseña: -->
<script type="text/javascript">
//  Usuarios>primer contraseña: 
function mostrarPassword(){
    var cambio = document.getElementById("1Password");
    if(cambio.type == "password"){
      cambio.type = "text";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}   
//  Usuarios>2da contraseña: 
function mostrarPassword2(){
    var cambio = document.getElementById("2Password");
    if(cambio.type == "password"){
      cambio.type = "text";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}  
//  Login>contraseña: 
  $(document).ready(function () {
  //CheckBox que muestra contraseña
  $('#VerPassword').click(function () {
    $('#login-password').attr('type', $(this).is(':checked') ? 'text' : 'password');
  });
});
</script>