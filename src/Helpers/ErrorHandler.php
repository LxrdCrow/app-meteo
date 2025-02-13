<?php

class ErrorHandler
{
    public static function handleException(Throwable $exception)
    {
        http_response_code(500);
        echo json_encode([
            "error" => "Internal Server Error",
            "message" => $exception->getMessage()
        ]);
        error_log($exception->getMessage()); // Register the error in the log
    }

    // Function to handle fatal errors
    public static function handleFatalError($errno, $errstr, $errfile, $errline) {
        http_response_code(500);
        echo json_encode([
            "error" => "Internal Server Error",
            "message" => "Fatal Error: $errstr in $errfile on line $errline"
        ]);
        error_log("$errstr in $errfile on line $errline");
    }

    // Function to register the error handlers
    public static function register() {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleFatalError']);
    }

}

ErrorHandler::register();

?>