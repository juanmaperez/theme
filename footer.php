    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <?php ic_theme_blog( 'logotype', array( 'location' => 'footer' ) ) ?>
          </div>
          <div class="col-sm-4">
            <span class="copyright pull-left"><?php ic_theme_blog( 'copyright' ) ?></span>
            
          </div>
          <div class="col-sm-4">
            <?php dynamic_sidebar('footer'); ?>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url') ?>/lib/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('template_url') ?>/lib/js/functions.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>
