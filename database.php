require_once 'config/dotenv.php';

function getDatabaseConnection() {
    // Parametri di connessione
    $host = getenv('DB_HOST'); // Ottieni l'host dal file .env
    $db   = getenv('DB_NAME'); // Ottieni il nome del database
    $user = getenv('DB_USER'); // Ottieni l'username dal file .env
    $pass = getenv('DB_PASSWORD'); // Ottieni la password dal file .env
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    return new PDO($dsn, $user, $pass, $options);
}