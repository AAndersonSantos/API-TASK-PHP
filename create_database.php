<?php
$host = 'localhost';
$dbname = 'tarefas_db';
$user = 'root';
$pass = 'root';
$socket = '/opt/lampp/var/mysql/mysql.sock';

try {
    $pdo = new PDO(
        "mysql:host=$host;unix_socket=$socket", 
        $user, 
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Criar o database se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    $pdo->exec("USE $dbname");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            completed TINYINT(1) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    echo "Banco de dados e tabela 'tasks' criados com sucesso!\n";
    echo "Detalhes:\n";
    echo "- Database: $dbname\n";
    echo "- Tabela: tasks (com colunas id, title, completed, created_at, updated_at)\n";

} catch (PDOException $e) {
    die("ERRO: " . $e->getMessage() . "\n" .
        "Verifique:\n" .
        "1. Se o XAMPP está rodando (sudo /opt/lampp/xampp status)\n" .
        "2. Se a senha do MySQL está correta\n" .
        "3. Se o socket existe em $socket\n");
}
?>