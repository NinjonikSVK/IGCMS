<?php
	require_once("../../../config/config.php");

	$file = $_SERVER['PHP_SELF'];
	$info = pathinfo($file);
	$file_name =  basename($file,'.'.$info['extension']);
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Author of this template: CreativeTim -->
	<meta charset="utf-8" />
	<script src="../ckeditor/ckeditor.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
	<link rel="apple-touch-icon" sizes="76x76" href="../../../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../../../../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $siteTitle; ?> | <?php echo $file_name; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	
	<!-- Dizajn pre fórum -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="../../../../assets/forum.css" rel="stylesheet">
	
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="../../../../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../../../assets/css/material-kit.css?v=1.2.1" rel="stylesheet"/>

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="../../../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
	<link href="../../../../assets/assets-for-demo/demo.css" rel="stylesheet" />

	<!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/>
	<meta charset="utf-8"/>
	<!--<![endif]-->

	
	<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

	<style>::-webkit-scrollbar{width:10px}::-webkit-scrollbar-track{background:#cccccc;border-radius:15px}::-webkit-scrollbar-thumb{background:#000075;border-radius:15px}</style>

	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		table,
		td,
		tr {
			vertical-align: top;
			border-collapse: collapse;
		}

		* {
			line-height: inherit;
		}

		a[x-apple-data-detectors=true] {
			color: inherit !important;
			text-decoration: none !important;
		}
	</style>
<style id="media-query" type="text/css">
		@media (max-width: 620px) {

			.block-grid,
			.col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			}

			.block-grid {
				width: 100% !important;
			}

			.col {
				width: 100% !important;
			}

			.col>div {
				margin: 0 auto;
			}

			img.fullwidth,
			img.fullwidthOnMobile {
				max-width: 100% !important;
			}

			.no-stack .col {
				min-width: 0 !important;
				display: table-cell !important;
			}

			.no-stack.two-up .col {
				width: 50% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num8 {
				width: 66% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num3 {
				width: 25% !important;
			}

			.no-stack .col.num6 {
				width: 50% !important;
			}

			.no-stack .col.num9 {
				width: 75% !important;
			}

			.video-block {
				max-width: none !important;
			}

			.mobile_hide {
				min-height: 0px;
				max-height: 0px;
				max-width: 0px;
				display: none;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide {
				display: block !important;
				max-height: none !important;
			}
		}
	</style>

</head>
<!--
	IGPortals, a všetky značky ktoré sa začínajú IG (Innovation Gaming) sú vo vlastníctvu IGPortals, a IGPortals (Innovation Gaming Portals) je vo vlastníctve Ninjonika SVK.
	Žiadna časť tejto stránky ani jej kódu nesmie byť nikde publikovaná ani využívaná bez písomného súhlasu vlastníka.
	Dizajn stránky podlieha dizajnérom, ktorý template nadizajnovali a nascriptovali.
	Všetky veci, ktoré obsahujú PHP kód sú vo vlastníctve IGPortals.
-->
