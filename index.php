<?php

  require_once( __DIR__.'/Cacher.php' );
  require_once( __DIR__.'/Html/HtmlParser.php' );

  // Index template for testing

  $ajax = Cacher::forge( 'http://www.youngs.co.uk/' )->get_cache();
  if( $ajax ) {

    $html_parser = new HtmlParser($ajax);

  }

?>
