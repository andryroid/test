<?php

namespace App\Factory;

use App\Entity\Acteur;
use App\Repository\ActeurRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Acteur>
 *
 * @method        Acteur|Proxy                     create(array|callable $attributes = [])
 * @method static Acteur|Proxy                     createOne(array $attributes = [])
 * @method static Acteur|Proxy                     find(object|array|mixed $criteria)
 * @method static Acteur|Proxy                     findOrCreate(array $attributes)
 * @method static Acteur|Proxy                     first(string $sortedField = 'id')
 * @method static Acteur|Proxy                     last(string $sortedField = 'id')
 * @method static Acteur|Proxy                     random(array $attributes = [])
 * @method static Acteur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ActeurRepository|RepositoryProxy repository()
 * @method static Acteur[]|Proxy[]                 all()
 * @method static Acteur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Acteur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Acteur[]|Proxy[]                 findBy(array $attributes)
 * @method static Acteur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Acteur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ActeurFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'genre' => self::faker()->numberBetween(0,1),
            'nom' => self::faker()->text(10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Acteur $acteur): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Acteur::class;
    }
}
