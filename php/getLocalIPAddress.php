<?php
/**
 * Created by PhpStorm.
 * User: davidmusk
 * Date: 6/9/2017
 * Time: 8:48 PM
 */

$localIP = '{ "ip": "' . gethostbyname(gethostname()) . '" }';
// $localIP = getInternalIP();

/*$localIP = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
            getenv('HTTP_FORWARDED_FOR')?:
                getenv('HTTP_FORWARDED')?:
                    getenv('REMOTE_ADDR');*/

// var_dump($_SERVER);

echo "getLocalIP(" . $localIP . ");";

function getInternalIP() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {

                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}

