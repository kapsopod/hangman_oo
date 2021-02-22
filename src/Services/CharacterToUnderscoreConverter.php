<?php

declare(strict_types=1);

include_once __DIR__ . '/CharacterToUnderscoreConverterInterface.php';

final class CharacterToUnderscoreConverter implements CharacterToUnderscoreConverterInterface
{
    public function convert(array $value, string $dontConvert): array
    {
        return array_map(
            fn($word) => $word == $dontConvert ? $word : '_',
            $value
        );
    }
}

/*
final class CharacterToUnderscoreConverter implements CharacterToUnderscoreConverterInterface
{
    public function convert(array $value): array
    {
        return array_map(
            fn($word) => $word == ' ' ? $word : '_',
            $value
        );
    }
}
*/
/*
final class CharacterToUnderscoreConverter implements CharacterToUnderscoreConverterInterface
{
    public function convert(array $value): array
    {
        return array_map(
            fn($word) => empty($word) ? $word : '_',
            $value
        );
    }
}   
*/
