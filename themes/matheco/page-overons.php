<?php 
/*
Template Name: Overons 
*/
get_header();
$thisID = get_the_ID(); 
?>
<section class="breadcrumb-sec overons-breadcrumb-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-cntlr">
          <?php cbv_both_breadcrump(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php  
  $introleft = get_field('introleft', $thisID);
  $introright = get_field('introright', $thisID);
  if($introleft || $introright):
    
?>
<section class="ornare-txt-img-sec-wrp">
	<?php 
	if( !empty($introleft) ):
	$introLftimg = !empty($introleft['afbeelding'])? cbv_get_image_src( $introleft['afbeelding'] ): ''; 
	?>
  <div class="ornare-lft-bg inline-bg" style="background: url(<?php echo $introLftimg; ?>);"></div>
  <?php endif; ?>
  <?php if( $introright ): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ornare-txt-img-wrp">
          <div class="ornare-dsc">
            <?php 
              if( !empty($introright['titel']) ) printf( '<h1 class="ornare-dsc-title fl-h1">%s</h1>', $introright['titel'] );
              if( !empty($introright['beschrijving']) ) echo wpautop( $introright['beschrijving'] );
              $introRhtimg = !empty($introright['afbeelding'])? cbv_get_image_tag( $introright['afbeelding'] ): ''; 
            ?>
            <div class="ornare-fea-img">
              <?php echo $introRhtimg; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>
<?php  
  $showhide_team = get_field('showhide_team', $thisID);
  if($showhide_team): 
    $teamsec = get_field('teamsec', $thisID);
    if($teamsec):
    	$teams = $teamsec['teams'];
?>
<section class="team-member-sec-wrp">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="team-member-wrp">
          <div class="sec-entry-hdr">
            <?php 
              if( !empty($teamsec['titel']) ) printf( '<h2 class="our-services-title fl-h2">%s</h2>', $teamsec['titel'] );
              if( !empty($teamsec['beschrijving']) ) echo wpautop( $teamsec['beschrijving'] );
            ?>
           </div>
           <?php if( $teams ): ?>
          <div class="team-member-slider-cntlr">
            <div class="TeamMemberSlider clearfix">
              <?php 
              foreach( $teams  as $team ): 
              $team_src = !empty( $team['afbeelding'] )? cbv_get_image_src($team['afbeelding']):'';
              ?>
              <div class="team-member-grid-item">
                <div class="team-member-grid-img-cntlr">
                   <div class="team-member-grid-img inline-bg" style="background: url(<?php echo $team_src; ?>);"></div>
                 </div>
                <div class="team-member-grid-dsc">
				<?php 
					if( !empty($team['naam']) ) printf( '<h4 class="fl-h4">%s</h4>', $team['naam'] );
					if( !empty($team['positie']) ) printf( '<span>%s</span>', $team['positie'] );
				?>
                </div>
              </div>
          	  <?php endforeach; ?>
            </div>
          </div>
      	  <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php  
  $showhide_geschiedenis = get_field('showhide_geschiedenis', $thisID);
  if($showhide_geschiedenis): 
    $gescsec = get_field('gescsec', $thisID);
    if($gescsec):
    	$geschiedenis = $gescsec['geschiedenis'];
?>
<section class="ovs-counter-sec-wrp">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ovs-counter-wrp">
          <div class="sec-entry-hdr">
            <?php 
              if( !empty($gescsec['titel']) ) printf( '<h2 class="our-services-title fl-h2">%s</h2>', $gescsec['titel'] );
              if( !empty($gescsec['beschrijving']) ) echo wpautop( $gescsec['beschrijving'] );
            ?>
           </div>
           <?php if( $geschiedenis ): ?>
          <ul class="clearfix reset-list">
          	<?php foreach( $geschiedenis as $geschied ): ?>
            <li>
              <div class="ovs-counter-item-inr">
                <div class="ovs-counter-item">
	            <?php 
	              if( !empty($geschied['titel']) ) printf( '<div class="ovs-circle"><strong>%s</strong></div>', $geschied['titel'] );
	              if( !empty($geschied['beschrijving']) ) echo wpautop( $geschied['beschrijving'] );
	            ?>
                </div>
              </div>
            </li>
        	<?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>