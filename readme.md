# Livewire Flash

This package provides flash message capability using Laravel Livewire. It is based very literally on `laracasts/flash` but has been extended to add the ability to flash a message to a the flash container (a Livewire component) without reloading the page.

 This package also retains much (though not all) of the same capability for "normal" flash messages, which are displayed on refresh by the same Livewire component.

## Installation

Install via composer:

```bash
composer require mattlibera/livewire-flash
```

## Requirements

* Laravel 7.0 or above
* Livewire, obviously.

> For new applications, consider using the TALL preset for Laravel: https://github.com/laravel-frontend-presets/tall

## Recommended add-ons

Out of the box, the default alert component uses:

* TailwindCSS
* FontAwesome

However, it's fairly trivial to implement your own views / styles instead, by publishing the config and overriding defaults. See below for more on that.

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

 From your Livewire component, flash your message using the normal syntax, but then call the `livewire()` helper method as the last method in the chain. You must pass in `$this` as the argument, as this package utilizes the `emit` helper that exists on all Livewire components. Example:

```php
public function livewireAction()
{
    flash('Your request was successful!')->success()->livewire($this);
}
```

### Chaining

- `flash('Message')->success()`: Set the flash theme to "success".
- `flash('Message')->error()`: Set the flash theme to "danger".
- `flash('Message')->warning()`: Set the flash theme to "warning".
- `flash('Message')->notDismissable()`: Remove the close button on the flash message.
- `flash('Message')->error()->notDismissable()`: Render a "danger" flash message that cannot be dismissed.

## Templates

Out of the box, the Livewire Flash Container component is registered for you. All you have to do is include it in your template:

```html
<livewire:flash-container />
```

There are also some sample alert components (styled using TailwindCSS) included with this package. However, if you do not wish to use those...

### Customization

The config file `livewire-flash.php` can be published by running:

```bash
php artisan vendor:publish --provider="MattLibera\LivewireFlash\LivewireFlashServiceProvider"
```

Then, you can change the views that the Livewire components use for rendering, and the styles applied to each message type. If you are not using TailwindCSS and/or FontAwesome, you should customize that view to call your own alert component/partial to fit whatever your stack is using.

If you ARE using TailwindCSS and FontAwesome, this config class can still be published to tweak the color classes and icon classes that are used for each message.

```php
'styles' => [
    'info' => [
        'bg-color'     => 'bg-blue-100', // could change to bg-purple-100, or something.
        'border-color' => 'border-blue-400',
        'icon-color'   => 'text-blue-400',
        'text-color'   => 'text-blue-800',
        'icon'         => 'fas fa-info-circle', // could change to another FontAwesome icon
    ],
```

## Dismissable Messages

By default, each message will be set to be dismissable (that is, have an X icon at the right that will close the alert). If you wish to prevent this, you can chain `->notDismissable()` (or `->dismissable(false)`) to your flash directive.

You can add your own magic via AlpineJS or whatever else if you want to fade messages out automatically - right now each message is a Livewire component and uses Livewire logic to hide it when it is dismissed.

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
flash('Message 1')->livewire($this);
flash('Message 2')->livewire($this);
```

However, at the moment, because of the way Livewire handles the session, you *cannot* mix-and-match... that is, you cannot do:

```php
// livewire component
flash('Message 1'); // this one will get lost.
flash('Message 2')->livewire($this); // this one will show on current page via Livewire

```

# Contributing

I am open to contributions to this package, and will do the best I can to maintain it over time. Pull requests are welcome, and in fact encouraged. Right now there are no specific guidelines for a PR.

# Road Map

- Ability to define more/custom alert types via config (tapping into `__call` on the Notifier class, probably)

# Credits and License

Credit for the original package goes to Jeffrey Way and Laracasts. Additional thanks:

* Caleb Porzio and his Livewire contributors for the awesome framework
* Adam Wathan and the Tailwind crew
* Taylor Otwell and co. for Laravel

This is an MIT-licensed package. Please read license.md for the details.

