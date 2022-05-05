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
            'icon'         => [
                'fa' => [
                    'class' => 'fas fa-info-circle'
                ],
                'blade' => [
                    'name' => 'heroicon-s-information-circle',
                    'class' => 'w-6 h-6'
                ]
            ],
        ],
        'success' => [
            'bg-color'     => 'bg-green-100',
            'border-color' => 'border-green-400',
            'icon-color'   => 'text-green-400',
            'text-color'   => 'text-green-800',
            'icon'         => [
                'fa' => [
                    'class' => 'fas fa-check'
                ],
                'blade' => [
                    'name' => 'heroicon-s-check-circle',
                    'class' => 'w-6 h-6'
                ]
            ],
        ],
        'warning' => [
            'bg-color'     => 'bg-yellow-100',
            'border-color' => 'border-yellow-400',
            'icon-color'   => 'text-yellow-400',
            'text-color'   => 'text-yellow-800',
            'icon'         => [
                'fa' => [
                    'class' => 'fas fa-exclamation-circle'
                ],
                'blade' => [
                    'name' => 'heroicon-s-exclamation',
                    'class' => 'w-6 h-6'
                ]
            ],
        ],
        'error' => [
            'bg-color'     => 'bg-red-100',
            'border-color' => 'border-red-400',
            'icon-color'   => 'text-red-400',
            'text-color'   => 'text-red-800',
            'icon'         => [
                'fa' => [
                    'class' => 'fas fa-exclamation-triangle'
                ],
                'blade' => [
                    'name' => 'heroicon-s-exclamation-circle',
                    'class' => 'w-6 h-6'
                ]
            ],
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
        'dismiss' => [
            'fa' => [
                'class' => 'fas fa-times',
            ],
            'blade' => [
                'name' => 'heroicon-s-x',
                'class' => 'w-4 h-4',
            ]
        ]
    ],
    'iconset' => 'fa', // can be null to show no icon at all
];
