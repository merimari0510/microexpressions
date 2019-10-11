<?php

require('../../../../config.php');

$course = 'CNV'; //CODI_CURS QUE TOCA
?>
<!DOCTYPE html>
<html lang="ca">
<head>
	<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Responsive meta tag -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Quan el cos parla. Anàlisi i Estratègies de Comunicació No Verbal</title>

	<!-- Description meta tag -->
	<meta name="Description" content="Activitat «Atreveix-te amb les Expressions Facials!» per el curs «Quan el cos parla. Anàlisi i Estratègies de Comunicació No Verbal»">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Colors CSS -->
	<link rel="stylesheet" href="css/variables.css">

	<!-- jQuery JS-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Activitat JS -->
  <script language="Javascript" src="js/expressions-facials.js"></script>
</head>
<body topmargin="0">
  <div id="row_activitat" class="row">
  		<?php
  		if (isloggedin()) {
        include('./inc/comprovarUser.php');
  			if($user_course) {
  			?>
  			 <script>
  				var es_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
  				var es_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;

  				if (!es_chrome && !es_firefox) {
  					$('#row_activitat').html("<div id='activitat' class='col-md-12 marc_activitat_error'><div class='error'><img class='capcalera' src='https://www.prisma.cat/campus/documents/activitat/banner_prisma_rectangle.png'></div><div id='cos_error'><p style='margin-right: 40px; margin-left: 40px; text-align: center; line-height: 25px;'>Per evitar incompatibilitats és necessari utilitzar el navegador <a href='https://www.google.com/intl/es/chrome/browser/?hl=es' target='_blank' class='navegador'>Chrome</a> o <a href='https://www.mozilla.org/es-ES/firefox/new/' target='_blank' class='navegador'>Firefox</a>.</p><p style='margin-right: 40px; margin-left: 40px; text-align: center; line-height: 25px; text-align: center'>Per a qualsevol dubte podeu enviar-nos un correu a través del formulari d'<a href='https://www.prisma.cat/menu/usuari/suport.php' target='_blank' class='navegador'>Incidències tècniques</a>.</p></div><div id='peu' align='center'><br>Pl. Poeta Marquina 5, 1r-1a · 17002 Girona · 972 21 75 65 · 678 12 36 87 · <a href='https://www.prisma.cat' target='_blank'>www.prisma.cat</a> · secretaria@prisma.cat</div></div>");
  				}
          else {
            $('#row_activitat').html("<div id='activitat' class='col-md-12 marc_activitat'></div>");
            mostrarActivitat();
          }
  			</script>
  			<?php
  			}
  			else {
          include('./inc/errorNoInscritCurs.php');
  			}
  		}
  		else {
        include('./inc/errorNoIniciatSessio.php');
        ?>

        <?php
  		}
  		?>
    <div style="clear: both;"></div>
  </div>

  <!-- Marc de l'activitat i inicar sessió en el curs corresponent CSS -->
  <link rel="stylesheet" href="css/login.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Activitat CSS -->
  <link rel="stylesheet" href="css/expressions-facials.css">

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>

</html>
