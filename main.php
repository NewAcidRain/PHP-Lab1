<?php

namespace labs;

use labs\Department;
use labs\Employee;

include 'Employee.php';
include 'Department.php';
require 'vendor/autoload.php';

use Symfony\Component\Validator\Validation;

$validator = Validation::createValidatorBuilder()
    ->addMethodMapping('loadValidatorMetadata')
    ->getValidator();


$em1 = new Employee(1, "Stepan", 700, "2019-11-12");
$em2 = new Employee(2, "Andrey", 400, "2023-11-12");
$em3 = new Employee(3, "Kirill", 300, "2021-11-12");
$em4 = new Employee(4, "Sergey", 600, "2019-11-12");
$em5 = new Employee(5, "Anton", 400, "2017-11-12");
$em6 = new Employee(7, "Vladimir", 300, "2012-11-12");
$em7 = new Employee(8, "Danil", 200, "2021-11-12");
$em8 = new Employee(9, "Nikita", 100, "2020-11-12");

//Validation test
$em9 = new Employee(-1, "Artem", 100, "2022-05-11");
$em10 = new Employee(11, "Al", 100, "2021-11-09");
$em11 = new Employee(10, "Igor", -100, "2018-04-15");
$em12 = new Employee(12, "Pavel", 100, "20-02");

$em_array = array($em1, $em2, $em3, $em4, $em5, $em6, $em7, $em8, $em9, $em10, $em11, $em12);

foreach ($em_array as $em) {
    $error = $validator->validate($em);
    if (count($error) == 0) {
        $em->EmployeeInfo();
        echo "Current experience(years): {$em->CurrentExperience()}", "<br><br>";
    }
    if (count($error) > 0) {
        $errorString = (string)$error;
        echo "Error in id: {$em->GetId()} <br> Type of error: $errorString <br><br>";
    }
}

$dep = new Department(array($em1->GetSalary(), $em2->GetSalary()), 'Department_1');
$dep_2 = new Department(array($em3->GetSalary(), $em4->GetSalary(), $em9), 'Department_2');
$dep_3 = new Department(array($em5->GetSalary(), $em6->GetSalary(), $em7->GetSalary()), 'Department_3');
$sum = $dep->SalarySum();
$values = array($dep_2, $dep_3);
echo "Sum of Department_1<br>";
foreach ($sum as $item) {
    echo $item, "<br>";
}
echo "<br>";

$int_array = array();
$string_array = array();
foreach ($values as $value) {
    $salary = $value->SalarySum();
    foreach ($salary as $item) {
        if (is_int($item)) {
            $int_array[] = $item;
        } else {
            $string_array[] = $item;
        }
    }
}
$max_value = max($int_array);
$min_value = min($int_array);


$coincidences = array();
if (count(array_unique($int_array)) != 1) {
    for ($i = 0; $i < count($int_array); $i++) {
        if (($max_value == $int_array[$i])) {
            echo "Max sum of Departments: <br>", $string_array[$i], "<br>";
        }
        if ($min_value == $int_array[$i]) {
            echo "Min sum of Departments: <br>", $string_array[$i], "<br>";
        }
    }
} else {
    for ($i = 0; $i < count($values); $i++) {
        if ($values[$i]->CountOfEmployees() < $values[$i + 1]->CountOfEmployees()) {
            echo "Several departments have the same amount of total salary, but there are more employees in: ", $values[$i + 1]->name;
            break;
        } elseif ($values[$i]->CountOfEmployees() > $values[$i + 1]->CountOfEmployees()) {
            echo "Several departments have the same amount of total salary, but there are more employees in: ", $values[$i]->name;
            break;
        } elseif ($values[$i]->CountOfEmployees() == $values[$i + 1]->CountOfEmployees()) {
            foreach ($values as $value) {
                $coincidences[] = $value->name;
            }
            echo "The departments have the same number of employees and the total salary is the same: ", "<br>";
            break;
        }
    }

    foreach ($coincidences as $coincidence) {
        echo $coincidence, "<br>";
    }

}

?>