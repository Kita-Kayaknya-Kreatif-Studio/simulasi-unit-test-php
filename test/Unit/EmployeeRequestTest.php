<?php

use App\Requests\EmployeeRequest;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class EmployeeRequestTest extends TestCase
{
    public function testValidationRequestCanHandleValidInput(): void
    {
        $faker = FakerFactory::create();
        $_POST['employee_name'] = $faker->name();
        $_POST['employee_age'] = $faker->numberBetween(18, 54);

        $request = new EmployeeRequest();
        $result = $request->validatePost($_POST);

        $this->assertEquals(true, $result['isValidated']);
    }

    public function testValidationRequestCanHandleEmptyInput(): void
    {
        $faker = FakerFactory::create();
        $_POST['employee_name'] = '';
        $_POST['employee_age'] = '';

        $request = new EmployeeRequest();
        $result = $request->validatePost($_POST);
        $this->assertEquals(false, $result['isValidated']);
    }

    public function testValidationRequestCanHandleAgeStringInput(): void
    {
        $faker = FakerFactory::create();
        $_POST['employee_name'] = $faker->name();
        $_POST['employee_age'] = '17';

        $request = new EmployeeRequest();
        $result = $request->validatePost($_POST);
        $this->assertEquals(false, $result['isValidated']);
    }

    public function testValidationRequestCanHandleNameIntegerInput(): void
    {
        $faker = FakerFactory::create();
        $_POST['employee_name'] = 1251215316546;
        $_POST['employee_age'] = 18;

        $request = new EmployeeRequest();
        $result = $request->validatePost($_POST);
        $this->assertEquals(false, $result['isValidated']);
    }
}