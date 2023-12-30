<?php

namespace Database\Providers;

use faker\Provider\Base;

class AnimalProvider extends Base
{
    /* The `types` is a static property that holds an array of animal types. Each
    animal type represents a possible value that can be returned by the `typeAnimal()` method in the
    `AnimalProvider` class. */
    protected static $types = [
        'cat', 'dog', 'mouse',  'cow', 'pig',
        'chicken', 'rooster', 'sheep', 'goat', 'duck',
        'rabbit', 'horse', 'donkey', 'lion', 'tiger',
        'elephant', 'giraffe', 'zebra', 'monkey', 'gorilla',
        'penguin', 'kangaroo', 'hippopotamus', 'panda', 'koala'
    ];

    /**
     * The function returns a random element from an array of types.
     *
     * @return string
     */
    public static function typeAnimal()
    {
        return static::randomElement(static::$types);
    }
}
