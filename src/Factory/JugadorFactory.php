<?php

namespace App\Factory;

use App\Entity\Jugador;
use App\Repository\JugadorRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Jugador>
 *
 * @method        Jugador|Proxy create(array|callable $attributes = [])
 * @method static Jugador|Proxy createOne(array $attributes = [])
 * @method static Jugador|Proxy find(object|array|mixed $criteria)
 * @method static Jugador|Proxy findOrCreate(array $attributes)
 * @method static Jugador|Proxy first(string $sortedField = 'id')
 * @method static Jugador|Proxy last(string $sortedField = 'id')
 * @method static Jugador|Proxy random(array $attributes = [])
 * @method static Jugador|Proxy randomOrCreate(array $attributes = [])
 * @method static JugadorRepository|ProxyRepositoryDecorator repository()
 * @method static Jugador[]|Proxy[] all()
 * @method static Jugador[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Jugador[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Jugador[]|Proxy[] findBy(array $attributes)
 * @method static Jugador[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Jugador[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class JugadorFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Jugador::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'nombre' => self::faker()->text(20),
            'altura' => self::faker()->randomFloat(),
            'dorsal' => self::faker()->randomNumber(),
            
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Jugador $jugador): void {})
        ;
    }
}
