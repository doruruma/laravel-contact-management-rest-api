<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'username' => 'andra',
            'password' => 'password',
            'name' => 'Andra Yuda'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'username' => 'andra',
                    'name' => 'Andra Yuda'
                ]
            ]);
    }

    public function testRegisterFailed()
    {
        $this->post('/api/users', [
            'username' => '',
            'password' => '',
            'name' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "The username field is required."
                    ],
                    'name' => [
                        "The name field is required."
                    ],
                    'password' => [
                        "The password field is required."
                    ],
                ]
            ]);
    }

    public function testRegisterUsernameAlreadyExists()
    {
        $this->testRegisterSuccess();
        $this->post('/api/users', [
            'username' => 'andra',
            'password' => 'password',
            'name' => 'Andra Yuda'
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "The username has already been taken."
                    ]
                ]
            ]);
    }
}
