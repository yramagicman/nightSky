<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"  />
<title>
  <?php wp_title();?>
</title>

<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("nav").getElementsByTagName("li");

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}

}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]>
</script>
<?php wp_head(); ?>
</head>
<!--banner text-->
<body <?php body_class( ); ?>>
<div id="container">
  <div id="header">
    <div id="head-text">
      <h1 id="blogTitle"><a href="<?php echo esc_attr(home_url()); ?>">
        <?php bloginfo('name'); ?>
        </a></h1>
      <!--blog name and link to home page-->
      <h1 id="tagLine">
        <?php bloginfo('description'); ?>
      </h1>
      
      <!--tagline-->
    </div>
  </div>
  <div id="nav">
 <?php nightsky_header_menu( ); ?>
</div>