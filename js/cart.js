jQuery(document).ready(function () {
  $(".shopping-cart").hide();
  $("#cart-span").on("click", function () {
    $(".shopping-cart").fadeToggle("100", "linear");
  });

  $(document).on("click", function(event){
    if(!$(event.target).closest("#cart-span").length && !$(".shopping-cart").is(":hidden")){
      $(".shopping-cart").fadeToggle("100", "linear");
    }
});
})();
