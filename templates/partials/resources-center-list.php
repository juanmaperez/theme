<?php if ( $resources ) : ?>
  <?php if ( $resources -> have_posts() ) : ?>
    <section class="resources-center-listing">
      <?php while ( $resources -> have_posts() ) : $resources -> the_post();

        // Filtrado de tipo de contenido
        switch ( get_post_type() ) {

          // El contenido es un recurso
          case 'ic-resource':
            if ( function_exists( 'ic_resource' ) ) : $ic_resource_counter++; ?>
              <article class="resource-center-item type-resource">
                <div class="row">
                  <div class="col-sm-4">
                    <?php if ( get_ic_resource( 'ebook' ) ) { ?>
                      <a href="<?php ic_resource( 'link_url' ) ?>" title="<?php get_ic_resource( 'title' ) ?>">
                        <?php ic_resource( 'ebook' ); ?>
                      </a>
                    <?php } ?>
                  </div>
                  <div class="col-sm-8">
                    <h2>
                      <a href="<?php ic_resource( 'link_url' ) ?>" title="<?php get_ic_resource( 'title' ) ?>">
                        <?php ic_resource( 'title' ) ?>
                      </a>
                    </h2>
                    <p class="lead"><?php ic_resource( 'subtitle' ) ?></p>
                    <div class="resources-center-download">
                      <a href="<?php ic_resource( 'link_url' ) ?>" title="<?php get_ic_resource( 'title' ) ?>" class="btn btn-default">
                        <?php ic_resource( 'link_text' ) ?>
                      </a>
                    </div>
                  </div>
                </div>
              </article><?php
            endif;
          break;

          // El contenido es una landing
          case 'ic-landing':
            if ( function_exists( 'ic_landing' ) ) :
              if ( get_post_meta( get_the_ID(), '_ic_landing_pages_options_resources_center', true ) ) : $ic_resource_counter++; ?>
                <article class="resource-center-item type-landing">
                  <div class="row">
                    <div class="col-sm-4">
                      <a href="<?php echo get_the_permalink() ?>" title="<?php get_ic_landing( 'title' ) ?>">
                        <?php if ( get_ic_landing( 'ebook' ) ) { ?>
                          <?php ic_landing( 'ebook' ) ?>
                        <?php } ?>
                      </a>
                    </div>
                    <div class="col-sm-8">
                      <h2>
                        <a href="<?php echo get_the_permalink() ?>" title="<?php get_ic_landing( 'title' ) ?>">
                          <?php ic_landing( 'title' ) ?>
                        </a>
                      </h2>
                      <p class="lead"><?php ic_landing( 'subtitle' ) ?></p>
                      <div class="resources-center-download">
                        <a href="<?php echo get_the_permalink() ?>" title="<?php get_ic_landing( 'title' ) ?>" class="btn btn-default">
                          <?php echo __( 'Descargar', 'ic-theme' ) ?>
                        </a>
                      </div>
                    </div>
                  </div>
                </article><?php
              endif;
            endif;
          break;

        }

        endwhile; ?>

    </section>
  <?php endif; ?>
<?php endif; ?>
<?php if ( ! $ic_resource_counter ) : ?>
  <p class="lead"><?php echo __( 'Ups!, todavía no tenemos ningún recurso disponible.', 'ic-theme' ) ?></p>
<?php endif; ?>
