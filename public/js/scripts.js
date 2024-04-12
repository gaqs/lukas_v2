window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebar_toggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

function checkRut(rut) {
    var valor = rut.value.replace('.','');
    valor = valor.replaceAll('-','');
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    rut.value = cuerpo + '-'+ dv
    if(cuerpo.length < 7) { return false; }
    suma = 0;
    multiplo = 2;
    for(i=1;i<=cuerpo.length;i++) {
        index = multiplo * valor.charAt(cuerpo.length - i);
        suma = suma + index;
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
    }
    dvEsperado = 11 - (suma % 11);
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    if(dvEsperado != dv) {  return false; }
    rut.setCustomValidity('');
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

var exampleModal = document.getElementById('delete_form_modal')
if( exampleModal != null ){
  exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    //modalTitle.textContent = 'New message to ' + recipient
    modalBodyInput.value = recipient
  })
}


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="true"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

$('textarea').on("propertychange keyup input paste ready", function () {
  var limit = $(this).data("limit");
  var remainingChars = limit - $(this).val().length;
  if (remainingChars <= 0) {
    $(this).val($(this).val().substring(0, limit));
  }
  var rest = remainingChars<=0?0:remainingChars;
  var asd = $(this).prev('label').children('span').text(rest);
});


function getTableData(table) {
  var data = [];
  
  // recorrer todas las filas de la tabla
  for (var i = 0; i < table.rows.length; i++) {
    var row = table.rows[i];
    var rowData = {};
    
    // recorrer todas las celdas de la fila
    for (var j = 0; j < row.cells.length; j++) {
      var cell = row.cells[j];
      // obtener el valor de la celda
      var value = cell.innerText;
      // agregar la clave y el valor al objeto rowData
      rowData['c_'+j] = value.trim();
    }
    
    // agregar el objeto rowData al array data
    data.push(rowData);
  }
  
  // devolver el array data en formato JSON
  return JSON.stringify(data);
}
