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

    public function __construct ($input) {

      $this->input = $input;
      $this->segments = Segmenter::segment($this->input);

      if( empty($this->segments) ) {

        throw new Exception('Problem segmenting current site.');

      }

    }

    /*
    * Function: get_links
    */
    public function get_links ( $needed = null ) {

      $return = [];

      $linker = new Link( $this->segments );
      $linker_tags = $linker->get_tags();

      if( !empty($linker_tags) ) {

        if( !is_null($needed) ) {

          foreach($linker_tags as $block) {
            if( isset($block[$needed]) ) $return[] = $block;
          }

        } else {

          $return = $linker_tags;

        }

      }

      return $return;

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
