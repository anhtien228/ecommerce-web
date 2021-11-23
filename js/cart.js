// jQuery(document).ready(function () {
//   $(".shopping-cart").hide();
//   $("#cart-span").on("click", function () {
//     $(".shopping-cart").fadeToggle("100", "linear");
//   });

//   $(document).on("click", function(event){
//     if(!$(event.target).closest("#cart-span").length && !$(".shopping-cart").is(":hidden")){
//       $(".shopping-cart").fadeToggle("100", "linear");
//     }
// });
// })();

// $(document).ready(function() {
//   $(document).on("click", "#addtoCart", function(e) {
//     e.preventDefault();
//     var form = $(this).closest(".submit-cart");
//     var sku = form.find(".psku").val();

//     $.ajax({
//       url: "add_cart.php",
//       method: "post",
//       data: {psku: sku},
//       success:function(response) {
//         $(".alert-message").html(response);
//         window.scrollTo(0,0);
//         load_cart_item_number();
//       }
//     });
//   });
// });