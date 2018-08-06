<div class="thank-you-form-right">
  <div class="row">
    <!-- Formulario -->
    <div class="col-sm-4">
      <?php if ( function_exists( 'ic_forms' ) ) : ?>
        <?php ic_forms() ?>
      <?php endif ?>
    </div>
    <!-- Contenidos -->
    <div class="col-sm-8">
      <h1><?php ic_thank_you('title') ?></h1>
      <div class="lead"><?php ic_thank_you('subtitle') ?></div>
      <div class="row">
        <!-- Imagen de ebook -->
        <?php if ( get_ic_thank_you('ebook') ) : ?>
          <div class="col-sm-4">
            <?php ic_thank_you('ebook') ?>
          </div>
        <?php endif ?>
        <!-- Contenido -->
        <?php if ( get_ic_thank_you('ebook') ) : ?>
          <div class="col-sm-8">
        <?php else : ?>
          <div class="col-sm-12">
        <?php endif ?>
          <!-- Enlace de descarga -->
          <?php ic_thank_you('content') ?>
          <!-- Texto -->
          <?php ic_thank_you('download') ?>
        </div>
      </div>
    </div>
  </div>
</div>
