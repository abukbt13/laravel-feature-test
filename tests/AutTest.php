<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class AutTest extends BaseTestCase
{

    protected function loginUser(User $user = null)
    {
        $user = $user ?? User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
}
