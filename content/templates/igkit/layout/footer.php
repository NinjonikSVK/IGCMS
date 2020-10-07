<!-- Footer -->
<footer class="page-footer font-small mdb-color lighten-3 pt-4">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018-<?php echo date("Y"); ?> Copyright:
  <a href="http://igportals.eu"> NinjonikSVK <a href="index?lang=sk" width="30" height="10">
					<img src="/assets/img/flags/RU.png">
				  </a>
				  <a href="index?lang=cs">
					<img src="/assets/img/flags/CZ.png">
				  </a>
				  <a href="index?lang=en">
					<img src="/assets/img/flags/GB.png">
				  </a></a>
</div>
<!-- Copyright -->

</footer>


</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-slim.min.js"><\/script>')</script><script src="../js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="../js/main.js" ></script>
<script>
$(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});
$(document).ready(function() {
    var brand = document.getElementById('logo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {
        document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo-id").change(function() {
        readURL(this);
    });
});
</script>
<!--<endora></endora>-->
</body>
</html>
<!-- Footer -->