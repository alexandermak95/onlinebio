jQuery(document).ready(function($) {
  $('.middle').click(function () {
    $(this).toggleClass('active');
  })
  $('.col-md-3 .card').click(function () {
    $(this).toggleClass('active');
  })
  // $('#add').click(function() {
  //   $('.order-klar').scrollIntoView()
  //   $('#order-add').css('display','none');
  //   $('.order-klar').css('display','block');
  // })
  // $('#order').click(function() {
  //   $('#order-add').css('display','block');
  //   $('.order-klar').css('display','none');
  // })
});
