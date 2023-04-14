<?php

    namespace Alura\Mvc\Controller;

    use Alura\Mvc\Repository\UserRepository;
use PDO;

    class LoginController implements Controller
    {
        private PDO $pdo;
        public function __construct(
            //private UserRepository $userRepository
        )
        {
            $dbPath = __DIR__. '/../../db.sqlite';
            $this->pdo = new PDO("sqlite:$dbPath");
        }
        public function processaRequisicao(): void
        {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');

            //$success = $this->userRepository->logIn($email, $password);
            $sql = 'SELECT * FROM users WHERE email = ?';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $correctPSW = password_verify($password, $userData['password'] ?? '');


            //permite sempre manter a senha atualizada
            if (password_needs_rehash($userData['password'], PASSWORD_ARGON2I)) {
                $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
                $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
                $statement->bindValue(2, $userData['id']);
                $statement->execute();
            }

            if($correctPSW){
                $_SESSION['logado'] = true;
                header('Location: /');
            }else{
                header('Location: /login?sucess=0');
            }
        }
    }