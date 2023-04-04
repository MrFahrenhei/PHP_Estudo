<?php

namespace Alura\Pdo\Domain\Model;

class Student
{   
    /** @var Phones[] */
    private array $phones = [];
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly \DateTimeInterface $birthDate,

    ){}
 
    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    public function addPhone(Phone $phone): void{
        $this->phones[] = $phone;
    }

    /** @return Phone[] */
    public function getPhone(): array{
        return $this->phones;
    }
}
