<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
global $base_url;
?>

<div class="page">
  <header class="page-main-header margin-bottom-45 clearfix" id="navbar" role="banner">
    <div class="<?php print $container_class; ?>">
      <div class="col-md-2 col-sm-2 col-xs-12 main-header-logo">
        <?php if ($logo): ?>
        <a class="logo" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> </a>
        <?php endif; ?>
        <?php if (!empty($site_name)): ?>
        <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
        <?php endif; ?>
        <?php if (!empty($page['navigation'])): ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"> <span class="sr-only"><?php print t('Toggle navigation'); ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <?php endif; ?>
      </div>
      <div class="col-md-10 col-sm-10 col-xs-12 main-header-menus">
        <?php if (!empty($page['navigation'])): ?>
        <div class="navbar-collapse collapse" id="navbar-collapse">
          <nav role="navigation">
            <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
            <?php endif; ?>
          </nav>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </header>
  <div class="main-container clearfix margin-bottom-45">
    <div class="test-repo-div" style="display: none;">Hello</div>
    <div class="<?php print $container_class; ?>">
      <div class="row">
        <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="col-sm-3" role="complementary"> <?php print render($page['sidebar_first']); ?> </aside>
        <?php endif; ?>
        <section<?php print $content_column_class; ?>>
          <?php if (!empty($page['highlighted'])): ?>
          <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>
          <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
          <a id="main-content"></a>
          <?php print render($title_prefix); ?>
					<?php if (!empty($title)): ?>
            <h1 class="page-header"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php print $messages; ?>
          <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
          <?php endif; ?>
          <?php if (!empty($page['help'])): ?>
          <?php print render($page['help']); ?>
          <?php endif; ?>
          <?php if (!empty($action_links)): ?>
          <ul class="action-links">
            <?php print render($action_links); ?>
          </ul>
          <?php endif; ?>
          <?php print render($page['content']); ?> </section>
        <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-sm-3" role="complementary"> <?php print render($page['sidebar_second']); ?> </aside>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php if (!empty($page['footer'])): ?>
  <footer class="footer <?php print $container_class; ?>"> <?php print render($page['footer']); ?> </footer>
  <?php endif; 
  if((!user_is_logged_in()) && (!empty(arg(1))) && (is_numeric(arg(1))) && (!empty($node = node_load(arg(1)))) && ($node->type == 'blog')){?>
    <a class="fancybox" href="#social-popup" style="display: none;">This shows content of element who has id="data"</a>
    <!-- popup for login starts -->
  	<div id="login-div" style="display: none;">      
	  	<div id="social-popup" class="clearfix text-center">
		  	<div class="margin-bottom-10">By continuing, I agree that I am at least 13 years old and have read and agree to the terms of service and privacy policy.</div>
		  	<div class="clearfix social-custom-button">
		  		<div class="display-inline-block">
		  	   <?php
		  			// call fb auth module
					 $fbBlock = module_invoke('fboauth', 'block_view', 'view');
					 print $fbBlock['content'];
            ?>
          </div>
          <div class="display-inline-block">
            <?php
					 // call google auth module
					 $googleBlock = module_invoke('social_login', 'block_view', 'goath-login');
					 print_r($googleBlock['content']);
					 ?>
          </div>
		  	</div>
		  	<div class="margin-bottom-10"><h4>-- OR --</h4></div>
		  	<div>
          <strong><a href="<?php echo $base_url.$base_path.'user/login'?>">Login</a> / <a href="<?php echo $base_url.$base_path.'user/register'?>">Signup </a>with your email</strong>
        </div>
	  	</div>
	  </div>
  <?php } ?>
</div>

<?php 
if((!user_is_logged_in()) && (!empty(arg(1))) && (is_numeric(arg(1))) && (!empty($node = node_load(arg(1)))) && ($node->type == 'blog')){?>
	<script type="text/javascript">
    jQuery(".fancybox").trigger('click');
	  jQuery(document).ready(function(){    	
      jQuery(".fancybox").fancybox({
        prevEffect    : 'none',
        nextEffect    : 'none',
        closeBtn    : false,
        closeClick  : false, // prevents closing when clicking INSIDE fancybox 
        openEffect  : 'none',
        closeEffect : 'none',
        width   : 900,
        height    : '100%',
        helpers   : { 
          overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
        },
        keys : {
          // prevents closing when press ESC button
          close  : null
        }
      });
    });
	</script>
<?php
}?>
