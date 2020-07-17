# Livewire Flash

This package provides flash message capability using Laravel Livewire. It is based very literally on `laracasts/flash` but has been extended to add the ability to flash a message to a the flash container (a Livewire component) without reloading the page.

 This package also retains much (though not all) of the same capability for "normal" flash messages, which are displayed on refresh by the same Livewire component.

## Installation

Install via composer:

```bash
composer require mattlibera/livewire-flash
```

## Usage

### Normal flash messages (on reload)

Call the `flash()` helper from your code somewhere, before you redirect.

```php
public function store()
{
    flash('Success!');

    return redirect()->back();
}
```

### Livewire flash message (before reload)

Call the `lwflash()` helper method from your Livewire component. You must pass in `$this` as the first argument, as this package utilizes the `emit` helper that exists on all Livewire components. Ex

```php
public function livewireAction()
{
    lwflash($this, 'Success!', 'success');
}
```

### Chaining

Chaining the alert type is available only on the traditional flash messages for now. This is on the roadmap to examine, but for the time being you must pass in the type of message as the third argument to `lwflash()`.

If using `flash()`:

- `flash('Message')->success()`: Set the flash theme to "success".
- `flash('Message')->error()`: Set the flash theme to "danger".
- `flash('Message')->warning()`: Set the flash theme to "warning".
- `flash()->overlay('Modal Message', 'Modal Title')`: Display a modal overlay with a title.
- `flash('Message')->important()`: Add a close button to the flash message.
- `flash('Message')->error()->important()`: Render a "danger" flash message that must be dismissed.

## Templates

Out of the box, the Livewire Flash Container component is registered for you. All you have to do is include it:

```html
<livewire:flash-container />
```

There are also some sample alert components (styled using TailwindCSS, and dismissable using AlpineJS) included with this package. However, if you do not wish to use those...

### Customization

The config file `livewire-flash.php` can be published by running:

```bash
php artisan vendor:publish --provider="MattLibera\LivewireFlash\LivewireFlashServiceProvider"
```

Then, you can change the views that the Livewire components use for rendering. Since the built-in alert components are called by the `flash-message` component itself, you should customize that view to call your own alert components/partials if you wish to change this.

## Dismissable Messages

By default, each message will be set to be dismissable (that is, have an X icon at the right that will close the alert). If you wish to prevent this, you can chain `->notDismissable()` to your *normal* flash messages.

(It's on the roadmap to make this same thing happen for Livewire messages, but... not right now.)

You can add your own magic via AlpineJS or whatever else if you want to fade messages out automatically.

## Multiple Flash Messages

Multiple flash messages can be sent to the session:

```php
// anywhere
flash('Message 1');
flash('Message 2')->important();

return redirect('somewhere');
```

OR

```php
// livewire component
lwflash('Message 1');
lwflash('Message 2');
```


