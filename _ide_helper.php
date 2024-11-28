<?php
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnused */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

/**
 * @property CI_Benchmark        $benchmark
 * @property CI_Config           $config
 * @property CI_Controller       $controller
 * @property CI_DB_forge         $dbforge
 * @property CI_DB_query_builder $db
 * @property CI_Email            $email
 * @property CI_Encryption       $encryption
 * @property CI_Form_validation  $form_validation
 * @property CI_Ftp              $ftp
 * @property CI_Input            $input
 * @property CI_Lang             $lang
 * @property CI_Loader           $load
 * @property CI_Log              $log
 * @property CI_Model            $model
 * @property CI_Output           $output
 * @property CI_Pagination       $pagination
 * @property CI_Parser           $parser
 * @property CI_Security         $security
 * @property CI_Session          $session
 * @property CI_Table            $table
 * @property CI_Trackback        $trackback
 * @property CI_Typography       $typography
 * @property CI_Unit_test        $unit_test
 * @property CI_Upload           $upload
 * @property CI_URI              $uri
 * @property CI_User_agent       $agent
 * @property CI_Xmlrpc           $xmlrpc
 * @property CI_Xmlrpcs          $xmlrpcs
 * @property CI_Zip              $zip
 * @property Template            $template
 * @property UsersModel          $UsersModel
 *
 * // Add custom libraries or models here as needed
 */
class CI_Controller {}

class CI_Model {}

class Template {
    public function render($view, $data = []) {}
    public function set($key, $value) {}
    // Adicione outros métodos do seu Template aqui
}