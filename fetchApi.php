<?php

    require ('vendor/autoload.php');

    class FetchApi {

        /**
         * @param string $url
         *   The API url.
         */
    /**
    *
    * @var string @url.
    *
    *  Stores the URL of Given Json API.
    *
    */
    /**
     *
     * @var string @url.
     *
     *  Stores the URL of Given Json API.
     *
     */
        public $url;

        /**
         * The constructor for FetchApi.
         *
         * @param
         */
        function __construct(string $url) {
            $this -> url = $url;
        }

        /* Function to call api. */
        public function callApi() {
            $client = new GuzzleHttp\Client();
            $response = $client->request('GET', $this->url);

            return json_decode( $response->getBody(), TRUE);
        }
    }
?>
