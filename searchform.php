<form method="get" role="form" action="<?php echo bloginfo('url') ?>">
  <div class="input-group">
    <input type="text" class="form-control" name="s" placeholder="<?php echo __( 'Type your search...', 'ic-theme' ) ?>" value="<?php echo $_GET['s'] ?>">
    <span class="input-group-btn">
      <button class="btn btn-active" type="submit"><i class="fa fa-search"></i></button>
    </span>
  </div>
</form>
