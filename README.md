# 📝 API de Tarefas (Task API)

Uma API simples para gerenciamento de tarefas, construída com PHP e MySQL, perfeita para projetos pessoais ou estudos.

## 🚀 Recursos

- ✅ CRUD completo de tarefas
- ✅ Banco de dados MySQL
- ✅ JSON API RESTful
- ✅ Fácil integração com frontends

## 🔧 Pré-requisitos

- PHP 7.4+
- MySQL 5.7+ (ou MariaDB 10.3+)
- XAMPP/LAMPP (opcional)
- cURL ou Postman para testar

## 🛠️ Instalação

1. Clone o repositório:
```bash
git clone https://github.com/AAndersonSantos/API-TASK-PHP.git
```

2. Configure o banco de dados:
```bash
php create_database.php
```

3. Inicie o servidor embutido do PHP:
```bash
php -S localhost:8000 api.php
```

## 📊 Endpoints

| Método | Endpoint    | Descrição               | Corpo da Requisição (JSON)          |
|--------|-------------|-------------------------|-------------------------------------|
| GET    | /api.php    | Lista todas as tarefas  | -                                   |
| POST   | /api.php    | Cria nova tarefa        | `{"title": "Nova tarefa"}`          |
| PUT    | /api.php    | Atualiza tarefa         | `{"id": 1, "completed": 1}`         |
| DELETE | /api.php    | Remove tarefa           | `{"id": 1}`                         |

## 🧪 Exemplos de Uso

### Criar tarefa
```bash
curl -X POST http://localhost:8000/api.php \
  -H "Content-Type: application/json" \
  -d '{"title": "Comprar leite"}'
```

### Listar tarefas
```bash
curl http://localhost:8000/api.php
```

### Atualizar tarefa (marcar como concluída)
```bash
curl -X PUT http://localhost:8000/api.php \
  -H "Content-Type: application/json" \
  -d '{"id": 1, "completed": 1}'
```

### Deletar tarefa
```bash
curl -X DELETE http://localhost:8000/api.php \
  -H "Content-Type: application/json" \
  -d '{"id": 1}'
```

## 🏗️ Estrutura do Banco

```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  completed TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

✨ **Dica:** Para desenvolvimento com XAMPP, coloque os arquivos na pasta `/opt/lampp/htdocs/` e acesse via `http://localhost/nome-da-pasta/api.php`