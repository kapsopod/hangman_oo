<?php

declare(strict_types=1);

include_once __DIR__ . '/WordsInterface.php';

final class Words implements WordsInterface
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function detachRandomWord(): ?array
    {
        $words = $this->session->get('wordsArray');

        if (empty($words)) {
            return null;
        }

        $randomKey = array_rand($words);
        $randomWord = str_split(strtoupper($words[$randomKey]));

        unset($words[$randomKey]);

        $this->session->set('wordsArray', $words);

        return $randomWord;
    }
}
