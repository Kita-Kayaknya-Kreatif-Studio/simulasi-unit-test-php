<?php

namespace App\Controller;

use App\Requests\EmployeeRequest;

class EmployeeController
{
    public function store(array $request): array
    {
        $responseCode = 200;
        $message = 'Success';
        $result = [];

        // Ceritanya sebelum melakukan penyimpanan master data Employee ada validasi dulu.
        $validation = new EmployeeRequest();
        $validation = $validation->validatePost($request);

        if (! $validation['isValidated']) {
            $responseCode = 403;
            $message = 'Bad Request';
            $result = $validation['errorMessage'];
        } else {
            // Ceritanya di sini ada query.
            // INSERT INTO bla bla bla...
        }

        return [
            'status' => $responseCode,
            'message' => $message,
            'data' => $result,
        ];
    }
}