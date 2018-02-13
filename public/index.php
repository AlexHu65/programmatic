<?php

/* This is the bootstrar and phalcon use this file to configure  the application */

/* 1. - I load all the classes necesaries for the project from the phalcon framework
 * 
 * This component helps to load your project classes automatically based on some conventions 
 * https://docs.phalconphp.com/es/latest/api/Phalcon_Loader.html 
 */

use Phalcon\Loader;

/* Phalcon\Mvc\View is a class for working with the “view” portion of the model-view-controller pattern. That is, it exists to help 
 * keep the view script separate from the model
 * and controller scripts. It provides a system of helpers, 
 * output filters, and variable escaping. https://docs.phalconphp.com/es/latest/api/Phalcon_Mvc_View.html
 */
use Phalcon\Mvc\View;

/* This component encapsulates all the complex operations behind instantiating every component needed
 * and integrating it with the rest to allow the MVC pattern to 
 * operate as desired. https://docs.phalconphp.com/es/latest/api/Phalcon_Mvc_Application.html
 */
use Phalcon\Mvc\Application;

/* This is a variant of the standard Phalcon\Di. By default it automatically registers all 
 * the services provided by the framework. Thanks to this, the developer does not need to register 
 * each service individually providing a full stack framework https://docs.phalconphp.com/es/latest/api/Phalcon_Di_FactoryDefault.html
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/* 2. - Add the exception, and next i'm create all functions/co0nfiguration of phalcon   
 * This exception verify if the Phalcon Application Exists on the server, if the exception its false then the bootstrap its ok 
 * 
 */

try {


    /* 3.- Now, I'm register autoloader using the dependency of phalcon: Phalcon\Loader 
     * I'm create the object $loader, using a method from the phalcon framework.
     *
     */

    $loader = new Loader();


    /* 4.- I'm use the method registerDirs from the classe Loader, this method declare
     * the directories from the MVC Pattern. Using an array to declare two directories.
     *      
     */

    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    /* 5.- In this step, im create the dependencies injector, using the class Phalcon\Di\FactoryDefault
     * This injector regiter all the services to use the application 
     * https://docs.phalconphp.com/es/latest/api/Phalcon_Di_FactoryDefault.html 
     */

    $di = new FactoryDefault();


    /* 6.- Start the service of the data base
     * Using $di i'm start the service and connect the data base to application
     * im use the statement 'set', one method from the classe \FactoryDefault
     * and next start the service    
     */

    $di->set('db', function () {
        return new DbAdapter
                /* Im using the alias (DbAdapter) name for the class */
                (array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname' => 'logs'
        ));
    });

    /* 7.- Next i'm create the view's directory usign the same object $di
     * And this is the same way, creating a set()
     * 
     * 
     */

    $di->set('view', function () {
        /* Create a new object using the Class View() */
        $view = new View();
        /* I'm declare the function setViewsDir from class, View */
        $view->setViewsDir('../app/views/');
        return $view;
    });


    /* 8.- Next step consist in creat the URI , directory or the BASE directory of the project, using
     * object $di and method set
     *      
     */

    $di->set('url', function () {

        $url = new UrlProvider();
        $url->setBaseUri('/programmatic/');
        return $url;
    });


    /* 9.- On the next, create the application
     * and send request, if the response is true
     * send the application     
     */

    $application = new Application($di);

    /* Response for the petition */

    $response = $application->handle();
    $response->send();
} catch (Exception $e) {
    /* 10.- If im have an error, send me a message */
    echo "Exception: ", $e->getMessage();
}

