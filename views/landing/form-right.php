<div class="row">
  <div class="col-sm-9">
    <?php ic_landing( 'content' ) ?>
  </div>
  <div class="col-sm-3">
    <?php if ( function_exists( 'ic_forms' ) ) { ?>
      <?php ic_forms() ?>
    <?php } ?>
  </div>
</div>
