<?php

namespace App\Storage;

interface ParameterStorageInterface
{
    public function getByDomain(string $domain): array;

    public function get(string $name): ?string;

    public function set(string $domain, string $name, $value): void;
}