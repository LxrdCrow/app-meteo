<?php
//function to send json response
function jsonResponse($data, $status = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

//function for validate input (username, password ecc.)
function validateInput($input, $type = 'string', $minLenght = 1, $maxLenght = 255) {
    if (!isset($input) || trim($input) === '') {
        return false;
    }

    switch ($type) {
        case 'string':
            return strlen($input) >= $minLength && strlen($input) <= $maxLength;
        case 'int':
            return filter_var($input, FILTER_VALIDATE_INT) !== false;
        case 'float':
            return filter_var($input, FILTER_VALIDATE_FLOAT) !== false;
        case 'email':
            return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
        default:
            return false;
    }

    //function for convert temperature
    function convertTemperature($temperature, $fromUnit, $toUnit) {
        switch (strtoupper($fromUnit)) {
            case 'C':
                $celsius = $temperature;
                break;
            case 'F':
                $celsius = ($temperature - 32) * 5/9;
                break;
            case 'K':
                $celsius = $temperature - 273.15;
                break;
            default:
                throw new InvalidArgumentException("Unità di partenza non valida");
        }
    
        switch (strtoupper($toUnit)) {
            case 'C':
                return $celsius;
            case 'F':
                return $celsius * 9/5 + 32;
            case 'K':
                return $celsius + 273.15;
            default:
                throw new InvalidArgumentException("Unità di destinazione non valida");
        }
    }
    


    function logError($message) {
        $logFile = __DIR__ . '/../../logs/errors.log';
        $date = date('Y-m-d H:i:s');
        file_put_contents($logFile, "[$date] ERROR: $message" . PHP_EOL, FILE_APPEND);
    }



}


?>
    
