<?php

  namespace Simeb;

  // Class: Cacher
  class Cacher {

    protected static $url;
    protected static $ajaxed;
    protected static $cache_time;
    protected static $cache_folder;
    protected static $cache_file;

    public static function forge ($url) {

      self::$url = $url;
      self::$cache_time = 3600;
      self::$cache_folder = ( __DIR__.'/cache/' );

      self::$ajaxed = file_get_contents( $url );

      return new static();

    }

    // Get cache response
    public static function get_cache () {

      $data = null;
      self::$cache_file = ( self::$cache_folder.'ajax.cache' );

      try {

        if( !is_dir(self::$cache_folder) ) throw new Exception ('Missing cache folder');
        if( is_null(self::$ajaxed) ) throw new Exception ('Ajax response is null..exiting');

        if( !file_exists(self::$cache_file) ) {

          $put = file_put_contents( self::$cache_file, self::$ajaxed, LOCK_EX );
          if( $put ) {

            $data = file_get_contents( self::$cache_file );

          } else { throw new Exception ('Unable to save cached response'); }

        } else {

          $data = self::do_get_cache();

        }

      } catch (Exception $ex) { die( 'Cache Error: '.$ex->getMessage() ); }

      return $data;

    }

    // Check time on cache file, if expired
    protected static function do_get_cache () {

      $cached_file = file_get_contents( self::$cache_file );
      $file_time = ( filemtime( self::$cache_file ) + self::$cache_time );

      if( strtotime(time()) < $file_time ) {

        return $cached_file;

      } else {

        return file_get_contents( self::$url );

      }

    }

  }

?>
