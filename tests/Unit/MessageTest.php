<?php

namespace MattLibera\LivewireFlash\Tests\Unit;

use MattLibera\LivewireFlash\Message;
use MattLibera\LivewireFlash\Tests\TestCase;

class MessageTest extends TestCase
{
    public function test_to_livewire_returns_all_fields(): void
    {
        $message = new Message([
            'message' => 'Hello world',
            'level'   => 'success',
            'title'   => 'Nice',
        ]);

        $result = $message->toLivewire();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('level', $result);
        $this->assertArrayHasKey('important', $result);
        $this->assertArrayHasKey('dismissable', $result);
        $this->assertArrayHasKey('overlay', $result);
    }

    public function test_from_livewire_round_trips_correctly(): void
    {
        $original = new Message([
            'message'    => 'Hello world',
            'level'      => 'success',
            'title'      => 'Nice',
            'important'  => true,
            'dismissable'=> false,
        ]);

        $serialized   = $original->toLivewire();
        $reconstructed = Message::fromLivewire($serialized);

        $this->assertInstanceOf(Message::class, $reconstructed);
        $this->assertEquals($original->message, $reconstructed->message);
        $this->assertEquals($original->level, $reconstructed->level);
        $this->assertEquals($original->title, $reconstructed->title);
        $this->assertEquals($original->important, $reconstructed->important);
        $this->assertEquals($original->dismissable, $reconstructed->dismissable);
        $this->assertFalse($reconstructed->overlay);
    }

    public function test_from_livewire_returns_same_instance_if_already_message(): void
    {
        $message = new Message(['message' => 'test']);
        $result  = Message::fromLivewire($message);

        $this->assertSame($message, $result);
    }

    public function test_from_livewire_throws_on_invalid_input(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Message::fromLivewire('not-an-array');
    }

    public function test_second_serialization_matches_first(): void
    {
        // Proves toLivewire output is stable across round-trips (no checksum drift)
        $message = new Message(['message' => 'stable', 'level' => 'info']);

        $first  = $message->toLivewire();
        $second = Message::fromLivewire($first)->toLivewire();

        $this->assertEquals($first, $second);
    }
}
