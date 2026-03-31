<?php

namespace MattLibera\LivewireFlash\Tests\Unit;

use MattLibera\LivewireFlash\OverlayMessage;
use MattLibera\LivewireFlash\Tests\TestCase;

class OverlayMessageTest extends TestCase
{
    public function test_overlay_is_true_by_default(): void
    {
        $message = new OverlayMessage(['message' => 'Watch out']);
        $this->assertTrue($message->overlay);
    }

    public function test_to_livewire_includes_all_fields(): void
    {
        $message = new OverlayMessage([
            'message' => 'Watch out',
            'title'   => 'Alert',
        ]);

        $result = $message->toLivewire();

        // All Message fields must be present — this was missing in the original bug
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('level', $result);
        $this->assertArrayHasKey('important', $result);
        $this->assertArrayHasKey('dismissable', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('overlay', $result);
        $this->assertTrue($result['overlay']);
    }

    public function test_from_livewire_round_trips_correctly(): void
    {
        $original = new OverlayMessage([
            'message' => 'Watch out',
            'title'   => 'Alert',
        ]);

        $serialized    = $original->toLivewire();
        $reconstructed = OverlayMessage::fromLivewire($serialized);

        $this->assertInstanceOf(OverlayMessage::class, $reconstructed);
        $this->assertEquals($original->message, $reconstructed->message);
        $this->assertEquals($original->title, $reconstructed->title);
        $this->assertTrue($reconstructed->overlay);
    }

    public function test_second_serialization_matches_first(): void
    {
        $message = new OverlayMessage(['message' => 'stable', 'title' => 'Hi']);

        $first  = $message->toLivewire();
        $second = OverlayMessage::fromLivewire($first)->toLivewire();

        $this->assertEquals($first, $second);
    }
}
