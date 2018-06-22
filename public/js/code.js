tinymce.init({
  selector: '#customcontent',
  height: 500,
  menubar: false,
  plugins: [
  'advlist autolink lists link image charmap print preview anchor textcolor',
  'searchreplace visualblocks code fullscreen',
  'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
});

function slugify(text)
{
  return text.toString().toLowerCase().trim()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/&/g, '-and-')         // Replace & with 'and'
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-');        // Replace multiple - with single -
  }

  if(slugifyme){
    var slugifyme = document.getElementById('slugifyme');

    slugifyme.onkeyup = function(){
      document.getElementById('slugifyme').value = slugify(slugifyme.value);
    }
  }

  $('#published').datetimepicker({
    icons: {
      time: 'icon icon-clock',
      date: 'icon icon-calendar',
      up: 'icon icon-arrow-up',
      down: 'icon icon-arrow-down',
      previous: 'icon icon-arrow-left2',
      next: 'icon icon-arrow-right2',
      today: 'icon icon-historyo',
      clear: 'icon icon-bin',
      close: 'icon icon-clock2'
    },
    format: "DD/MM/YYYY HH:mm"
  });

  $('#startat').datetimepicker({
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'top'
    },
    icons: {
      time: 'icon icon-clock',
      date: 'icon icon-calendar',
      up: 'icon icon-arrow-up',
      down: 'icon icon-arrow-down',
      previous: 'icon icon-arrow-left2',
      next: 'icon icon-arrow-right2',
      today: 'icon icon-historyo',
      clear: 'icon icon-bin',
      close: 'icon icon-clock2'
    },
    format: "DD/MM/YYYY HH:mm"
  });

  $('#endat').datetimepicker({
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'top'
    },
    icons: {
      time: 'icon icon-clock',
      date: 'icon icon-calendar',
      up: 'icon icon-arrow-up',
      down: 'icon icon-arrow-down',
      previous: 'icon icon-arrow-left2',
      next: 'icon icon-arrow-right2',
      today: 'icon icon-historyo',
      clear: 'icon icon-bin',
      close: 'icon icon-clock2'
    },
    format: "DD/MM/YYYY HH:mm"

  });


  $(function () {
    $("#startat").on("change.datetimepicker", function (e) {
      $('#published').datetimepicker('maxDate', e.date);
    });
    $("#startat").on("change.datetimepicker", function (e) {
      $('#endat').datetimepicker('minDate', e.date);
    });
  });



  $('#deleteBarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var actionelement = button.data('url')
    var nameelement = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Supprimer le bar ' + nameelement)
    modal.find('#form-delete').attr('action',actionelement)
  })

  $('#cancelEventModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var actionelement = button.data('url')
    var nameelement = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text("Annuler l'évenement " + nameelement)
    modal.find('#form-delete').attr('action',actionelement)
  })


  $('#deleteEventModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var actionelement = button.data('url')
    var nameelement = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text("Supprimer l'évenement"  + nameelement)
    modal.find('#form-delete').attr('action',actionelement)
  })

  $('#deletePublicationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var actionelement = button.data('url')
    var nameelement = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text("Supprimer la publication"  + nameelement)
    modal.find('#form-delete').attr('action',actionelement)
  })


  $('#deleteUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var actionelement = button.data('url')
    var nameelement = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text("Supprimer l'utilisateur"  + nameelement)
    modal.find('#form-delete').attr('action',actionelement)
  })



  $(document).ready(function() {
    $('#customselect').select2();
  });


