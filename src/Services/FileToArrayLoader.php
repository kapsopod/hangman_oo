<?php

declare(strict_types=1);

include_once __DIR__ . '/FileToArrayLoaderInterface.php';

final class FileToArrayLoader implements FileToArrayLoaderInterface
{
    public function loadFile(string $file): array
    {
        if (is_file($file) && is_readable($file)) {
            return array_map(
                'trim',
                explode("\n", file_get_contents($file)
                )
            );
        }

        throw new Exception(
            sprintf(
                'Could not read file "%s"',
                $file
            )
        );
    }
}
