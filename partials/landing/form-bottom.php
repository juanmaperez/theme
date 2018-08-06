<div class="landing-form-bottom">
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-8">
          <h1><?php ic_landing( 'title' ) ?></h1>
          <div class="lead"><?php ic_landing( 'subtitle' ) ?></div>
          <?php ic_landing( 'content' ) ?>
        </div>
        <div class="col-sm-4">
          <?php if ( get_ic_thank_you('ebook') ) { ?>
            <?php ic_thank_you('ebook') ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <?php if ( function_exists( 'ic_forms' ) ) { ?>
        <?php ic_forms() ?>
      <?php } ?>
    </div>
    <?php if ( get_ic_landing( 'secondary_content' ) ) { ?>
      <div class="col-sm-12">
        <?php ic_landing( 'secondary_content' ) ?>
      </div>
    <?php } ?>
  </div>
</div>
