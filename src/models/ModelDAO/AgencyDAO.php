<?php 

namespace src\models\ModelDAO;

use src\models\Agency;
use src\utils\ImageHandler;

class AgencyDAO extends ModelDAO {

    public function __construct(Agency $agency) {

        $this->model = $agency;
        $this->imageHandler = new ImageHandler();
    }

    public function saveBasicAgency($agencyBasicDetails) {

        $sql = 'INSERT INTO `agency`(`agency_name`, `agency_phone`, `agency_email`, `password`, `location_id`, `rating_id`) 
                VALUES (:agency_name, :agency_phone, :agency_email, :password, :location_id, :rating_id);';
        
        $body = [
            'agency_name' => $this->model->name, 
            'agency_phone' => $this->model->phone,
            'agency_email' => $this->model->email,
            'password' => $this->model->agency_password
        ];

        $body = array_merge($agencyBasicDetails, $body);
        $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public function saveAgencyImages() {

        $sql = 'INSERT INTO `agency_image`(`agency_id`, `img`, `img_type`) 
                VALUES (:agency_id, :img, :img_type);';

        $body = [];

        $body['agency_id'] = self::getLastInsertedModel('agency', 'agency_id')[0]['agency_id'];

        $images = [];
        $images['Cover image'] = $this->imageHandler->getSingleImage('cover_image', 'agency') ?? false;
        $images['Feature image'] = $this->imageHandler->getSingleImage('feature_image', 'agency') ?? false;

        foreach($images as $key => $value) {
            if($value) {

                $body['img'] = $value;
                $body['img_type'] = $key;

                self::getConnection()->executeQuery($sql, $body)['count'];
            }
        }
    }

    public function saveAgencyOtherDetails() {
        
        $sql = 'INSERT INTO `agency_other_details`(`agency_id`, `agency_desc`, `agency_spec`) 
                VALUES (:agency_id, :agency_desc, :agency_spec);';

        $body = ['agency_desc' => $this->model->description, 'agency_spec' => $this->model->speciality];
        $body['agency_id'] = self::getLastInsertedModel('agency', 'agency_id')[0]['agency_id'];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public function saveCertificationDetails() {

        $sql = 'INSERT INTO `certification_details`(`agency_id`, `c_firm`, `c_no`) 
                VALUES (:agency_id, :c_firm, :c_no);';

        $body = ['c_firm' => $this->model->certification_firm, 'c_no' => $this->model->certificate_no];
        $body['agency_id'] = self::getLastInsertedModel('agency', 'agency_id')[0]['agency_id'];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

}

        // echo '<pre>'; var_dump($body); echo '</pre>'; exit;


