<?php

interface FileToArrayLoaderInterface
{
    public function loadFile(string $file): array;
}
