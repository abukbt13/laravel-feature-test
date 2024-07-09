<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\AutTest;

class PostTest extends AutTest
{
    use RefreshDatabase,WithFaker;
    /**
     * A basic feature test example.
     */
    public function testCreatePost(): void
    {
        $data =[
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
        $user = $this->loginUser();
//        dd($user);
        $response = $this->post('/api/v1/posts',$data);
        $response->assertStatus(200);
    }

    public function testShowAllPosts(): void
    {
        $user = $this->loginUser();
        $response = $this->get('/api/v1/posts');
        $response->assertStatus(200);
    }
}
