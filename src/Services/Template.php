<?php

declare(strict_types=1);

include_once __DIR__ . '/TemplateInterface.php';

final class Template implements TemplateInterface
{
    private const TEMPLATE = __DIR__ . '/../../resources/template.html';

    private const SUBSTITUTIONS_DEFAULT = [
        '{ATTEMPTS_REMAINING}' => '',
        '{LETTERS_GUESSED}' => '',
        '{HIDDEN_CHARACTERS}' => '',
        '{RESULT}' => '',
        '{FORM}' => '',
    ];

    public function render(array $substitutions): string
    {

        if (count(array_intersect(array_keys(self::SUBSTITUTIONS_DEFAULT), array_keys($substitutions))) === 0) {
            throw new Exception(
                sprintf(
                    'Invalid substitutions keys provided "%s", allowed keys are "%s"',
                    implode(', ', $substitutions),
                    implode(', ', self::SUBSTITUTIONS_DEFAULT)
                )
            );
        }

        $template = file_get_contents(self::TEMPLATE);

        $substitutions = array_merge(self::SUBSTITUTIONS_DEFAULT, $substitutions);

        foreach ($substitutions as $substitution => $value) {
            $template = str_replace($substitution, $value, $template);
        }

        return $template;
    }
}
