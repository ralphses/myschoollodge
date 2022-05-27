<?php

require_once '../vendor/autoload.php';

use src\controllers\AgencyController;
use src\controllers\AgentController;
use src\controllers\CustomerController;
use src\controllers\PropertyController;
use src\controllers\SearchController;
use src\controllers\SiteController;
use src\utils\Application;
use src\utils\LoginLogout;

$application = new Application(dirname(__DIR__));

$application->getRouter()->get('/', [SiteController::class, 'index']);
$application->getRouter()->get('/index', [SiteController::class, 'index']);
$application->getRouter()->get('/about', [SiteController::class, 'about']);
$application->getRouter()->get('/properties', [SiteController::class, 'properties']);
$application->getRouter()->get('/agency', [SiteController::class, 'agency']);
$application->getRouter()->get('/new-agency', [SiteController::class, 'newAgency']);
$application->getRouter()->get('/contact', [SiteController::class, 'contact']);
$application->getRouter()->get('/add-properties', [SiteController::class, 'addProperties']);
$application->getRouter()->get('/new-agent', [SiteController::class, 'newAgent']);
$application->getRouter()->get('/login', [SiteController::class, 'login']);
$application->getRouter()->get('/reset-password', [SiteController::class, 'resetPass']);
$application->getRouter()->get('/new-password', [SiteController::class, 'anotherPassword']);
$application->getRouter()->get('/properties-details', [SiteController::class, 'showPropertied']);
$application->getRouter()->get('/search-lodge', [SearchController::class, 'searchAll']);

$application->getRouter()->post('/new-agent', [AgentController::class, 'newAgent']);

$application->getRouter()->post('/new-agency', [AgencyController::class, 'newAgency']);

$application->getRouter()->post('/add-property', [PropertyController::class, 'newLodge']);

$application->getRouter()->post('/new-customer', [CustomerController::class, 'newCustomer']);

$application->getRouter()->post('/login', [LoginLogout::class, 'logingNewUser']);
$application->getRouter()->post('/reset-password', [LoginLogout::class, 'resetingPass']);
$application->getRouter()->post('/logout', [LoginLogout::class, 'logingOUTUser']);
$application->getRouter()->post('/new-password', [LoginLogout::class, 'createPasswordNew']);


$application->router->resolve();
