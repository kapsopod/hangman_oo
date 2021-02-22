<?php

declare(strict_types=1);

include_once __DIR__ . '/UserInputCheckerInterface.php';

final class UserInputChecker implements UserInputCheckerInterface
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function check(string $userInput): void
    {
        $answer = $this->session->get('answer');
        $hidden = $this->session->get('hidden');
        $attempts = $this->session->get('attempts');
        $wrongGuesses = $this->session->get('wrong_guesses');

        $userInput = strtoupper($userInput);
        $count = count($answer);
        $wrongGuess = true;

        for ($i = 0; $i < $count; $i++) {
            if (strtoupper($answer[$i]) === $userInput) {
                $hidden[$i] = $userInput;
                $wrongGuess = false;
            }
        }

        if ($wrongGuess && strpos($wrongGuesses, $userInput) === false) {	//if the guess is wrong and it is a new wrong guess, then add it to the wrong guesses string
            $attempts++;
            $wrongGuesses .= ($wrongGuesses == '' ? $userInput : (', ' . $userInput));
        }

        $this->session->set('hidden', $hidden);
        $this->session->set('attempts', $attempts);
        $this->session->set('wrong_guesses', $wrongGuesses);
    }
}
