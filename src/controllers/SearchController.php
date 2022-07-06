<?php

namespace src\controllers;

use src\utils\Request;
use src\utils\Response;
use src\models\Model;
use src\models\ModelDAO\PropertyDAO;
use src\utils\Location;

class SearchController extends Controller {

    public function __construct() {
        $this->response = new Response();
    }

    public function prepareModel($modelID): array {return [];}
    public function cleanModel(Model $model): array {return [];}

    public function searchAll(Request $request) {

        $location = $request->getFormInputs()['location'] ?? false;
        $category = $request->getFormInputs()['category']?? false;
        $description = $request->getFormInputs()['description']?? false;
        $price_range = $request->getFormInputs()['price_range']?? false;
        $basic = $request->getFormInputs()['basic']?? '';
        $entertain = $request->getFormInputs()['entertain']?? '';
        $garage = $request->getFormInputs()['garage']?? '';

        //Search locations
        $locations = $this->searchLocation($location, $request);
        $propertiesInLocations = PropertyDAO::searchPropertyByLocations($locations);

           
        //Search descriptions
        $descriptions = $this->searchDescription($description, $request);
        $propertiesByDescription = PropertyDAO::getPropertiesByDescription($this->prepareThings($descriptions, "id"));


        $propertiesByPriceRange = [];
        if($price_range) {

            $price_range_high = $this->preparePrice($price_range)[1];      
            $price_range_low = $this->preparePrice($price_range)[0];  

            $propertiesByPriceRange = PropertyDAO::getPropertiesByPriceRange($price_range_high, $price_range_low);
        }

        //Search by category
        $propertiesByCategory = PropertyDAO::getPropertiesByType($category);

        //Search facilities
        $facilities = $this->searchFacilities($basic, $entertain, $garage, $request);
        $propertiesByFacilities = PropertyDAO::getPropertiesByDescription($this->prepareThings($facilities, "id"));

        //find latest added properties
        $latestProperties = PropertyDAO::getLatestAddedProperties();

        for($i = 0; $i < count($latestProperties); $i++) {
            $imageURL = PropertyDAO::getPropertyFeaturedImage($latestProperties[$i]['id'])[0]['imageURL'] ?? false;
           
            $latestProperties[$i]['location_id'] = Location::getFullLocation($latestProperties[$i]['location_id']);
            $latestProperties[$i]['featured_image'] = ($imageURL) ? $imageURL : "";
        }

         //Find featured properties
         $featuredProperties = PropertyDAO::getFeaturedProperties();

         for($i = 0; $i < count($featuredProperties); $i++) {
            $imageURL = PropertyDAO::getPropertyFeaturedImage($featuredProperties[$i]['id'])[0]['imageURL'] ?? false;
            $featuredProperties[$i]['location_id'] = Location::getFullLocation($featuredProperties[$i]['location_id']);
            $featuredProperties[$i]['featured_image'] = ($imageURL) ? $imageURL : "";
        }
        
        //merge all search results
        $searchProperties = array_merge($propertiesInLocations, $propertiesByDescription, $propertiesByPriceRange, $propertiesByCategory, $propertiesByFacilities);

        for($i = 0; $i < count($searchProperties); $i++) {
            $imageURL = PropertyDAO::getPropertyFeaturedImage($searchProperties[$i]['id'])[0]['imageURL'] ?? false;
            $searchProperties[$i]['location_id'] = Location::getFullLocation($searchProperties[$i]['location_id']);
            $searchProperties[$i]['featured_image'] = ($imageURL) ? $imageURL : "";
        }
        $this->response->addResponse('result', $searchProperties);
        $this->response->addResponse('latest', $latestProperties);
        $this->response->addResponse('featured', $featuredProperties);

        return $this->render('searchResults', ['response' =>  $this->response->getResponseContent()]);

    }


    private function searchDescription($description) {
        return  ($description) ? PropertyDAO::getDescriptionByKeyword($description) : [];
    }

    private function searchFacilities($basic, $entertain, $garage) {

        return PropertyDAO::getFacilitiesByKeyword($basic, $entertain, $garage);
    }


    private function searchLocation($location) {
        return  ($location) ? $this->prepareThings(array_values(Location::getLocationByKeyword($location)), 'location_id') : '';
    }

    private function prepareThings($array, $index) {
        $allid = '';
        foreach($array as $key => $value) {
            $allid .= $value[$index].",";
        }
        $allid = substr($allid, 0, strlen($allid) - 1);

        return $allid;

    }

    private function preparePrice($price_range) {
        $pos = strpos($price_range, "-") ?? false;
        if($pos) {
            $low = substr($price_range, 0, $pos);
            $high = substr($price_range, $pos+1, strlen($price_range) -1);
            return[$low, $high];
        }
        return [0, 10000000];
    }
    
}

// echo '<pre>'; var_dump($allid); echo '</pre>'; exit;
