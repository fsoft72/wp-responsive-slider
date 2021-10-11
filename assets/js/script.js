(function ($) {
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/wp-responsive-slider.default",
      function (scope) {
        scope.find(".wp-responsive-slider").each(function () {
          var element = $(this)[0];
          $container = $(this).find(".swiper-container");
          if (element) {
            $settings = $(this).data("settings");
            new Swiper($container, $settings);
          }
        });
      }
    );
  });
})(jQuery);
