<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=task_manager;charset=utf8", "root", "");
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
