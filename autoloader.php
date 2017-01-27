<?php

  class Autoloader {

    public function autoload ($className) {

      // handle namespaces
      if( strpos($className, '\\') ) {

        $nSpaces = explode( '\\', $className );
        if( count($nSpaces) > 0 ) {

          array_shift($nSpaces);
          $gClass = join( '/', $nSpaces );
          
          require_once( __DIR__.'/'.$gClass.'.php' );

        }

      } else {

        // if not a namespace, load as standard class
        require_once( __DIR__.'/'.$className.'.php' );

      }

    }

    // register class
    public function register () {

      spl_autoload_register( [$this, 'autoload'], true );

    }

    // unregister class
    public function unregister () {

      spl_autoload_unregister( [$this, 'autoload'] );

    }

    // init this class
    public static function init () {

      return new static();

    }

  }

?>
