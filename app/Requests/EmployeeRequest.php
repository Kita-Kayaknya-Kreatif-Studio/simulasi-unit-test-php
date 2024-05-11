<?php

namespace App\Requests;

class EmployeeRequest
{
    public function validatePost(array $request): array
    {
        $errorMessage = [];
        if (! isset($request['employee_name'])) {
            $errorMessage['employee_name'] = 'Employee Name is required.';
        } else {
            if (! is_string($request['employee_name'])) {
                $errorMessage['employee_name'] = 'Employee Name value is invalid. Expecting String only.';
            } else if (! strlen($request['employee_name']) >= 3) {
                $errorMessage['employee_name'] = 'Employee Name is too short.';
            } else if (strlen($request['employee_name']) > 128) {
                $errorMessage['employee_name'] = 'Employee Name is too long.';
            }
        }

        if (! isset($request['employee_age'])) {
            $errorMessage['employee_age'] = 'Employee Age is required.';   
        } else {
            if (! is_int($request['employee_age'])) {
                $errorMessage['employee_age'] = 'Employee Age value is invalid. Expecting Integer only.';
            } else {
                if ($request['employee_age'] < 18 || $request['employee_age'] >= 55) {
                    $errorMessage['employee_age'] = 'Employee Age value is invalid. Expecting above 18 & under 55 only.';
                }
            }
        }

        return ['isValidated' => count($errorMessage) == 0, 'errorMessage' => $errorMessage];
    }

}