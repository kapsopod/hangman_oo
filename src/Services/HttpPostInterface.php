<?php

interface HttpPostInterface
{
    public function get(string $input): ?string;

    public function isSet(string $input): bool;
}
