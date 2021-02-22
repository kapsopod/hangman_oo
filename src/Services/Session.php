<?php

declare(strict_types=1);

include_once __DIR__ . '/SessionInterface.php';

final class Session implements SessionInterface
{
    public function start(): void
    {
        session_start();
    }

    /**
     * @inheritDoc
     */
    public function set(string $index, $value): void
    {
        $_SESSION[$index] = $value;
    }

    /**
     * @inheritDoc
     */
    public function get(string $index)
    {
        return $_SESSION[$index] ?? null;
    }

    public function isset(string $index): bool
    {
        return isset($_SESSION[$index]);
    }

    public function delete(string $index): void
    {
        if (isset($_SESSION[$index])) {
            unset($_SESSION[$index]);
        }
    }
}
