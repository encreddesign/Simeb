<?php

  // Class: Segmenter
  class Segmenter {

    protected static $segments = [];
    protected static $segment_count = 4;

    public static function segment ( $input ) {

      $lines = explode( PHP_EOL, $input );

      $current_idx = 0;
      $current_point = 0;
      $split_points = ceil( count($lines) / self::$segment_count );

      if( !empty($lines) ) {

        foreach($lines as $idx => $line) {

          if( $current_point <= $split_points ) {

            if( strlen($line) > 0 ) self::$segments[ $current_idx ][] = trim($line);

          } else {

            $current_idx++;
            $current_point = 0;

          }

          $current_point++;

        }

      }

      return self::$segments;

    }

  }

?>
