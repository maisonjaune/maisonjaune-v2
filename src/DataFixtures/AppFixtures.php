<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

abstract class AppFixtures extends Fixture
{
    protected $faker;

    private const EDITORJS_VERSION = "2.26.5";

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    protected function parseEditorJs(array $blocks): string
    {
        return json_encode([
            'time' => strtotime('now'),
            'blocks' => array_map(fn ($block) => [...['id' => strtoupper($this->faker->bothify('????######'))], ...$block], $blocks),
            'version' => self::EDITORJS_VERSION,
        ]);
    }
}
