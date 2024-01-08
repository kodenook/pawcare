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

    /* The `names` is a static property that holds an array of animal names. Each
    animal name represents a possible value that can be returned by the `nameAnimal()` method in the
    `AnimalProvider` class. */
    protected static $names = [
        'fluffy', 'whiskers', 'nala', 'gizmo', 'mochi',
        'peanut', 'bella', 'simba', 'misty', 'oreo',
        'rocky', 'tinkerbell', 'sparky', 'coco', 'ziggy',
        'sassy', 'pepper', 'oliver', 'luna', 'patches'
    ];

    /* The `diseases` is a static property that holds an array of animal diseases. Each
    animal disease represents a possible value that can be returned by the `diseaseAnimal()` method in the
    `AnimalProvider` class. */
    protected static $diseases = [
        'parvovirus', 'distemper', 'leptospirosis', 'feline panleukopenia', 'feline rhinotracheitis and calicivirus',
        'fleas', 'ticks', 'heartworm', 'intestinal worms', 'giardiasis',
        'allergic dermatitis', 'skin infections', 'fungal infections', 'gastroenteritis', 'pancreatitis',
        'intestinal obstructions', 'inflammatory bowel disease', 'diabetes mellitus', 'hypothyroidism', 'arthritis',
        'periodontal disease', 'dental abscesses', 'conjunctivitis', 'glaucoma', 'cataracts'
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

    /**
     * The function returns a random element from an array of names.
     *
     * @return string
     */
    public static function nameAnimal()
    {
        return static::randomElement(static::$names);
    }

    /**
     * The function returns a random element from an array of diseases.
     *
     * @return string
     */
    public static function diseaseAnimal()
    {
        return static::randomElement(static::$diseases);
    }
}
