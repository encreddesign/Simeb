<?php

  namespace Simeb;

  class SimebCore {

    protected $server_url;
    protected $dRegex = '/[\w+]\:\/\/(.*?)\//i';

    public function __construct ( $url ) {

      $this->server_url = $url;

    }

    public function get_url () {

      return $this->server_url;

    }

    public function get_domain ( $url = null ) {

      $url = ( $url ? $url : $this->server_url );

      preg_match( $this->dRegex, $url, $find );
      if( isset($find[1]) ) {

        return $find[1];

      }

    }

  }

?>
