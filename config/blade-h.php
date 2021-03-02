<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Components Prefix
    |--------------------------------------------------------------------------
    |
    | This value will set a prefix for all BladeH components.
    | By default it's empty. This is useful if you want to avoid
    | collision with components from other libraries.
    |
    | If set with "wow", for example, you can reference components like:
    |
    | <H:wow-asset />
    |
    */

    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    | All BladeH components are referenced below.
    | You can disable, extend/overwrite any component.
    | You can also rename alias from here.
    |
    */
    'components' => [
        'asset' => Hotash\BladeH\Components\Asset::class,
        'img' => Hotash\BladeH\Components\Tags\ImgTag::class,
        'a' => Hotash\BladeH\Components\Tags\AnchorTag::class,
        'form' => Hotash\BladeH\Components\Forms\Form::class,
        'input' => Hotash\BladeH\Components\Forms\Inputs\Input::class,
        'email' => Hotash\BladeH\Components\Forms\Inputs\Input::class,
        'hidden' => Hotash\BladeH\Components\Forms\Inputs\Input::class,
        'number' => Hotash\BladeH\Components\Forms\Inputs\Input::class,
        'password' => Hotash\BladeH\Components\Forms\Inputs\Input::class,
        'textarea' => Hotash\BladeH\Components\Forms\Inputs\Textarea::class,
        'label' => Hotash\BladeH\Components\Forms\Label::class,
    ],

];
