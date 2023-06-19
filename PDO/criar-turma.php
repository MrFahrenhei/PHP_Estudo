<?php
    require_once 'vendor/autoload.php';

    use Alura\Pdo\Domain\Model\Student;
    use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
    use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

    $connection = ConnectionCreator::createConnection();
    $studentRepository = new PdoStudentRepository($connection);

    $connection->beginTransaction();
    try{
        $a1 = new Student(null, 'Nico', new DateTimeImmutable('1990-05-03'));
        $studentRepository->save($a1);

        $a2 = new Student(null, 'Joao', new DateTimeImmutable('1999-06-08'));
        $studentRepository->save($a2);

        $connection->commit();
    }catch(\PDOException $e){
        echo $e->getMessage();
        $connection->rollBack();
    }
   
    
    