<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */
?>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59ba734e3ece4e001182cd5a&product=inline-share-buttons"></script>
<?php
$carouselPath = libraries_get_path('owl-carousel');
?>
<script type="text/javascript" src="/sites/all/libraries/owl-carousel/owl.carousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="/sites/all/libraries/owl-carousel/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/sites/all/libraries/owl-carousel/owl.theme.css">
<link rel="stylesheet" type="text/css" href="/sites/all/libraries/owl-carousel/owl.transitions.css">
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && !empty($title)): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
    <span class="submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </span>
    <?php endif; ?>
  </header>
  <?php endif; ?>
  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    //print render($content);
    /*echo '<pre>';
    print_r($node);die;*/
    if(isset($node->field_blog_image['und'])){
      $images = $node->field_blog_image['und'];
      if(!empty($images)){?>        
        <div id="owl-demo" class="owl-carousel owl-theme margin-bottom-10">
          <?php
          foreach ($images as $key => $value) {
            $img = image_style_url('image_848_440', $value['uri']);?>              
            <div class="item">
              <img src="<?php echo $img;?>">
            </div>
            <?php
          }
          if(isset($node->field_blog_video['und'])){
            $videos = $node->field_blog_video['und'];
            foreach ($videos as $vkey => $vvalue) {
              $vurl = $vvalue['video_url'];
              if(strpos($vurl, "youtube.com") == TRUE){
                $v1url = explode("https://www.youtube.com/", $vurl);
                if(strpos($v1url[1], "?v") == TRUE){
                  $v2url = explode("watch?v=", $v1url[1]);
                  $vsite = "https://www.youtube.com/";
                  $vcode = $v2url[1];
                  $vurl = $vsite.'embed/'.$vcode."?autoplay=1";
                }                
              }
              else{
                $vurl = "https://www.youtube.com/embed/".$vurl."?autoplay=1";
              }
              // video thumbnail
              $img = image_style_url('image_848_440', $vvalue['thumbnail_path']);
              ?>
              <div class="item-video">
                <div class="item">
                  <img src="<?php echo $img;?>" onclick="showvideo('<?php echo $vurl;?>')">
                </div>
                <!-- <iframe src="<?php echo $vurl;?>" width="848" height="440" frameborder="0" allowfullscreen="" id="existing-iframe-example"></iframe> -->
              </div>
              <?php
            }
          }?>
        </div><?php
      }
    }
    else if(isset($node->field_blog_video['und'])){
      $videos = $node->field_blog_video['und'];
      if(!empty($videos)){?>
        <div id="owl-demo" class="owl-carousel owl-theme margin-bottom-10">
          <?php
          foreach ($videos as $vkey => $vvalue) {
            $vurl = $vvalue['video_url'];
            if(strpos($vurl, "youtube.com") == TRUE){
              $v1url = explode("https://www.youtube.com/", $vurl);
              if(strpos($v1url[1], "?v") == TRUE){
                $v2url = explode("watch?v=", $v1url[1]);
                $vsite = "https://www.youtube.com/";
                $vcode = $v2url[1];
                $vurl = $vsite.'embed/'.$vcode;
              }                
            }
            else{
              $vurl = "https://www.youtube.com/embed/".$vurl."?autoplay=1";
            }
            ?>
              <div class="item">
                <iframe src="<?php echo $vurl;?>" width="848" height="440" frameborder="0" allowfullscreen="" id="video_play"></iframe>
              </div>
            <?php
          }?>
        </div><?php
      }
    }
    if(isset($node->body['und'])){
      echo '<div class="margin-bottom-10">'.$node->body['und'][0]['value'].'</div>';
    }
    $likeBlock = module_invoke('social_login', 'block_view', 'like-dislike');
    //print_r($likeBlock['content']);
    echo '<div class="margin-bottom-10">'.$content['likebtn_display']['#markup'].'</div>';
  ?>
  <a class="fancybox" href="#video-popup" style="display: none;">Inline</a>
  <div id="video-popup" class="clearfix text-center">
    <iframe src="" width="100%" height="440" frameborder="0" allowfullscreen="" id="iframe-example"></iframe>
  </div>
  <div class="sharethis-inline-share-buttons margin-bottom-10"></div>
  <?php
    // Only display the wrapper div if there are tags or links.
    $field_tags = render($content['field_tags']);
    $links = render($content['links']);
    if ($field_tags || $links):
  ?>
   <footer>
     <?php print $field_tags; ?>
     <?php print $links; ?>
  </footer>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
</article>
<script type="text/javascript">
  jQuery('#owl-demo').owlCarousel({
    navigation : true, // Show next and prev buttons
    slideSpeed : 300,
    paginationSpeed : 400,
    singleItem:true,
    loop: true,
    autoPlay: true,
    slideSpeed:200,
    stopOnHover:true,
    responsive: true,
    responsiveRefreshRate : 200,
    responsiveBaseWidth: window,
    video:true,
    pagination:true,
    onTranslate: function() {
      jQuery('.owl-item').find('video').each(function() {
        this.pause();
      });
    }
  });

  function showvideo(url){
    jQuery("#iframe-example").attr("src", url);
    jQuery(".fancybox").trigger('click');
  }
  jQuery(".fancybox").fancybox({
    //closeBtn:false,
    closeClick  : false, // prevents closing when clicking INSIDE fancybox 
    openEffect  : 'none',
    closeEffect : 'none',
    width   : 900,
    height    : '100%',
    helpers   : { 
      overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
    }
  });
</script>