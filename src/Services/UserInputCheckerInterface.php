<?php

interface UserInputCheckerInterface
{
    public function check(string $userInput): void;
}
