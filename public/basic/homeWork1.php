<?php

class Human
{
    public function __construct($name, $age, $dateOfBirth)
    {
        $this->name = $name;
        $this->age = $age;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function displayInfo()
    {
        echo "<p>I'm {$this->name}, {$this->age}YO, {$this->dateOfBirth}</p>";
    }
}

$hum = new Human('Alex', 33, '1985-05-10');
$hum->displayInfo();

class Employee extends Human {
    public function __construct($name, $age, $dateOfBirth, $salary, $department)
    {
        parent::__construct($name, $age, $dateOfBirth);
        $this->salary = $salary;
        $this->department = $department;
    }

    public function displayInfo()
    {
        parent::displayInfo();
        echo "<p>{$this->salary}, {$this->department}</p>";

    }

}

$emp = new Employee('Alex', 33, '1985-05-10', 500, 'IT');
$emp->displayInfo();

class Manager extends Employee
{
    public function __construct($name, $age, $dateOfBirth, $salary, $department)
    {
        parent::__construct($name, $age, $dateOfBirth, $salary, $department);
        $this->developers = [];
    }

    public function addSlave($developer) {
        $this->developers[] = $developer;
    }

    public function deleteSlave($developer) {
        $slave = array_search($developer, $this->developers);
        unset($this->developers[$slave]);
        array_values($this->developers);
    }
}

class Developer extends Employee
{
    public function __construct($name, $age, $dateOfBirth, $salary, $department)
    {
        parent::__construct($name, $age, $dateOfBirth, $salary, $department);
        $this->manager = null;
    }

    public function changeManager($manager) {
        if ($this->manager) {
            $this->manager = null;
        } else {
            $this->manager = $manager;
        }
    }
}

$managerMale = new Manager('John Doe', 33, '10.05.1985', 50000, 'Masters');
$managerFemale = new Manager('Joana Doe', 30, '05.07.1988', 50000, 'Masters');
$developerJunior = new Developer('Kozma Prutkov', 20, '13.03.1998', 20000, 'Slaves');
$developerMiddle = new Developer('Afanasiy Fet', 25, '23.10.1993', 35000, 'Slaves');

$managerMale->addSlave($developerJunior);
$managerFemale->addSlave($developerMiddle);
$managerMale->displayInfo();
$developerMiddle->changeManager($managerFemale);
$developerMiddle->displayInfo();
$developerJunior->changeManager($managerMale);
$developerJunior->displayInfo();
$managerFemale->displayInfo();


class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); //1    Тут префиксный инкремент, поэтому он сначала увеличивает переменную на 1,
$a2->foo(); //2    а потом выводит результат. Сам метод принадлежит классу, поэтому неважно из какого объекта
$a1->foo(); //3    происходит вызов, результат при кажом вызове увеличивает переменную на 1.
$a2->foo(); //4
class B {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class C extends B {
}
$a1 = new B();
$b1 = new C();
$a1->foo(); //1     Про инкремент такая же история, что и заданием выше. Но тут появляется класс наследник.
$b1->foo(); //1     И для него уже свой метод foo().
$a1->foo(); //2
$b1->foo(); //2
class D {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class E extends D {
}
$a1 = new D;
$b1 = new E;
$a1->foo(); //1     Просто другой стиль написания. Ничем не отличается от предыдущего задания.
$b1->foo(); //1
$a1->foo(); //2
$b1->foo(); //2