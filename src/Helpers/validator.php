<?php

function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9]{3,}$/', $username);
}
function validatePassword($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

function validateCityName($cityName) {
    return preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s-]{2,}$/', $cityName);
}

function validateLatitude($latitude) {
    return is_numeric($latitude) && $latitude >= -90 && $latitude <= 90;
}

function validateLongitude($longitude) {
    return is_numeric($longitude) && $longitude >= -180 && $longitude <= 180;
}

function validateDate($date) {
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
}

?>
