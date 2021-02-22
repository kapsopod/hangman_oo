<?php

declare(strict_types=1);

include_once __DIR__ . '/HttpPostInterface.php';

final class HttpPost implements HttpPostInterface
{
    public function get(string $input): ?string
    {
        return $_POST[$input] ?? null;
    }

    public function isSet(string $input): bool
    {
        return isset($_POST[$input]) && !empty($_POST[$input]);
    }
}

