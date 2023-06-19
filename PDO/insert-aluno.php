<?php
require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';


$pdo = ConnectionCreator::createConnection();

$student = new Student(
    null,
    'Robson ferreira',
    new \DateTimeImmutable('1997-01-04')
);

// $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?,?);";
// $stmt = $pdo->prepare($sqlInsert);
// $stmt->bindValue(1, $student->name());
// $stmt->bindValue(2, $student->birthDate()->format('Y-m-d'));


$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name,:birth_date);";
$stmt = $pdo->prepare($sqlInsert);
$stmt->bindValue(':name', $student->name);
$stmt->bindValue(':birth_date', $student->birthDate->format('Y-m-d'));

if($stmt->execute()){
    echo "Aluno incluido";
}else{
    echo "Deu não";
}
