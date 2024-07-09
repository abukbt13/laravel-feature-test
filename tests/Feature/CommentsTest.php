<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AutTest;

class CommentsTest  extends AutTest
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     */

    public function testCreateComment(): void
    {
        $user = $this->loginUser();

        $post = Post::create([
            'user_id' =>$user['id'],
            'title' => 'Farming',
            'description' => 'land preparation',
        ]);


        $data = [
            'comment' => 'test comment',
        ];


        $response = $this->post("/api/v1/posts/{$post['id']}/comments",$data);

        $response->assertStatus(201);
    }

    public function testFetchComments(): void
    {
        $post_id=4;
        $user = $this->loginUser();
        $response = $this->get('/api/v1/posts/{$post_id}/comments');

        $response->assertStatus(200);
    }
}
