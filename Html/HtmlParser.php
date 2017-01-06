<?php

  // Includes
  require_once( __DIR__.'/Link.php' );
  require_once( __DIR__.'/Image.php' );
  require_once( __DIR__.'/Header.php' );
  require_once( __DIR__.'/Paragraph.php' );
  require_once( __DIR__.'/Segmenter.php' );

  // Class: HtmlParser
  class HtmlParser {

    protected $input;
    protected $segments = [];
    protected $segment_count = 4;

    public function __construct ($input) {

      $this->input = $input;

      $lines = explode( PHP_EOL, $input );

      $current_idx = 0;
      $current_point = 0;
      $split_points = ceil( count($lines) / $this->segment_count );

      if( !empty($lines) ) {

        foreach($lines as $idx => $line) {

          if( $current_point <= $split_points ) {

            if( strlen($line) > 0 ) $this->segments[ $current_idx ][] = trim($line);

          } else {

            $current_idx++;
            $current_point = 0;

          }

          $current_point++;

        }

      }

    }

    /*
    * Function: get_links
    */
    public function get_links () {

      return [];

    }

    /*
    * Function: get_images
    */
    public function get_images () {

      return [];

    }

    /*
    * Function: get_headers
    */
    public function get_headers () {

      return [];

    }

    /*
    * Function: get_paragraphs
    */
    public function get_paragraphs () {

      return [];

    }

    /*
    * Function: get_segments
    */
    public function get_segments () {

      return $this->segments;

    }

  }

?>
