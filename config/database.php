<?php
/**
 * Database Connection Configuration
 * PMK Expert System - Sistem Pakar Diagnosa Penyakit Mulut dan Kuku
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pmk_expert_system');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

/**
 * Function to sanitize input
 * @param string $data - Input data to sanitize
 * @return string - Sanitized data
 */
function sanitize($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

/**
 * Function to display alert messages
 * @param string $message - Message to display
 * @param string $type - Alert type (success, danger, warning, info)
 * @return string - HTML alert element
 */
function alert($message, $type = 'info') {
    return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
                ' . $message . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

/**
 * Function to redirect with message
 * @param string $url - URL to redirect to
 * @param string $message - Message to pass
 * @param string $type - Message type
 */
function redirect($url, $message = '', $type = 'info') {
    if ($message) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header("Location: $url");
    exit();
}

/**
 * Display flash message if exists
 */
function displayFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        echo alert($_SESSION['flash_message'], $_SESSION['flash_type'] ?? 'info');
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    }
}
?>
