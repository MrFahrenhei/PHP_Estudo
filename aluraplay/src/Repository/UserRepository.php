<?php

    namespace Alura\Mvc\Repository;

    use Alura\Mvc\Entity\User;
    use PDO;

    class UserRepository{
        public function __construct(private PDO $pdo)
        {
            
        }

        public function add(User $user): bool
        {
            $sql = 'INSERT INTO users (email, password) VALUES (?, ?);';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $user->email);
            $stmt->bindValue(2, $user->password);

            $result = $stmt->execute();
            $id = $this->pdo->lastInsertId();
            $user->setId(intval($id));
            
            return $result;
        }

        public function logIn(string $email, string $password): void
        {
            $sql = 'SELECT * FROM users WHERE email = ?';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $correctPSW = password_verify($password, $userData['password'] ?? '');

            if($correctPSW){
                header('Location: /');
            }else{
                header('Location: /login?sucess=0');
            }
        }
    }
    