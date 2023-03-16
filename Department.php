<?php

namespace labs;

class Department
{
    public array $employees;
    public string $name;
    function __construct($array_of_employee,$name){
        $this->name = $name;
        $this->employees = $array_of_employee;
    }

    public function SalarySum(): array
    {

        return array($this->name,array_sum($this->employees));
    }

    public function CountOfEmployees(): int
    {
        return count($this->employees);
    }

}



?>