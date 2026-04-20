<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

// Обработка входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid email or password";
    }
}

// Обработка регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password)');
        $stmt->execute([':name' => $name, ':email' => $email, ':password' => $password]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_name'] = $name;
        header('Location: index.php');
        exit();
    } catch(PDOException $e) {
        $error = "Email already exists";
    }
}

// Выход
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php if (isLoggedIn()): ?>
            <!-- Панель пользователя -->
            <div class="header">
                <h1>My Notes</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>!</span>
                    <a href="?logout" class="btn btn-logout">Logout</a>
                    <a href="create_note.php" class="btn btn-primary">+ New Note</a>
                </div>
            </div>

            <!-- Список заметок -->
            <div class="notes-grid">
                <?php 
                $notes = getNotesByUser($pdo, $_SESSION['user_id']);
                if (empty($notes)): 
                ?>
                    <div class="empty-state">
                        <p>No notes yet. Create your first note!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($notes as $note): ?>
                        <div class="note-card <?php echo $note['is_pinned'] ? 'pinned' : ''; ?>">
                            <div class="note-header">
                                <h3><?php echo htmlspecialchars($note['title'] ?: 'Untitled'); ?></h3>
                                <div class="note-actions">
                                    <a href="?pin=<?php echo $note['id']; ?>" class="pin-btn" title="Pin/Unpin">
                                        📌
                                    </a>
                                    <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="edit-btn">✏️</a>
                                    <a href="delete_note.php?id=<?php echo $note['id']; ?>" 
                                       class="delete-btn" 
                                       onclick="return confirm('Delete this note?')">🗑️</a>
                                </div>
                            </div>
                            <div class="note-body">
                                <?php echo nl2br(htmlspecialchars(substr($note['body'] ?? '', 0, 150))); ?>
                                <?php echo strlen($note['body'] ?? '') > 150 ? '...' : ''; ?>
                            </div>
                            <div class="note-footer">
                                <small>Updated: <?php echo date('M d, Y', strtotime($note['updated_at'])); ?></small>
                                <?php if (isset($note['tags']) && $note['tags']): ?>
                                    <div class="tags">
                                        <?php foreach(explode(',', $note['tags']) as $tag): ?>
                                            <span class="tag">#<?php echo htmlspecialchars(trim($tag)); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php 
            // Обработка пина
            if (isset($_GET['pin'])) {
                togglePinNote($pdo, $_GET['pin'], $_SESSION['user_id']);
                header('Location: index.php');
                exit();
            }
            ?>

        <?php else: ?>
            <!-- Форма входа/регистрации -->
            <div class="auth-container">
                <div class="auth-box">
                    <h2>📝 Notes App</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <div class="tabs">
                        <button class="tab-btn active" onclick="showTab('login')">Login</button>
                        <button class="tab-btn" onclick="showTab('register')">Register</button>
                    </div>

                    <form method="POST" id="login-form" class="auth-form active">
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>

                    <form method="POST" id="register-form" class="auth-form">
                        <input type="text" name="name" placeholder="Full Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>

            <script>
                function showTab(tab) {
                    document.getElementById('login-form').classList.remove('active');
                    document.getElementById('register-form').classList.remove('active');
                    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                    
                    if (tab === 'login') {
                        document.getElementById('login-form').classList.add('active');
                        document.querySelector('.tab-btn:first-child').classList.add('active');
                    } else {
                        document.getElementById('register-form').classList.add('active');
                        document.querySelector('.tab-btn:last-child').classList.add('active');
                    }
                }
            </script>
        <?php endif; ?>
    </div>
</body>
</html>