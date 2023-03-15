<?php
namespace labs\src;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Employee{
    private int $id;
    private string $name;
    private int $salary;
    private string $date_of_employment;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'id',
            new Assert\PositiveOrZero()
        );
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'name',
            new Assert\Length([
                'min' => 3,
                'max' => 20,
            ])
        );
        $metadata->addPropertyConstraint('salary', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'salary',
            new Assert\PositiveOrZero()
        );
        $metadata->addPropertyConstraint('date_of_employment', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'date_of_employment',
            new Assert\Date()
        );
    }

    public function __construct($id,$name,$salary,$date_of_employment)
    {
        $this->id=$id;
        $this->name=$name;
        $this->salary=$salary;
        $this->date_of_employment=$date_of_employment;
    }

    public function EmployeeInfo(): void
    {
        echo "Id:$this->id, Name: $this->name, Salary:$this->salary, Date of Employment: $this->date_of_employment <br>";

    }

    public function CurrentExperience(): int
    {
        return  (int)date('Y',strtotime("now")) - (int)date('Y',strtotime("$this->date_of_employment"));
    }
    public function GetSalary() : int{
        return $this->salary;
    }

    public function GetId(): int {
        return $this->id;
    }


}


?>
