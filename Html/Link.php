<?php

  // Class: Link
  class Link {

    protected $store = [];
    protected $indexer = 0;

    protected $regex = [

      'attrs' => '/\w*\=\"(.*?)\"/i',
      'link' => '/\<a\s+(.*?)\>(.*?)\<\/a\>/i'

    ];

    public function __construct ($input) {

      if( !empty($input) ) {

        foreach($input as $segment) {

          // Start each segment
          foreach($segment as $idx => $block) {

            preg_match_all( $this->regex['link'], $block, $find );

            // Select anchor value and attrs
            if( isset($find[2][0]) ) $this->store[$this->indexer]['value'] = $find[2][0];
            if( isset($find[1][0]) ) {

              $this->store[$this->indexer]['attrs'] = $find[1][0];
              $this->indexer++;

            }

          }

        }

      }

    }

    // Return tag with values
    public function get_tags () {

      $return = [];

      if( !empty($this->store) ) {

        foreach($this->store as $i => $item) {

          preg_match_all( $this->regex['attrs'], $item['attrs'], $find );

          // Select list of attrs
          if( isset($find[1]) && !empty($find[1]) ) {

            foreach($find[1] as $j => $value) {

              // Extract attr
              $attr = explode('=', $find[0][$j])[0];
              if( !empty($value) ) {

                $return[$i]['value'] = $item['value'];
                $return[$i]['attrs'][ $attr ] = $value;

              }

            }

          }

        }

      }

      return $return;

    }

  }

?>
