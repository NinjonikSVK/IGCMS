 <?php

 $stmt2 = $db->prepare('SELECT * FROM footer WHERE id=:id');
 $stmt2->execute(array(':id' => 1));
 $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
 $stmt3 = $db->prepare('SELECT * FROM footer WHERE id=:id');
 $stmt3->execute(array(':id' => 2));
 $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
 $stmt4 = $db->prepare('SELECT * FROM footer WHERE id=:id');
 $stmt4->execute(array(':id' => 3));
 $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

 ?>
					<!--    *********    BIG FOOTER     *********      -->

					<footer class="footer footer-black footer-big">
						<div class="container">
							<div class="content">
								<div class="row">
									<div class="col-md-4">
										<h5><?php echo $row2["title"]; ?></h5>
										<p><?php echo $row2["descr"]; ?></p>
									</div>

									<div class="col-md-4">
										<h5><?php echo $row3["title"]; ?></h5>
										<p><?php echo $row3["descr"]; ?></p>
									</div>

									<div class="col-md-4">
										<h5><?php echo $row4["title"]; ?></h5>
										<p><?php echo $row4["descr"]; ?></p>
									</div>
								</div>
							</div>


							<hr />

							

							<div class="copyright pull-right">
								Copyright &copy; 2018-<script>document.write(new Date().getFullYear())</script> NinjonikSVK, DragonMan, all rights reserved.
							</div>
						</div>
					</footer>
<!--

</body>-->
</body>

	<script src="../pages/base.js"></script>
	<!--   Core JS Files   -->
	<script src="../../../../assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../../../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../../../assets/js/material.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="../../../../assets/js/moment.min.js"></script>

	<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="../../../../assets/js/nouislider.min.js" type="text/javascript"></script>

	<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
	<script src="../../../../assets/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

	<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
	<script src="../../../../assets/js/bootstrap-selectpicker.js" type="text/javascript"></script>

	<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
	<script src="../../../../assets/js/bootstrap-tagsinput.js"></script>

	<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
	<script src="../../../../assets/js/jasny-bootstrap.min.js"></script>

	<!-- Plugin For Google Maps -->
	<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>



	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="../../../../assets/js/material-kit.js?v=1.2.1" type="text/javascript"></script>

	<!-- Fixed Sidebar Nav - JS For Demo Purpose, Don't Include it in your project -->
	<script src="../../../../assets/assets-for-demo/modernizr.js" type="text/javascript"></script>
	<script src="../../../../assets/assets-for-demo/vertical-nav.js" type="text/javascript"></script>

	<script type="/text/javascript">

		$(document).ready(function(){
			var slider = document.getElementById('sliderRegular');

	        noUiSlider.create(slider, {
	            start: 40,
	            connect: [true,false],
	            range: {
	                min: 0,
	                max: 100
	            }
	        });

	        var slider2 = document.getElementById('sliderDouble');

	        noUiSlider.create(slider2, {
	            start: [ 20, 60 ],
	            connect: true,
	            range: {
	                min:  0,
	                max:  100
	            }
	        });



			materialKit.initFormExtendedDatetimepickers();

		});
	</script>
	<script>
	initSample();
</script>
<script>

            var time, h, m, s, track;
            track = 0;
            window.onload = function() { setInterval( timeNow, 100); }

            function timeNow() {

              time = new Date();
              track += 1;
			  y = time.getFullYear();
			   xy = time.getDate();
			var d = new Date();
			var month = new Array();
			month[0] = "Januára";
			month[1] = "Februára";
			month[2] = "Marca";
			month[3] = "Apríla";
			month[4] = "Mája";
			month[5] = "Júna";
			month[6] = "Júľa";
			month[7] = "Augusta";
			month[8] = "Septembra";
			month[9] = "Októbera";
			month[10] = "Novembra";
			month[11] = "Decembra";
			var x = month[d.getMonth()];
			  var weekday = new Array(7);
			  weekday[0] = "Nedeľa";
			  weekday[1] = "Pondelok";
			  weekday[2] = "Utorok";
			  weekday[3] = "Streda";
			  weekday[4] = "Štvrtok";
			  weekday[5] = "Piatok";
			  weekday[6] = "Sobota";

			  var n = weekday[d.getDay()];
              h = time.getHours();
              m = time.getMinutes();
              s = time.getSeconds();
              if ( s < 10 ) { s = "0" + s; } /* we add a 0 in front of s, when it is lower than 10, because that's what most clocks display, this is for the human user rather than for any need by the computer */
              document.getElementById("time").innerHTML = n + '\xa0' + xy + '.' + '\xa0' + x + '\xa0' + y + '\xa0\xa0\xa0' + h + ':' + m + ':' + s;

            }

        </script>
</html>
