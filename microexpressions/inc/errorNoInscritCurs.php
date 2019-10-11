<?php
include('../../../../../intranet/inc/dades.php');
$connexio = mysqli_connect('localhost',$usuari,$pw,$bbdd);
if (mysqli_connect_errno())	{
echo "No es pot connectar: " . mysqli_connect_error();
}
else {
  mysqli_set_charset($connexio, "utf8");
  $sql_course = "SELECT `NOM CURS` as nom FROM cursos where `DATA INICI` >= CURRENT_DATE and curs like '".$course."' order by id_Curs ASC limit 1";
  $result_course = mysqli_query($connexio, $sql_course);
  $row_course = mysqli_fetch_array($result_course);
  $titol_curs = $row_course['nom'];
}
?>
<div id="activitat" class="col-md-12 marc_activitat_error">
  <div class="error"><img class='capcalera' src="https://www.prisma.cat/campus/documents/activitat/banner_prisma_rectangle.png"></div>
  <div class="col-md-12 cos_error">
    <p style="margin-right: 40px; margin-left: 40px; text-align: center; line-height: 25px;">Per accedir a l’activitat has d’estar inscrit al curs <span style="color: #23527c; font-weight: bold;"><?php echo $titol_curs ?></span> i aquest encara ha d’estar obert.</p>
  </div>

  <div class="col-md-12 peu">
    <br>Pl. Poeta Marquina 5, 1r-1a · 17002 Girona · 972 21 75 65 · 678 12 36 87 · <a href="https://www.prisma.cat" target="_blank">www.prisma.cat</a> · secretaria@prisma.cat
  </div>
</div>
