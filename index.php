<?php
include 'bootstrap.php';

$wordsArray = $session->get('wordsArray');

if (empty($wordsArray)) {
    $wordsArray = $filesToArrayLoader->loadFile(WORD_LIST_FILE);
    $session->set('wordsArray', $wordsArray);
}

$substitutions = [];
$words = new Words($session);
$hidden = $session->get('hidden');

$substitutions['{HANGMAN_PIC}'] = '<img src="pics/6.jpg"><br />';

if ($httpPost->isSet('newWord') || empty($hidden)) {
    $session->delete('answer');
    $session->set('attempts', 0);
    $session->set('wrong_guesses', '');

    $answer = $words->detachRandomWord();
    $session->set('answer', $answer);
    $session->set('hidden', $characterToUnderscoreConverter->convert($answer, ' '));

    $substitutions['{LETTERS_GUESSED}'] = 'Letters guessed wrong: <br />';
}

if ($httpPost->isSet('userInput')) {
    $userInputChecker->check($httpPost->get('userInput'));
    $substitutions['{HANGMAN_PIC}'] = '<img src="pics/' . (MAX_ATTEMPTS - $session->get('attempts')) . '.jpg"><br />';
    $substitutions['{LETTERS_GUESSED}'] = 'Letters guessed wrong: ' . $session->get('wrong_guesses') . "<br />";
}

$substitutions['{ATTEMPTS_REMAINING}'] = 'Attempts remaining: ' . (MAX_ATTEMPTS - $session->get('attempts')) . "<br />";

$hidden = $session->get('hidden');
$attempts = $session->get('attempts');


if (!empty($hidden) && $attempts < MAX_ATTEMPTS) {
        $hiddenWord = '';
        foreach ($hidden as $char) {
            if ($char === ' ') {
                $char = "&nbsp;";
            }

            $hiddenWord .= $char . '&nbsp;';
        }

        $substitutions['{HIDDEN_CHARACTERS}'] = $hiddenWord;
    $substitutions['{FORM}'] = '
<form name="inputForm" action="" method="post">
    Your Guess: <input name="userInput" type="text" size="1" maxlength="1" autocomplete="off" style="text-transform:uppercase" autofocus/>
    <input type="submit" value="Check" onclick="return validateInput()"/>
    <input type="submit" name="newWord" value="Try another Word"/>
</form>';
}

$answer = $session->get('answer');
$substitutions['JIM'] = 'fefewreytr';
if ($attempts >= MAX_ATTEMPTS) {
    $substitutions['{HANGMAN_PIC}'] = '<img src="pics/0.jpg"><br />';
    $message = 'The correct word was ' . implode('', $answer);
    $message .= '<br /><form action = "" method = "post"><input type = "submit" name = "newWord" value = "Try another Word" autofocus/></form><br />';
    $substitutions['{RESULT}'] = $message;
    $substitutions['{FORM}'] = '';
}

if (!empty($hidden) && count(array_diff($hidden, $answer)) === 0) {
    $substitutions['HANGMAN_PIC'] = '<img src="pics/' . (MAX_ATTEMPTS - $attempts) . '.jpg"><br />';
    $message = 'The correct word was indeed ' . implode('', $answer);
    $message .= '<br /><form action = "" method = "post"><input type = "submit" name = "newWord" value = "Try another Word" autofocus/></form><br />';
    $substitutions['{RESULT}'] = $message;
    $substitutions['{FORM}'] = '';
}

echo $template->render($substitutions);

?>
