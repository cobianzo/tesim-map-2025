<?php
/**
 * The template used for displaying call for proposals content in page-callsforproposals.php
 *
 * @package understrap
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<div class="card-header" role="tab" id="heading-<?php the_ID(); ?>">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapse-<?php the_ID(); ?>">
          <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>
        </a>
      </h5>
    </div>
    <div id="collapse-<?php the_ID(); ?>" class="collapse show" role="tabpanel" aria-labelledby="heading-<?php the_ID(); ?>">
      <div class="card-block">
        <?php the_content(); ?>
      </div>
    </div>
</article><!-- #post-## -->
