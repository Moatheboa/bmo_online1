<?php

/**
 * Connects to the database specified by the parameter dbPath.
 * Assumes localhost if the server isn't student.bth.
 *
 * @param string $dbPath Path to the database file.
 * @return PDO Returns the database connection object.
 */
function connectToDatabase(string $dbPath): PDO
{
    if ($_SERVER["SERVER_NAME"] !== "www.student.bth.se") {
        $dbPath = "C:\\db\\bmo.sqlite"; // Local database file path.
    }

    $dsn = "sqlite:$dbPath";
    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Failed to connect to the database using DSN:<br>'$dsn'<br>";
        throw $e;
    }

    return $pdo;
}

/**
 * Fetches a single row from the database based on the parameters.
 *
 * WARNING! No SQL injection protection - use only with safe data.
 *
 * @param array|string $list Array of column names to fetch, or empty for all columns.
 * @param string $table Name of the table to fetch from.
 * @param int $id ID of the row to select.
 * @param PDO $pdo Database connection object.
 * @return array|null Associative array with result, or null if nothing was found.
 * @throws InvalidArgumentException If the list parameter is not an array.
 */
function fetchOneRowFromDb(array $list, string $table, int $id, PDO $pdo): ?array
{
    try {
        if (empty($list)) {
            $list = '*';
        } else {
            $list = implode(', ', $list);
        }

        $sql = "SELECT $list FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    } catch (Exception $e) {
        echo "Error, please check that all parameters are correct: " . $e->getMessage();
        return null;
    }
}

/**
 * Fetches rows from a table in the database based on the parameters.
 *
 * WARNING! No SQL injection protection - use only with safe data.
 *
 * @param array|string $list Array of column names to fetch, or empty for all columns.
 * @param string $table Name of the table to fetch from.
 * @param PDO $pdo Database connection object.
 * @return array Associative array with results.
 */
function fetchFromDb(array $list, string $table, PDO $pdo): array
{
    try {
        $list = empty($list) ? '*' : implode(', ', $list);

        $sql = "SELECT $list FROM $table";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    } catch (Exception $e) {
        echo "Error, please check that all parameters are correct: " . $e->getMessage();
        return [];
    }
}
