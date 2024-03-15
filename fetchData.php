<?php
    // Including fetchApi file.
    require 'fetchApi.php';

    /**
     * Class to Fetch data from Api.
     */
    class Field {

        private $title;
        private $image;
        private $icon;
        private $service;
        private $alias;

        /* Constructor for initializing instance variables. */
        function __construct($title, $image, $icon, $service, $alias) {
            $this -> title = $title;
            $this -> image = $image;
            $this -> icon = $icon;
            $this -> service = $service;
            $this -> alias = $alias;
        }

        /* Function to get tittle. */
        public function getTitle() {
            return $this -> title;
        }

        /* Function to get image. */
        public function getImage() {
            return $this -> image;
        }

        /* Function to get icon. */
        public function getIcon() {
            return $this -> icon;
        }

        /* Function to get setvice. */
        public function getService() {
            return $this -> service;
        }

        /* Function to get alias. */
        public function getAlias() {
            return $this -> alias;
        }

    }

    /** Function to get data from Api. */
    function getData() {

        $dataObjArr = array();

        //Calling Api to get JSON Data in Array format.
        $dataArr = (new FetchApi('https://www.innoraft.com/jsonapi/node/services')) -> callApi();

        foreach ( $dataArr['data'] as $data) {
           if($data['attributes']['field_secondary_title'] != NULL) {
            $url = 'https://www.innoraft.com';
            $iconArr = [];

            //Getting tittle and Storing tittle.
            $title = $data['attributes']['field_secondary_title']['value'];

            //Getting image url and storing it.
            $image = $url.(new FetchApi($data['relationships']['field_image']['links']['related']['href'])) -> callApi()['data']['attributes']['uri']['url'];

            //Getting services data and storing .
            $service = $data['attributes']['field_services']['value'];

            //Getting alias data and storing it.
            $alias = $url.$data['attributes']['path']['alias'];

            //Calling api to get data for icons.
            $iconsCall1 = (new FetchApi($data['relationships']['field_service_icon']['links']['related']['href'])) -> callApi();

            foreach ($iconsCall1['data'] as $icons) {
                $iconsCall2 = (new FetchApi($icons['relationships']['field_media_image']['links']['related']['href'])) -> callApi();
                $icon = $url.$iconsCall2['data']['attributes']['uri']['url'];
                $iconArr[] = $icon;
            }
            $object = new Field ($title, $image, $iconArr, $service, $alias );
            //Storing object in Array.
            $dataObjArr[] = $object;
           }
        }
        return $dataObjArr;
    }
?>
