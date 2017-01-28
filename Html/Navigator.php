<?php

  namespace Simeb\Html;

  // Class: Navigator
  class Navigator {

    protected $links;
    protected $core;

    public function get_nav () {

      if( !empty($this->links) ) {

        $lLinks = [];

        // first get local links attached to the site
        foreach($this->links as $link) {

          $link = (object)$link;
          $href = ( isset($link->attrs['href']) ? $link->attrs['href'] : null );

          if( $href ) {

            if( strpos($href, '://') ) {

              if( $this->core->get_domain($href) == $this->core->get_domain() ) $lLinks[] = $href;

            } elseif( substr($href, 0 , 1) == '/' ) {

              $lLinks[] = $href;

            }

          }

        }

      }

    }

    public function set_core ( \Simeb\SimebCore $core ) {

      $this->core = $core;

      return $this;

    }

    public function set_links ( $links ) {

      $this->links = $links;

      return $this;

    }

    public static function forge() {

      return new static();

    }

  }

?>
