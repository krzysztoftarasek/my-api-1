<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;

class UserTest extends TestCase
{

    use WithFaker;

    private $password = "mypassword";

    public function testUserCreation()
    {

        $name = $this->faker->name();
        $email = $this->faker->email();

        $response = $this->postJson('/api/auth/signup', [
            'name' => $name,
            'email' => $email,
            'password' => $this->password,
            'password_confirmation' => $this->password
        ]);


        $response
            ->assertStatus(201)
            ->assertExactJson([
                'message' => "Successfully created user!",
            ]);


        try
        {
            $user = User::where('email', '=', $email)->firstOrFail();
            $user->delete();
        }
        catch(ModelNotFoundException $e) { }

    }

    public function testUserLogin()
    {
        $name = $this->faker->name();
        $email = $this->faker->email();

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($this->password)
        ]);

        $user->save();

        $response = $this->postJson('/api/auth/login', [
            'email' => $email,
            'password' => $this->password
        ]);


        $response->assertStatus(200);
        $this->assertAuthenticated();

        $user->delete();
    }

    public function testUserData()
    {
        $name = $this->faker->name();
        $email = $this->faker->email();

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($this->password)
        ]);

        $user->save();

        $responseLogin = $this->postJson('/api/auth/login', [
            'email' => $email,
            'password' => $this->password
        ]);

        $responseLogin->assertStatus(200);

        $response = $this->getJson('/api/auth/user', [
            'Authorization' => 'Bearer ' . $responseLogin['access_token'],
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);

        $this->assertAuthenticated();

        $user->delete();
    }

    public function testUserLogout()
    {
        $name = $this->faker->name();
        $email = $this->faker->email();

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($this->password)
        ]);

        $user->save();

        $responseLogin = $this->postJson('/api/auth/login', [
            'email' => $email,
            'password' => $this->password
        ]);

        $responseLogin->assertStatus(200);

        $response = $this->getJson('/api/auth/logout', [
            'Authorization' => 'Bearer ' . $responseLogin['access_token'],
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);

        $this->assertAuthenticated();

        $user->delete();
    }

}
