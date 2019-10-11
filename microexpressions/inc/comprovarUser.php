<?php
include('../../../../../intranet/inc/dades_moodle.php');

$user_course = false;

$dni_user = $USER->username;

$connexio_m = mysqli_connect('localhost',$usuari_m,$pw_m,$bbdd_m);
if (mysqli_connect_errno()) {
  echo "No es pot connectar: " . mysqli_connect_error();
}
else {
  mysqli_set_charset($connexio_m, "utf8");

  /* Agafa el dni del usuari */
  $sql_id_user_moodle = "SELECT id FROM `mdl_user` where username like '".$dni_user."%'";

  $result_id_user_moodle = mysqli_query($connexio_m, $sql_id_user_moodle);
  $row_id_usuari_moodle = mysqli_fetch_array($result_id_user_moodle);
  $id_user_moodle = $row_id_usuari_moodle['id'];

  //Si és algu del despatx, pot accedir a l'activitat
  if ($id_user_moodle == 1006 or $id_user_moodle == 125 or $id_user_moodle == 6564 or $id_user_moodle == 28873 or $id_user_moodle == 14703 or $id_user_moodle == 18107 or $id_user_moodle == 16413 or $id_user_moodle == 14706)
    $user_course = true;
  else  {
    //Si és algun tutor que està al Laboratori, pot accedir a l'activitat

    //Obtenim les persones que es troben en el curs $course del laboratori
    $sql_course_lab_moodle = "SELECT * FROM mdl_user_enrolments WHERE enrolid = (SELECT e.id FROM mdl_enrol AS e WHERE courseid = (SELECT c.id FROM mdl_course as c where shortname like '%".$course."%LAB%') and e.enrol = 'manual')";
    $result_course_lab_moodle = mysqli_query($connexio_m, $sql_course_lab_moodle);

    $is_user = false;
    while ($row_course_lab_moodle = mysqli_fetch_array($result_course_lab_moodle) and !$is_user) {
      $id_user_course_moodle = $row_course_lab_moodle['userid'];

      if ($id_user_course_moodle == $id_user_moodle)
        $is_user = true;
    }

    if ($is_user)
      $user_course = true;
    else  {
      //Busques tots els cursos oberts amb codi $curs
      $sql_course_visible_moodle = "SELECT shortname FROM mdl_course where shortname like '%".$course."%' and visible=1";
      $result_course_visible_moodle = mysqli_query($connexio_m, $sql_course_visible_moodle);

      $is_user = false;
      //Per cada curs obert i mentre no estigui inscrit, comproves si esta inscrit.
      // Si està inscrit, $user_course = true;
      while ($row_course_visible_moodle = mysqli_fetch_array($result_course_visible_moodle) and !$is_user) {
        $shortname_course = $row_course_visible_moodle['shortname'];
        $sql_user_in_course_moodle = "SELECT * FROM mdl_user_enrolments WHERE userid = ".$id_user_moodle." and enrolid = (SELECT e.id FROM mdl_enrol AS e WHERE courseid = (SELECT c.id FROM mdl_course as c where shortname like '".$shortname_course."') and e.enrol = 'manual')";
        $result_user_in_course_moodle = mysqli_query($connexio_m, $sql_user_in_course_moodle);
        $row_user_in_course_moodle = mysqli_fetch_array($result_user_in_course_moodle);
        if (mysqli_num_rows($result_user_in_course_moodle)>0) $is_user = true;
      }

      if ($is_user)
        $user_course = true;
    }
  }
}
?>
