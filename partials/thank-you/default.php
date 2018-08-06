<div class="thank-you-form-default">
  <div class="row">
    <!-- Contenidos -->
    <div class="col-sm-8">
      <h1><?php ic_thank_you('title') ?></h1>
      <div class="lead"><?php ic_thank_you('subtitle') ?></div>
      <!-- Enlace de descarga -->
      <?php ic_thank_you('download') ?>
      <!-- Texto -->
      <?php ic_thank_you('content') ?>
    </div>
    <!-- Imagen de ebook -->
    <div class="col-sm-4">
      <?php if ( get_ic_thank_you('ebook') ) : ?>
        <?php ic_thank_you('ebook') ?>
      <?php endif ?>
    </div>
  </div>
</div>
