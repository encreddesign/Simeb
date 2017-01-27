<?php

  require_once( __DIR__.'/autoloader.php' );
  Autoloader::init()->register();

  // Index template for testing

  $ajax = Simeb\Cacher::forge( 'http://www.youngs.co.uk/' )->get_cache();
  if( $ajax ) {

    try {

      $html_parser = new Simeb\Html\HtmlParser($ajax);

      $links = $html_parser->get_links();

      echo json_encode([

        'links' => ( !empty($links) ? $links : null )

      ]);

    } catch (Exception $ex) {

      echo json_encode([

        'code' => 400,
        'error' => $ex->getMessage()

      ]);

    }

  }

  @header('Content-Type: application/json');

?>
