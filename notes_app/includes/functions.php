<?php
function createNote(PDO $pdo, int $userId, string $title, string $body): int {
    $stmt = $pdo->prepare(
        'INSERT INTO notes (user_id, title, body) VALUES (:uid, :title, :body)'
    );
    $stmt->execute([':uid' => $userId, ':title' => $title, ':body' => $body]);
    return (int)$pdo->lastInsertId();
}

function getNotesByUser(PDO $pdo, int $userId): array {
    $stmt = $pdo->prepare(
        'SELECT n.*, GROUP_CONCAT(t.name ORDER BY t.name SEPARATOR ",") AS tags
         FROM notes n
         LEFT JOIN note_tags nt ON nt.note_id = n.id
         LEFT JOIN tags t ON t.id = nt.tag_id
         WHERE n.user_id = :uid
         GROUP BY n.id
         ORDER BY n.is_pinned DESC, n.updated_at DESC'
    );
    $stmt->execute([':uid' => $userId]);
    return $stmt->fetchAll();
}

function getNoteById(PDO $pdo, int $noteId, int $userId) {
    $stmt = $pdo->prepare('SELECT * FROM notes WHERE id = :id AND user_id = :uid');
    $stmt->execute([':id' => $noteId, ':uid' => $userId]);
    return $stmt->fetch();
}

function updateNote(PDO $pdo, int $noteId, int $userId, string $title, string $body): bool {
    $stmt = $pdo->prepare('UPDATE notes SET title = :title, body = :body WHERE id = :id AND user_id = :uid');
    return $stmt->execute([':title' => $title, ':body' => $body, ':id' => $noteId, ':uid' => $userId]);
}

function deleteNote(PDO $pdo, int $noteId, int $userId): bool {
    $stmt = $pdo->prepare('DELETE FROM notes WHERE id = :id AND user_id = :uid');
    return $stmt->execute([':id' => $noteId, ':uid' => $userId]);
}

function togglePinNote(PDO $pdo, int $noteId, int $userId): bool {
    $stmt = $pdo->prepare('UPDATE notes SET is_pinned = NOT is_pinned WHERE id = :id AND user_id = :uid');
    return $stmt->execute([':id' => $noteId, ':uid' => $userId]);
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}
?>