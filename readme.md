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

## Templates

Out of the box, the Livewire Flash Container component is registered for you. All you have to do is include it in your template:

```html
<livewire:flash-container />
```

There are also some sample alert components (styled using TailwindCSS) included with this package. However, if you do not wish to use those, publish the views and replace their markup and styles with your own:

```bash
php artisan vendor:publish --tag="livewire-flash-views"
```

## Dismissable Messages

By default, each message will be set to be dismissable (that is, have an X icon at the right that will close the alert). If you wish to prevent this, you can chain `->notDismissable()` (or `->dismissable(false)`) to your flash directive.

You can add your own magic via AlpineJS or whatever else if you want to fade messages out automatically - right now each message is a Livewire component and uses Livewire logic to hide it when it is dismissed.

_Note that the overlay does not support this directive._

## Auto-Dismissing Messages

You can automatically dismiss messages by appending `->dismissAfter(5);` where the number is the number of seconds to display the message before removing it.

The default templates include a nice countdown progress bar indicating when the message will be dismissed. The countdown pauses and resumes on mouseover/mouseout.

_Note that the overlay does not support this directive._

_Known issue: auto-dismiss only works with a single flash message, if multiple are displayed only one will be automatically dismissed, the rest will have to be manually dismissed, but will still display their countdown meter, which then resets on completion._
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
✅ Auto-dismissing option for flash messages

# Credits and License

Credit for the original package goes to Jeffrey Way and Laracasts. Additional thanks:

* Caleb Porzio and his Livewire contributors for the awesome framework
* Adam Wathan and the Tailwind crew
* Taylor Otwell and co. for Laravel

This is an MIT-licensed package. Please read license.md for the details.
