<?php

  require_once( __DIR__.'/autoloader.php' );
  Autoloader::init()->register();

  $simeb = new Simeb\SimebCore( 'http://www.youngs.co.uk/' );

  @header('Content-Type: application/json');

  // Index template for testing

  $ajax = Simeb\Cacher::forge( $simeb->get_url() )->get_cache();
  if( $ajax ) {

    try {

      $html_parser = new Simeb\Html\HtmlParser($ajax);

      $links = $html_parser->get_links();

      // echo json_encode([
      //
      //   'links' => ( !empty($links) ? $links : null )
      //
      // ]);
      Simeb\Html\Navigator::forge()->set_core($simeb)->set_links($links)->get_nav();

    } catch (Exception $ex) {

      echo json_encode([

        'code' => 400,
        'error' => $ex->getMessage()

      ]);

    }

  }

?>
