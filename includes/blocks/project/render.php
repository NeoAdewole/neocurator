<?php
// get_header();
if ((get_post_type() === 'project') && is_single()) {
?>
  <!-- Single Project Block [potfolio plugin template] -->

  <div id="content" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
          </header>
          <a href='<?php the_permalink(); ?>'>
            <div class="projectHead">
              <div class="projectThumb">
                <?php the_post_thumbnail(array(150, 150)); ?>
              </div>
              <div class="projectTitle">
                <h2>
                  <?php the_title(); ?>
                </h2>
              </div>
            </div>
          </a>
          <br />

          <!-- Display project details -->
          <div id="box" class="entry-content content-area">
            <?php the_content(); ?>
          </div>
        </article>
        <br />
        <div class="navigation">
          <span class="prev-link"><?php previous_post_link('<< %link') ?></span>
          <span class="next-link"><?php next_post_link(' %link >>') ?></span>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
    <div id="box"></div>
  </div>
<?php } ?>