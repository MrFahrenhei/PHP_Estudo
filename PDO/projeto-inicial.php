<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Vinícius Valle Beraldo',
    new \DateTimeImmutable('2001-02-06')
);

echo $student->age();
