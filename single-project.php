<?php
/*
Single Project Template: Template to Display Single Portfolio Projects
Description: This part is optional, but helpful for describing the Post Template

*/
 

get_header(); ?>
<!-- Single Portfolio Project [potfolio plugin template] -->

  <div id="content" role="main">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
        <div class="navigation">
          <span class="prev-link"><?php previous_post_link('<< %link') ?></span>
          <span class="next-link"><?php next_post_link(' %link >>') ?></span>           
        </div>
        <br />
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">                       
          </header>
          <a href = '<?php the_permalink(); ?>'>
          	<div class="projectHead">								
    					<div class="projectThumb">
    						<?php the_post_thumbnail( array(150, 150) ); ?>
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
 
      <?php endwhile; ?>      
    <?php endif; ?>
  </div>
<div id="box">
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>