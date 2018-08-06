<div class="landing-form-right">
  <div class="row">
    <div class="col-sm-8">
      <h1><?php ic_landing( 'title' ) ?></h1>
      <div class="lead"><?php ic_landing( 'subtitle' ) ?></div>
      <div class="row">
        <div class="col-sm-4">
          <?php if ( get_ic_landing('ebook') ) { ?>
            <?php ic_landing('ebook') ?>
          <?php } ?>
        </div>
        <div class="col-sm-8">
          <?php ic_landing( 'content' ) ?>
        </div>
      </div>
      <?php if ( get_ic_landing( 'secondary_content' ) ) { ?>
        <div class="row">
          <div class="col-sm-12">
            <?php ic_landing( 'secondary_content' ) ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="col-sm-4">
      <?php if ( function_exists( 'ic_forms' ) ) { ?>
        <?php ic_forms() ?>
      <?php } ?>
    </div>
  </div>
</div>
