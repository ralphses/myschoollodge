<?php

namespace src\controllers;

class SiteController extends Controller {

    public function __construct() {
        $this->setLayout('home');        
    }

    public function index() {
        return $this->render('index');
    }

    public function resetPass() {
        return $this->render('resetPassword');
    }

    public function anotherPassword() {
        return $this->render('newPassword');
    }

    public function about() {
        return $this->render('about');
    }

    public function properties() {
        return $this->render('properties');
    }

    public function agency() {
        return $this->render('agency');
    }

    public function contact() {
        return $this->render('contact');
    }

    public function addProperties() {
        return $this->render('add-property');
    }
    
    public function newAgent() {
        return $this->render('new-agent');
    }

    public function newAgency() {
        return $this->render('new-agency');
    }

    public function login() {
        return $this->render('login');
    }

    public function showPropertied() {
        return $this->render('properties-details');
    }
    

}