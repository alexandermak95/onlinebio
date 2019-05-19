jQuery(document).ready(function($) {
  $('.middle').click(function () {
    $(this).toggleClass('active');
  })
  $('.col-md-3 .card').click(function () {
    $(this).toggleClass('active');
  })
  $('#showbox').click(function () {
    $('.add-movies').toggleClass('active');
  })
  $('#showbox-2').click(function () {
    $('.all-movies').toggleClass('active');
  })
  $('.edit span').click(function () {
    $(this).next().toggleClass('active-edit');
  })
});
