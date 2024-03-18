<?php

  require ('vendor/autoload.php');

  /**
   * Class to Fetch Api using guzzleHttp.
   */
  class FetchApi {
    /**
     * @var string @url.
     *  Stores the URL of Given Json API.
     */
    public $url;
    /**
     * The constructor for FetchApi.
     * @param string @url.
     */
    function __construct(string $url) {
      $this->url = $url;
    }
    /**
     * Function to call api and get data.
     */
    public function callApi() {
      $client = new GuzzleHttp\Client();
      $response = $client->request('GET', $this->url);
      return json_decode($response->getBody(), TRUE);
    }
  }
?>
