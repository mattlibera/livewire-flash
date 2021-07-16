# Livewire Flash

This package provides flash message capability using Laravel Livewire. It is based very literally on `laracasts/flash` but has been extended to add the ability to flash a message to a the flash container (a Livewire component) without reloading the page.

 This package also retains much (though not all) of the same capability for "normal" flash messages, which are displayed on refresh by the same Livewire component.

## Installation

Install via composer:

```bash
composer require mattlibera/livewire-flash
```

## Requirements

* Laravel >=7.0
* Livewire ^1.2 or ^2.0

> For new applications, consider using the TALL preset for Laravel: [https://github.com/laravel-frontend-presets/tall], or this package also works well with Laravel Jetstream: [https://jetstream.laravel.com/]

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

### Message types

Message types are defined in the `livewire-flash.php` config file, which can be published (see below) if desired. By default, there are four supported message types: `info` (default if nothing else is specified), `success`, `warning`, and `error`.

To set a message's type, either:

1. Pass it as the second argument to `flash()` - example: `flash('Your action succeeded', 'success')`, or
2. Chain it as a method name fluently after `flash()` - example: `flash('Your action succeeded')->success()`

Both of those will change the message's display (colors and icon) to the configured styles.

### Overlay Message

Overlay message is defined in the `livewire-flash.php` config file, which can be published (see below) if desired.

To set an overlay message, chain the method name `overlay()` after `flash()`. When using overlay leave the `flash()` parameter empty. Enter your message as the first parameter and title as second parameter for `overlay()`. This can be used with or without the `livewire($this)` suffix:

```
// renders on next page load
flash()->overlay('This is my message', 'The Title');
return redirect('somewhere');

// renders immediately via Livewire
flash()->overlay('This is my message', 'The Title')->livewire($this);
```

Note that the out-of-the-box overlay component does support HTML code for the body and title, using the Blade unescaped `{!! !!}` tags.

### Customization

To change the styles used by each message type, OR to add your own types, first publish the config file:

```bash
php artisan vendor:publish --provider="MattLibera\LivewireFlash\LivewireFlashServiceProvider"
```

Then, in the `styles` key you can change whatever you want:

```php
'styles' => [
    'info' => [
        'bg-color'     => 'bg-blue-100', // could change to bg-purple-100, or something.
        'border-color' => 'border-blue-400',
        'icon-color'   => 'text-blue-400',
        'text-color'   => 'text-blue-800',
        'ticker-color' => 'bg-blue-600',
        'icon'         => 'fas fa-info-circle', // could change to another FontAwesome icon
    ],
```

Or you can add your own:

```php
'notice' => [
    'bg-color'     => 'bg-orange-100',
    'border-color' => 'border-orange-400',
    'icon-color'   => 'text-orange-400',
    'text-color'   => 'text-orange-800',
    'ticker-color' => 'bg-orange-600',
    'icon'         => 'fas fa-flag',
],
```

Whatever the case, just ensure that you call the alert by its config key: `flash('An important message')->notice()`

To customize overlay styles, see the `overlay` key of the config file.

## Templates

Out of the box, the Livewire Flash Container component is registered for you. All you have to do is include it in your template:

```html
<livewire:flash-container />
```

There are also some sample alert components (styled using TailwindCSS) included with this package. However, if you do not wish to use those...

### Customization

You can change the views that the Livewire components use for rendering, and the styles applied to each message type.

> If you are not using TailwindCSS and/or FontAwesome, you should definitely do this to call your own alert component/partial to fit whatever your stack is using.

First, publish the config file:

```bash
php artisan vendor:publish --provider="MattLibera\LivewireFlash\LivewireFlashServiceProvider"
```

Then, edit the `views` area:

```php
'views' => [
    'container' => 'livewire-flash::livewire.flash-container',
    'message'   => 'partials.my-bootstrap-flash',
],
```

You can access the public message properties on `MattLibera\LivewireFlash\Message`, as well as `$styles` (which is injected via the Livewire component) in your template.

## Dismissable Messages

By default, each message will be set to be dismissable (that is, have an X icon at the right that will close the alert). If you wish to prevent this, you can chain `->notDismissable()` (or `->dismissable(false)`) to your flash directive.

_Note that the overlay does not support this directive._

## Auto-dismissing Messages

By default, a message will persist on the screen until it is dismissed manually. If you wish to implement an auto-dismissing message, that will dismiss itself after X seconds, you can use `->dismissAfter(X)` (e.g. `->dismissAfter(3)` for 3 seconds). The default message and container files have added code that should handle this for you using vanilla Javascript and embedded CSS.

In addition, the auto-dismiss will pause if moused-over. Currently this is not configurable in the API, but if you wish to remove this feature, you can always publish and customize your own view file for the container, and remove the `mouseenter` and `mouseleave` bindings.

_Note that the overlay does not support this directive._

## Multiple Flash Messages

Multiple flash messages can be sent to the session:

```php
// anywhere
flash('Message 1');
flash('Message 2')->warning();

return redirect('somewhere');
```

OR

```php
// livewire component
flash('Message 1')->livewire($this);
flash('Message 2')->warning()->livewire($this);
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

Some considerations for future versions:

- Fluent options for setting an icon or colors on the fly
- Message bags / sets, so that multiple containers may be used on a page

# Credits and License

Credit for the original package goes to Jeffrey Way and Laracasts. Additional thanks:

* Caleb Porzio and his Livewire contributors for the awesome framework
* Adam Wathan and the Tailwind crew
* Taylor Otwell and co. for Laravel

This is an MIT-licensed package. Please read license.md for the details.
