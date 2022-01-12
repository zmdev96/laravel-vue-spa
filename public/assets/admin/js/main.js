$(document).ready(function() {
  // Datatable Init
  $('#datatable').DataTable();

  // Remove the status message div after 5s
  setTimeout(function () {
    $('.status-message').fadeOut('slow');
  }, 5000);
});
