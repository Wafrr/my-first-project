<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
requireLogin();

$noteId = $_GET['id'] ?? 0;
$note = getNoteById($pdo, $noteId, $_SESSION['user_id']);

if (!$note) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $body = $_POST['body'] ?? '';
    
    updateNote($pdo, $noteId, $_SESSION['user_id'], $title, $body);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note - Notes App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✏️ Edit Note</h1>
            <a href="index.php" class="btn btn-secondary">← Back</a>
        </div>

        <form method="POST" class="note-form">
            <input type="text" name="title" value="<?php echo htmlspecialchars($note['title']); ?>" 
                   placeholder="Title" class="note-title">
            <textarea name="body" placeholder="Write your note here..." rows="15" 
                      class="note-body"><?php echo htmlspecialchars($note['body']); ?></textarea>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Note</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>