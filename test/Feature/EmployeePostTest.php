<?php

use App\Controller\EmployeeController;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class EmployeePostTest extends TestCase
{
    public function testCanSaveEmployeeData(): void
    {
        $faker = FakerFactory::create();
        $_POST['employee_name'] = $faker->name();
        $_POST['employee_age'] = $faker->numberBetween(18, 54);

        $request = new EmployeeController();
        $result = $request->store($_POST);
        $this->assertEquals(200, $result['status']);
    }

    public function testCanHandleUnderAgeEmployeeData(): void
    {
        $faker = FakerFactory::create();
        $_POST['employee_name'] = $faker->name();
        $_POST['employee_age'] = 17;

        $request = new EmployeeController();
        $result = $request->store($_POST);
        $this->assertEquals(403, $result['status']);
    }
}