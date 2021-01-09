<?php

return [
    'views' => [
        'container' => 'livewire-flash::livewire.flash-container',
        'message'   => 'livewire-flash::livewire.flash-message',
        'overlay'   => 'livewire-flash::livewire.flash-overlay',
    ],
    'styles' => [
        'info' => [
            'bg-color'     => 'bg-blue-100',
            'border-color' => 'border-blue-400',
            'icon-color'   => 'text-blue-400',
            'text-color'   => 'text-blue-800',
            'icon'         => 'fas fa-info-circle',
        ],
        'success' => [
            'bg-color'     => 'bg-green-100',
            'border-color' => 'border-green-400',
            'icon-color'   => 'text-green-400',
            'text-color'   => 'text-green-800',
            'icon'         => 'fas fa-check',
        ],
        'warning' => [
            'bg-color'     => 'bg-yellow-100',
            'border-color' => 'border-yellow-400',
            'icon-color'   => 'text-yellow-400',
            'text-color'   => 'text-yellow-800',
            'icon'         => 'fas fa-exclamation-circle',
        ],
        'error' => [
            'bg-color'     => 'bg-red-100',
            'border-color' => 'border-red-400',
            'icon-color'   => 'text-red-400',
            'text-color'   => 'text-red-800',
            'icon'         => 'fas fa-exclamation-triangle',
        ],
        'overlay' => [
            'overly-bg-color' => 'bg-gray-500',
            'overlay-bg-opacity' => 'opacity-75',

            'title-text-color' => 'text-gray-900',

            'body-text-color' => 'text-gray-500',

            'button-border-color' => 'border-transparent',
            'button-bg-color' => 'bg-indigo-600',
            'button-text-color' => 'text-white',

            'button-hover-bg-color' => 'hover:bg-indigo-700',
            'button-hover-text-color' => 'hover:text-white',
            'button-focus-ring-color' => 'focus:ring-indigo-500',

            'button-extra-classes' => '',

            'button-text' => 'Close',
        ],
    ],
];
