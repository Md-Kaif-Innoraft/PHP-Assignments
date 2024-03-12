<?php

    require ('vendor/autoload.php');

    class FetchApi{
        public $url;

        function __construct($url) {
            $this -> url = $url;
        }

        /* Function to call api. */
        public function callApi() {
            $client = new GuzzleHttp\Client();
            $response = $client -> request ('GET', $this -> url);
            $data = json_decode( $response -> getBody(), true );
            return $data;
        }
    }
?>