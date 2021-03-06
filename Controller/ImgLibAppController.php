<?php
App::uses("UrgComponent", "Urg.Controller/Component");
class ImgLibAppController extends AppController {
    var $components = array(
           "Auth" => array(
                   "loginAction" => array(
                           "plugin" => "urg",
                           "controller" => "users",
                           "action" => "login",
                           "admin" => false
                   )
           ), "Urg.Urg"
    );

    function beforeFilter() {
        parent::beforeFilter();
        
        if (!$this->Urg->has_access()) {
            $this->log("Redirecting to " . Debugger::exportVar($this->Auth->loginAction, 2), LOG_DEBUG);
            $this->redirect($this->Auth->loginAction);
        }
    }

    function log($msg, $type = LOG_ERROR) {
        $trace = debug_backtrace();
        parent::log("[" . $this->toString() . "::" . $trace[1]["function"] . "()] $msg", $type);
    }

}
