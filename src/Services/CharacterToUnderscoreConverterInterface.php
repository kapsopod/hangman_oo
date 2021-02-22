<?php

interface CharacterToUnderscoreConverterInterface
{
    public function convert(array $value, string $dontConvert): array;
}
