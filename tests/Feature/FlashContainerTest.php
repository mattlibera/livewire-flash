<?php

namespace MattLibera\LivewireFlash\Tests\Feature;

use Livewire\Livewire;
use MattLibera\LivewireFlash\Livewire\FlashContainer;
use MattLibera\LivewireFlash\Message;
use MattLibera\LivewireFlash\OverlayMessage;
use MattLibera\LivewireFlash\Tests\TestCase;

class FlashContainerTest extends TestCase
{
    // ---------------------------------------------------------------------------
    // mount() — session flash path
    // ---------------------------------------------------------------------------

    public function test_mount_with_no_session_messages_is_empty(): void
    {
        $component = Livewire::test(FlashContainer::class);

        $this->assertEmpty($component->get('messages'));
    }

    public function test_mount_stores_session_messages_as_plain_arrays(): void
    {
        session()->flash('flash_notification', collect([
            new Message(['message' => 'Hello', 'level' => 'info']),
        ]));

        $component = Livewire::test(FlashContainer::class);
        $messages  = $component->get('messages');

        $this->assertCount(1, $messages);
        // Must be a plain array, not a Message object — Livewire can't round-trip
        // Wireable objects inside an untyped array property.
        $this->assertIsArray($messages[0]);
        $this->assertEquals('Hello', $messages[0]['message']);
        $this->assertEquals('info', $messages[0]['level']);
    }

    public function test_mount_stores_overlay_session_messages_as_plain_arrays(): void
    {
        session()->flash('flash_notification', collect([
            new OverlayMessage(['message' => 'Watch out', 'title' => 'Alert']),
        ]));

        $component = Livewire::test(FlashContainer::class);
        $messages  = $component->get('messages');

        $this->assertCount(1, $messages);
        $this->assertIsArray($messages[0]);
        $this->assertTrue($messages[0]['overlay']);
        $this->assertEquals('Watch out', $messages[0]['message']);
    }

    // ---------------------------------------------------------------------------
    // flashMessageAdded() — Livewire event path
    // ---------------------------------------------------------------------------

    public function test_flash_message_added_stores_plain_array(): void
    {
        $component = Livewire::test(FlashContainer::class);

        $component->call('flashMessageAdded', [
            'title'      => '',
            'message'    => 'Dynamic message',
            'level'      => 'success',
            'important'  => false,
            'dismissable'=> true,
            'overlay'    => false,
        ]);

        $messages = $component->get('messages');
        $this->assertCount(1, $messages);
        $this->assertIsArray($messages[0]);
        $this->assertEquals('Dynamic message', $messages[0]['message']);
    }

    public function test_flash_message_added_handles_object_input(): void
    {
        // Livewire may reconstruct the event param as a Message object in some
        // versions; the handler must normalise it to a plain array either way.
        $component = Livewire::test(FlashContainer::class);

        $component->call('flashMessageAdded', new Message([
            'message' => 'Object input',
            'level'   => 'warning',
        ]));

        $messages = $component->get('messages');
        $this->assertIsArray($messages[0]);
        $this->assertEquals('Object input', $messages[0]['message']);
    }

    // ---------------------------------------------------------------------------
    // Hydration round-trip — the core regression test
    //
    // Before the fix, storing Message objects in public array $messages caused
    // Livewire v3 to produce a checksum mismatch on the next request, throwing
    // CorruptComponentPayloadException. Calling a second action (dismissMessage)
    // forces a full dehydrate → hydrate cycle; success proves the fix.
    // ---------------------------------------------------------------------------

    public function test_component_survives_subsequent_request_after_flash_message_added(): void
    {
        $component = Livewire::test(FlashContainer::class);

        $component->call('flashMessageAdded', [
            'title'      => '',
            'message'    => 'First',
            'level'      => 'info',
            'important'  => false,
            'dismissable'=> true,
            'overlay'    => false,
        ]);

        // A second request — would throw CorruptComponentPayloadException before the fix
        $component->call('dismissMessage', 0);

        $this->assertEmpty($component->get('messages'));
    }

    public function test_component_survives_subsequent_request_after_overlay_flash(): void
    {
        $component = Livewire::test(FlashContainer::class);

        $component->call('flashMessageAdded', [
            'title'      => 'Alert',
            'message'    => 'Overlay message',
            'level'      => 'info',
            'important'  => false,
            'dismissable'=> true,
            'overlay'    => true,
        ]);

        // Second request — previously would throw on hydration
        $component->call('dismissMessage', 0);

        $this->assertEmpty($component->get('messages'));
    }

    public function test_component_survives_multiple_messages_and_dismissals(): void
    {
        session()->flash('flash_notification', collect([
            new Message(['message' => 'Session message', 'level' => 'info']),
        ]));

        $component = Livewire::test(FlashContainer::class);

        $component->call('flashMessageAdded', [
            'title'      => '',
            'message'    => 'Dynamic message',
            'level'      => 'success',
            'important'  => false,
            'dismissable'=> true,
            'overlay'    => false,
        ]);

        $this->assertCount(2, $component->get('messages'));

        $component->call('dismissMessage', 0);
        $component->call('dismissMessage', 1);

        $this->assertEmpty($component->get('messages'));
    }
}
