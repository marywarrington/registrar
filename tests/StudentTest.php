<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once __DIR__ . '/../src/Student.php';

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }
        
        function test_getInfo()
        {
            // Arrange
            $name = "Marika";
            $id = null;
            $date = "1999-01-01";

            $test_student = new Student($name, $date, $id);
            // Act
            $result1 = $test_student->getName();
            $result2 = $test_student->getDate();
            $result3 = $test_student->getId();
            // Assert
            $this->assertEquals($name, $result1);
            $this->assertEquals($date, $result2);
            $this->assertEquals($id, $result3);
        }

        function test_save()
        {
            // Arrange
            $name = "Marika";
            $id = null;
            $date = "1999-01-01";
            $test_student = new Student($name, $date, $id);

            // Act
            $test_student->save();
            $result = Student::getAll();

            // Assert
            $this->assertEquals($test_student, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Marika";
            $id = null;
            $date = "1999-01-01";
            $test_student = new Student($name, $date, $id);
            $test_student->save();

            $name2 = "Mary";
            $id2 = null;
            $date2 = "1969-01-01";
            $test_student2 = new Student($name2, $date2, $id2);
            $test_student2->save();

            // Act
            $result = Student::getAll();

            // Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }
    }
 ?>