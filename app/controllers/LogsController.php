<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Phalcon\Mvc\Controller;

/* Im create a controler, this controller print all logs from the database */

class LogsController extends Controller {

    public function indexAction()
    {
        /* Im declare the variable of the array , this variable content all the logs from the db */
        $arrayLogs = array();

        /* This function use to query the table of Log, related with the model */
        $logs = Log::find();

        /* In this part im save all data in the $dataLogs array */
        foreach ($logs as $log) {
            $dataLogs = array('Id' => $log->id, 'Date' => $log->date, 'Service' => $log->service, 'Info' => $log->info);

            /* And then, save in the $dataLogs */
            array_push($arrayLogs, $dataLogs);
        }
        /* And now, im send to logs view */
        $this->view->setVar('arrayLogs', $arrayLogs);
    }

    public function showAction()
    {
        /* Im declare the variable of the array , this variable content all the logs from the db */
        $arrayLogs = array();

        /* This function use to query the table of Log, related with the model, if POST only the id from my form, use this */

        if (isset($_POST['searchLog']) || isset($_POST['dateLogStart']) || isset($_POST['dateLogFinal'])) {

            if (isset($_POST['ser_0']) && isset($_POST['cantServ'])) {
                if (isset($_POST['searchLog']) || isset($_POST['dateLogStart']) || isset($_POST['dateLogFinal'])) {

                    $countServices = $_POST['cantServ'];
                    for ($i = 0; $i <= $countServices; $i++) {


                        /* Catch start and final date input's */
                        $dateStart = new DateTime($_POST['dateLogStart']);
                        $dateFinal = new DateTime($_POST['dateLogFinal']);

                        /* Catch service and search input */
                        $serviceLogs = $_POST['ser_' . $i];
                        $searchLog = $_POST['searchLog'];

                        /* Create all conditions */
                        $conditions = 'service = :service: AND date BETWEEN :dateStart: AND :dateFinal: OR id = :id:';

                        /* Declare all parameters */
                        $paremetersLogs = [
                            'service' => $serviceLogs,
                            'dateStart' => $dateStart->format('Y-m-d'),
                            'dateFinal' => $dateFinal->format('Y-m-d'),
                            'id' => $searchLog
                        ];
                        /* Execute query for log table */
                        $logs = Log::find(array(
                                    $conditions,
                                    'bind' => $paremetersLogs
                        ));

                        /* In this part im save all data in the $dataLogs array */
                        foreach ($logs as $log) {

                            $dataLogs = array('Id' => $log->id, 'Date' => $log->date, 'Service' => $log->service, 'Info' => $log->info);
                            /* And then, save in the $arrayLogs */
                            array_push($arrayLogs, $dataLogs);
                        }

                        //echo 'Valor del campo  ser_' . $i . ':   ' . $_POST['ser_' . $i];
                    }
                    /* And now, im send to logs view */

                    $this->view->setVar('arrayLogs', $arrayLogs);
                }
            } else {

                /* Catch start and final date input's */
                $dateStart = new DateTime($_POST['dateLogStart']);
                $dateFinal = new DateTime($_POST['dateLogFinal']);

                /* Catch service and search input */
                $serviceLogs = $_POST['service'];
                $searchLog = $_POST['searchLog'];

                /* Create all conditions */
                $conditions = 'service = :service: AND date BETWEEN :dateStart: AND :dateFinal: OR id = :id:';

                /* Declare all parameters */
                $paremetersLogs = [
                    'service' => $serviceLogs,
                    'dateStart' => $dateStart->format('Y-m-d'),
                    'dateFinal' => $dateFinal->format('Y-m-d'),
                    'id' => $searchLog
                ];

                /* Execute query for log table */
                $logs = Log::find(array(
                            $conditions,
                            'bind' => $paremetersLogs
                ));

                /* In this part im save all data in the $dataLogs array */
                foreach ($logs as $log) {

                    $dataLogs = array('Id' => $log->id, 'Date' => $log->date, 'Service' => $log->service, 'Info' => $log->info);
                    /* And then, save in the $arrayLogs */
                    array_push($arrayLogs, $dataLogs);
                }
                /* And now, im send to logs view */

                $this->view->setVar('arrayLogs', $arrayLogs);
            }
        } else {
            header('Location: programmatic/logs/');
        }
    }

}
