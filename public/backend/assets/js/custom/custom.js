// slideUp
$(document).ready(function () {
  $(".alert").fadeTo(2500, 500).slideUp(500, function () {
    $(".alert").slideUp(500);
  });
});
