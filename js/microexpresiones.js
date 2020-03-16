var imatgeActual = 'X';
var arrayImatgesOriginals = [];
var arrayImatgesOrdenades = [];
var solucions = [];
var paginaActual = 0;
var pagines = arrayImatgesOriginals.length;
var paginesRespostes = 0;
var totalPaginesRespostes = 0;

function mostrarActivitat() {
  $.ajax({
    url: "ajax/mostrarEsquemaActivitat.php",
    cache: false,
    type: "GET",
    success: function (model) {
      $("#activitat").html(model);

      $('#comenca').click(function () {
        inicialitzarActivitat();

        /*$('#next').click(function () {
          next();
        });*/

      });


    }
  });
}

function inicialitzarActivitat() {
  //Fer estructura per l'activitat:
  var cntActivitat = "  <div id='imatges' class='col-md-12 imatges'></div>";
  cntActivitat += "<div style='clear: both;'></div>";
  cntActivitat += "<div id='botons' class='cnt_botons'>";
  cntActivitat += "<button id='intima' class='apartat'>Íntima</button>";
  cntActivitat += "<button id='personal' class='apartat'>Personal</button>";
  cntActivitat += "<div style='clear: both'></div>";
  cntActivitat += "<button id='publica' class='apartat'>Social</button>";
  cntActivitat += "<button id='social' class='apartat'>Pública</button>";
  cntActivitat += "<div style='clear: both;'></div></div>";
  cntActivitat += "<div id='pagines' class='pagines'></div>";

  $('#activitat').html(cntActivitat);

  arrayImatgesOriginals = ['intima-1', 'intima-2', 'intima-3', 'intima-4', 'intima-5', 'personal-1', 'personal-2', 'personal-3', 'personal-4', 'personal-5', 'personal-6', 'publica-1', 'publica-2', 'publica-3', 'publica-4', 'social-1', 'social-2', 'social-3', 'social-4'];
  pagines = arrayImatgesOriginals.length;
  arrayImatgesOrdenades = [];
  solucions = [];
  next();

  $('.apartat').click(function () {
    var id = $(this).attr('id');
    solucions.push(id); //afegim la id del botó clicat a l'array de solucions per controlar la solució marcada
     next();
  });
}

function next() {
  var arrayLength  = arrayImatgesOriginals.length;
  if (arrayLength > 0) {
    paginaActual++;
    var aleatori = Math.floor((Math.random() * arrayLength));
    imatgeActual = arrayImatgesOriginals[aleatori];
    var imatge = "<img id='" + imatgeActual + "' src='img/" + imatgeActual + ".jpg'>";
    $('#imatges').html(imatge);
    $('#pagines').html('Imatge ' + paginaActual + ' de ' + pagines);
    //Eliminem a partir de la posicio aleatori 1 posicio.
    arrayImatgesOriginals.splice(aleatori, 1);
    //Afegim la imatge mostrara a l'array per saber en quin ordre hem mostrat les imatges
    arrayImatgesOrdenades.push(imatgeActual);
  } else {
    mostrarResultat();
  }
}

function mostrarResultat() {
  paginesRespostes = 1;
  totalPaginesRespostes = (solucions.length / 12).toFixed(0);

  var mostrar1 = "<p class='titol'>Les teves respostes</p>";
  mostrar1 += mostrarResultatArray(paginesRespostes, 0, 11);
  paginesRespostes++;
  var mostrar2 = mostrarResultatArray(paginesRespostes, 12, 18);

  //mostrar = "<div id='paginesRespostes' class='pagines'>Imatge " + paginesRespostes + " de " + totalPaginesRespostes + "</div>";
  var mostrar = "<div class='col-md-6 enllac'><div id = 'descarregarPDF'>Descarrega els resultats en PDF</div></div>";
  //mostrar += "<div class='col-md-6 enllac'><div id = 'veurePagina2'>Veure la pàgina 2</div></div>";
  mostrar += "<div style='clear: both;'></div>";

  $('#activitat').html(mostrar1 + mostrar2 + mostrar);
  $("#activitat").css("background","#ffffff");

  /*$('#activitatPart2').css('display','none');
  $('#activitatPart1').css('display','');*/

  $('#descarregarPDF').click(function () {
    descarregarPDF();
  });

  /*$('#veurePagina2').click(function () {
    if ($('#veurePagina2').html() == 'Veure la pàgina 2') {
      $('#veurePagina2').html('Veure la pàgina 1');
      $('#activitatPart1').css('display','');
      $('#activitatPart2').css('display','none');
    } else {
      $('#veurePagina2').html('Veure la pàgina 2');
      $('#activitatPart2').css('display','');
      $('#activitatPart1').css('display','none');
    }
  });*/
}

function mostrarNomAmbAccents(nom) {
  var nomAdequat;
  if (nom == 'intima')
    nomAdequat = 'Íntima';
  else if (nom == 'personal')
    nomAdequat = 'Personal';
  else if (nom == 'publica')
    nomAdequat = 'Pública';
  else if (nom == 'social')
    nomAdequat = 'Social';

  return nomAdequat;
}

function mostrarResultatArray(paginesRespostes, inici, fi) {
  var mostrar = "";
  mostrar += "<div id='activitatPart" + paginesRespostes + "'>";
  var imatgeOrdenacio = '';
  var solucioMarcada = '';
  var solucioCorrecta = '';
  var text = '';

  for (var i = inici; i <= fi; i++) {
    solucioMarcada = solucions[i];
    solucioCorrecta = arrayImatgesOrdenades[i].substring(0, arrayImatgesOrdenades[i].length - 2);

    if (solucioCorrecta == solucioMarcada)
      text = mostrarNomAmbAccents(solucioCorrecta);
    else
      text = "<span class='tatxat'>" + mostrarNomAmbAccents(solucioMarcada) + "</span> " + mostrarNomAmbAccents(solucioCorrecta);

    mostrar += "<div id='imatges_respostes' class='col-md-3 imatgesRespostes'>";
    mostrar += "<img id=" + arrayImatgesOrdenades[i];
    mostrar += " src='img/" + arrayImatgesOrdenades[i] + ".jpg'>";
    mostrar += "<p>" + text + "</p>"
    mostrar += "</div>";
  }
  mostrar += "<div style='clear: both;'></div></div>";
  return mostrar;
}

function descarregarPDF() {
  html2canvas($("#activitat").css("background","#ffffff"), {
    onrendered (canvas) {
      var image = canvas.toDataURL("image/png");
      var doc = new jsPDF('', 'pt', 'a4');
      doc.addImage(image, 'JPEG', 0, 0, 595.28, 592.28/canvas.width * canvas.height);
      doc.save('encerta-la-distancia.pdf');
      $('#imatgesRespostes').css('margin-bottom','0px');
    }
  });
}
