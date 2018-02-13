/* if ( || $_POST['dateLog']) {

          $serviceLog = $_POST['serviceLog'];
          $dateLog = new DateTime($_POST['dateLog']);

          /* Using the function query from the class Phalcon\Db , i'm set a query */

        /* $resultLog = $this->db->query('SELECT id, DATE_FORMAT(`date`, "%Y-%m-%d") as date, service, info FROM log WHERE DATE_FORMAT(`date`, "%Y-%m-%d") LIKE "%' . $dateLog->format('%Y-%m-%d') . '%" OR service = "' . $serviceLog . '"');
          while ($rowLog = $resultLog->fetchArray()) {
          /* And now i'm save all data in an array */
        /*  $dataLogs = array('Id' => $rowLog['id'], 'Date' => $rowLog['date'], 'Service' => $rowLog['service'], 'Info' => $rowLog['info']);
          /* And then, save in the $arrayLogs */
        /*   array_push($arrayLogs, $dataLogs);
          }

          $this->view->setVar('arrayLogs', $arrayLogs);
          } */