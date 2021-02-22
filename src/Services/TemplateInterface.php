<?php

declare(strict_types=1);

interface TemplateInterface
{
    public function render(array $substitutions): string;
}
