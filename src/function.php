<?php
require_once __DIR__ . '/db.php';

//______________РЕГИСТРАЦИЯ___________

function getUserLogin($pdo, $login) {
    $sql = "SELECT * FROM Users WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['login' => $login]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function emailExists($pdo, $email) {
    $sql = "SELECT * FROM Users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getUserById($pdo, $id) {
    $sql = "SELECT * FROM Users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function AddUser($pdo, $login, $email, $created_at, $password, $role = 'user') {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (login, password, email, role, created_at, is_blocked)
            VALUES (:login, :password, :email, :role, :created_at, 0)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':login' => $login,
        ':password' => $passwordHash,
        ':email' => $email,
        ':role' => $role,
        ':created_at' => $created_at,
    ]);
}

//_____________________ПОЛЬЗОВАТЕЛИ________________________

function SelectUsers($pdo) {
    $sql = "SELECT * FROM Users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function UpdateUser($pdo, $id, $login, $email, $role = 'user', $is_blocked = 0) {
    $sql = "UPDATE Users
            SET login      = :login,
                email      = :email,
                role       = :role,
                is_blocked = :is_blocked
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'  => $id,
        ':login'  => $login,
        ':email' => $email,
        ':role' => $role,
        ':is_blocked' => $is_blocked
    ]);
}
function DeleteUser($pdo, $id) {
    $sql = "DELETE FROM Users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

//__________________АВТОРЫ___________________

function AddAuthor($pdo, $name) {
    $sql = "INSERT INTO authors(name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':name' => $name]);
}
function SelectAuthor($pdo) {
    $sql = "SELECT * FROM authors";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAuthorById($pdo, $id) {
    $sql = "SELECT * FROM authors WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function UpdateAuthor($pdo, $id, $name) {
    $sql = "UPDATE authors SET name = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'   => $id,
        ':name' => $name
    ]);
}
function DeleteAuthor($pdo, $id) {
    $sql = "DELETE FROM authors WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

//__________________ЖАНРЫ___________________

function AddGenre($pdo, $name) {
    $sql = "INSERT INTO genres(name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':name' => $name]);
}
function SelectGenre($pdo) {
    $sql = "SELECT * FROM genres";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getGenreById($pdo, $id) {
    $sql = "SELECT * FROM genres WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function UpdateGenre($pdo, $id, $name) {
    $sql = "UPDATE genres SET name = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'   => $id,
        ':name' => $name
    ]);
}
function DeleteGenre($pdo, $id) {
    $sql = "DELETE FROM genres WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

//__________________КНИГИ___________________

function AddBook($pdo, $name, $publish_date, $all_quantity, $free_quantity, $author_id, $genre_id) {
    $sql = "INSERT INTO books(name, publish_date, all_quantity, free_quantity, author_id, genre_id)
            VALUES (:name, :publish_date, :all_quantity, :free_quantity, :author_id, :genre_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':name' => $name,
        ':publish_date' => $publish_date,
        ':all_quantity' => $all_quantity,
        ':free_quantity' => $free_quantity,
        ':author_id' => $author_id,
        ':genre_id' => $genre_id
    ]);
}
function SelectBooks($pdo) {
    $sql = "SELECT * FROM books";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getBookById($pdo, $id) {
    $sql = "SELECT * FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function UpdateBook($pdo, $id, $name, $publish_date, $all_quantity, $free_quantity, $author_id, $genre_id) {
    $sql = "UPDATE books
            SET name = :name,
                publish_date = :publish_date,
                all_quantity = :all_quantity,
                free_quantity = :free_quantity,
                author_id = :author_id,
                genre_id = :genre_id
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':publish_date' => $publish_date,
        ':all_quantity' => $all_quantity,
        ':free_quantity' => $free_quantity,
        ':author_id' => $author_id,
        ':genre_id' => $genre_id
    ]);
}
function DeleteBook($pdo, $id) {
    $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

//______________ВЫДАЧИ________________

function AddLoan($pdo, $books_id, $users_id, $give_date, $due_date, $return_date = null, $status = 'Выдана') {
    $sql = "INSERT INTO loans(books_id, users_id, give_date, due_date, return_date, status)
            VALUES (:books_id, :users_id, :give_date, :due_date, :return_date, :status)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':books_id' => $books_id,
        ':users_id' => $users_id,
        ':give_date' => $give_date,
        ':due_date' => $due_date,
        ':return_date' => $return_date,
        ':status' => $status
    ]);
}
function SelectLoans($pdo) {
    $sql = "SELECT
                loans.id,
                loans.books_id,
                books.name AS book_name,
                loans.users_id,
                Users.login AS user_login,
                loans.give_date,
                loans.due_date,
                loans.return_date,
                loans.status
            FROM loans
            LEFT JOIN books ON loans.books_id = books.id
            LEFT JOIN Users ON loans.users_id = Users.id
            ORDER BY loans.give_date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getLoanById($pdo, $id) {
    $sql = "SELECT * FROM loans WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function UpdateLoan($pdo, $id, $books_id, $users_id, $give_date, $due_date, $return_date, $status) {
    $sql = "UPDATE loans
            SET books_id = :books_id,
                users_id = :users_id,
                give_date = :give_date,
                due_date = :due_date,
                return_date = :return_date,
                status = :status
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'  => $id,
        ':books_id' => $books_id,
        ':users_id' => $users_id,
        ':give_date' => $give_date,
        ':due_date' => $due_date,
        ':return_date' => $return_date,
        ':status' => $status
    ]);
}
function DeleteLoan($pdo, $id) {
    $sql = "DELETE FROM loans WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

//______________АНАЛИТИКА________________

function TotalLoans($pdo) {
    $sql = "SELECT COUNT(*) FROM loans";
    $stmt = $pdo->query($sql);
    return $stmt->fetchColumn() ?: 0;
}
function PopularGenre($pdo) {
    $sql = "SELECT genres.name AS genre_name, COUNT(loans.id) AS loan_count
            FROM loans
            JOIN books ON books.id = loans.books_id
            JOIN genres ON genres.id = books.genre_id
            GROUP BY genres.id, genres.name
            ORDER BY loan_count DESC
            LIMIT 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function PopularBook($pdo) {
    $sql = "SELECT books.name AS book_name, COUNT(loans.id) AS loan_count
            FROM loans
            JOIN books ON books.id = loans.books_id
            GROUP BY books.id, books.name
            ORDER BY loan_count DESC
            LIMIT 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}