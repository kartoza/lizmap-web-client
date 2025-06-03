<?php

$GLOBALS['SAGTA_URL'] = getEnv('SAGTA_URL');

class memberCtrl extends jController
{
    public function index()
    {
        if (!jAuth::isConnected()) {
            jMessage::add('Member - User is not connected', 'error');
            $rep = $this->getResponse('json');
            $rep->data = array(
                "allowed" => false
            );
            return $rep;
        }

        // Safely get access token from session
        $accessToken = $_SESSION['at'] ?? null;

        if (!$accessToken) {
            jMessage::add('Access token not found in session', 'error');
            $rep = $this->getResponse('json');
            $rep->data = array(
                "allowed" => false
            );
            return $rep;
        }

        $url = "{$GLOBALS['SAGTA_URL']}/can-download-map/";
        $headers = array(
            "Authorization: Bearer {$accessToken}",
        );

        $result = sagta::CallAPI('GET', $url, false, $headers);
        $result_obj = json_decode($result);

        $rep = $this->getResponse('json');
        $rep->data = $result_obj;
        return $rep;
    }
}
