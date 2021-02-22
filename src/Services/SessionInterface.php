<?php

declare(strict_types=1);

interface SessionInterface
{
    public function start(): void;

    /**
     * @param string|int|array $value
     */
    public function set(string $index, $value): void;

    /**
     * @return string|int|array|null
     */
    public function get(string $index);

    public function isSet(string $index): bool;

    public function delete(string $index): void;
}
