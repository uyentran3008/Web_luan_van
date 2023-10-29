(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    

    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        margin: 30,
        dots: true,
        loop: true,
        center: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);


    //   $(function() {
    //     const TIME_TO_UPDATE = 1000;

    //     $(document).on('click', '.btn-update-quantity', _.debounce(function(e) {
    //         let url = $(this).data('action')
    //         let id = $(this).data('id')
    //         let data = {
    //             _token: '{{ csrf_token() }}',
    //             product_quantity: $(`#productQuantityInput-${id}`).val()
    //         }
    //         $.post(url, data, res => {
    //             let cartProductId = res.product_cart_id;
    //             let cart = res.cart;
    //             $('#productCountCart').text(cart.product_count)
    //             if (res.remove_product) {
    //                 $(`#row-${cartProductId}`).remove();
    //             } else {
    //                 $(`#cartProductPrice${cartProductId}`).html(
    //                     `$${res.cart_product_price}`);
    //             }
    //             cartProductPrice
    //             $('.total-price').text(`$${cart.total_price}`)
    //             Swal.fire({
    //                 position: "top-end",
    //                 icon: "success",
    //                 title: "success",
    //                 showConfirmButton: false,
    //                 timer: 1500,
    //             });

    //         })
    //     }, TIME_TO_UPDATE))

    //       $(document).on('click', '.btn-remove-product', function(e) {
    //           let url = $(this).data('action')
    //           confirmDelete()
    //               .then(function() {
    //                   $.post(url, res => {
    //                       let cart = res.cart;
    //                       let cartProductId = res.product_cart_id;
    //                       $('#productCountCart').text(cart.product_count)
    //                       $('.total-price').text(`$${cart.total_price}`).data('price', cart
    //                           .product_count)
    //                       $(`#row-${cartProductId}`).remove();
    //                   })
    //               })
    //               .catch(function() {

    //               })
    //       })




         

    //   });