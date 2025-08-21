<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TelegramWebhookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_unsubscribes_user_on_stop_command()
    {
        $user = User::factory()->create([
            'telegram_id' => '415796072',
            'subscribed' => true,
        ]);

        $payload = [
            'message' => [
                'chat' => ['id' => 415796072],
                'from' => ['first_name' => 'Test User'],
                'text' => '/stop',
            ]
        ];

        $this->postJson('/api/telegram/webhook', $payload)
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'subscribed' => false,
        ]);
    }

    /** @test */
    public function it_registers_user_on_start_command()
    {
        User::factory()->create([
            'telegram_id' => '415796072',
            'name' => 'Test User',
        ]);

        $payload = [
            'message' => [
                'chat' => ['id' => 415796072],
                'from' => ['first_name' => 'Test User'],
                'text' => '/start',
            ]
        ];

        $this->postJson('/api/telegram/webhook', $payload)
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'telegram_id' => '415796072',
            'name' => 'Test User',
            'subscribed' => true,
        ]);
    }


}
