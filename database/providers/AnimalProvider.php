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

    /* The `breeds` is a static property that holds an array of animal breeds. Each
    animal breed represents a possible value that can be returned by the `breedAnimal()` method in the
    `AnimalProvider` class. */
    protected static $breeds = [
        'persian', 'siamese', 'maine coon', 'ragdoll', 'bengal',
        'thoroughbred', 'arabian', 'quarter horse', 'clydesdale', 'shetland pony',
        'holstein', 'angus', 'hereford', 'jersey', 'charolais',
        'yorkshire', 'hampshire', 'berkshire', 'duroc', 'tamworth',
        'nubian', 'saanen', 'merino', 'suffolk', 'pekin'
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

    /**
     * The function returns a random element from an array of breeds.
     *
     * @return string
     */
    public static function breedAnimal()
    {
        return static::randomElement(static::$breeds);
    }
}
