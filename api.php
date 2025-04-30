<?php
header('Content-Type: application/json');

$config = [
    'host' => 'localhost',
    'socket' => '/opt/lampp/var/mysql/mysql.sock',
    'dbname' => 'tarefas_db',
    'user' => 'root',
    'pass' => 'root',
    'charset' => 'utf8mb4'
];

try {
    $dsn = "mysql:host={$config['host']};unix_socket={$config['socket']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['user'], $config['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'error' => 'Erro de conexão',
        'details' => $e->getMessage(),
        'solution' => 'Verifique: 1) XAMPP em execução 2) Socket em '.$config['socket']
    ]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Listar tarefas
        $stmt = $pdo->query('SELECT * FROM tasks');
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tasks);
        break;

    case 'POST':
        // Criar tarefa
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare('INSERT INTO tasks (title) VALUES (:title)');
        $stmt->bindParam(':title', $data['title']);
        $stmt->execute();
        echo json_encode(['message' => 'Tarefa criada com sucesso!', 'id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        // Atualizar tarefa
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare('UPDATE tasks SET completed = :completed WHERE id = :id');
        $stmt->bindParam(':completed', $data['completed'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(['message' => 'Tarefa atualizada!']);
        break;

    case 'DELETE':
        // Deletar tarefa
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(['message' => 'Tarefa deletada!']);
        break;

    default:
        echo json_encode(['message' => 'Método não suportado!']);
        break;
}
?>