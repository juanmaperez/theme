/**
 * Reducir la altura de la barra superior cuando se comienza a hacer scroll
 * por la página.
 *
 * @since 1.0.0
 */
 $.fn.icThemeNavbar = function(){
   var navbar = $(this);
   function loaded(){
     if ( $(window).scrollTop() > 20 ) {
       navbar.addClass('contracted');
     } else {
       navbar.removeClass('contracted');
     }
   }
   $(window).scroll(loaded);
};
$(function(){
  $(".blog-navbar").icThemeNavbar();
});

/**
 * Fijar la posición del menú de categorías
 *
 * @since 1.1.0
 */
$.fn.icThemeCategoriesNavbar = function(){
  var categoriesNavegation = $(this);
  if ( categoriesNavegation.length ) {
    function loaded(){
      if ( $(window).width() > 768 ) {
        var hero = $('.hero');
        var heroHeight = hero.outerHeight();
        var blogNavegationHeight = $('.blog-navbar').outerHeight();
        var categoriesNavegationHeight = categoriesNavegation.outerHeight();
        if ( $(window).scrollTop() > ( heroHeight - blogNavegationHeight ) ) {
          categoriesNavegation.css({
            'position': 'fixed',
            'top': blogNavegationHeight + 'px',
            'box-shadow': '0px 2px 20px rgba(0,0,0,0.2)'
          });
          hero.css({
            'margin-bottom': categoriesNavegationHeight + 'px'
          });
        } else {
          categoriesNavegation.css({
            'position': 'inherit',
            'top': '0px',
            'box-shadow': 'none'
          });
          hero.css({
            'margin-bottom': '0px'
          });
        }
      } else {
        categoriesNavegation.css({
          'position': 'inherit',
          'top': '0px',
          'box-shadow': 'none'
        });
        hero.css({
          'margin-bottom': '0px'
        });
      }
    }
  }
  $(window).scroll(loaded).resize(loaded);
  $(document).load(loaded);
}
$(function(){
  $(".navbar-categories").icThemeCategoriesNavbar()
});
