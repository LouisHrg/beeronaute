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

var slugifyme = document.getElementById('slugifyme');

slugifyme.onkeyup = function(){
    document.getElementById('slugifyme').value = slugify(slugifyme.value);
}

$('#datetimepicker1').datetimepicker({
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