<?php
class MyEmailLogRoute extends CEmailLogRoute {
    public function getSubject() {
        $request_uri = $_SERVER['REQUEST_URI'];
        return parent::getSubject() . ": " .
            ((strlen($request_uri) > 43) ? substr($request_uri,0,40) . '...' : $request_uri);
    }
}
