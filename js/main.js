$(document).ready(function () {
  // Обработчик события изменения выбора упаковки
  $('input[name="uk_radio"]').change(function () {
    var packagingPrice = parseInt($(this).val());
    var quantity = parseInt($('.quantity').val());

    var basePrice = parseInt($('.price').attr('data-base-price'));

    var total = basePrice * quantity + packagingPrice;


    $('.price').text(total + ' руб.');
  });


  $('.quantity').change(function () {
    var packagingPrice = parseInt($('input[name="uk_radio"]:checked').val());
    var quantity = parseInt($(this).val());

    var basePrice = parseInt($('.price').attr('data-base-price')); 

    var total = basePrice * quantity + packagingPrice; 


    $('.price').text(total + ' руб.');
  });


  $('.plus').click(function () {
    var packagingPrice = parseInt($('input[name="uk_radio"]:checked').val());
    var quantity = parseInt($('.quantity').val()) + 1;

    var basePrice = parseInt($('.price').attr('data-base-price'));

    var total = basePrice * quantity + packagingPrice;


    $('.price').text(total + ' руб.');
    $('.quantity').val(quantity);
  });


  $('.minus').click(function () {
    var packagingPrice = parseInt($('input[name="uk_radio"]:checked').val());
    var quantity = parseInt($('.quantity').val()) - 1;

    if (quantity < 1) {
      quantity = 1;
    }

    var basePrice = parseInt($('.price').attr('data-base-price'));

    var total = basePrice * quantity + packagingPrice;

    $('.price').text(total + ' руб.');
    $('.quantity').val(quantity);
  });
});

