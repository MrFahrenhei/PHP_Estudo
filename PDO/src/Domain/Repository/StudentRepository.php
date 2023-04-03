<?php

namespace Alura\Pdo\Domain\Respository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository{
    public function allStudents(): array;

    public function studentsBrithAt(\DateTimeInterface $birthDate): array;

    public function save(Student $student): bool;

    public function remove(Student $student): bool;
}