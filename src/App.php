<?php

namespace Quest;

use Quest\contracts\Input;
use Quest\fields\DateOfBirth;
use Quest\fields\FirstName;
use Quest\fields\LastName;
use Quest\fields\LicenseExpiry;

class App {
    private const QUESTIONS = [
        FirstName::class,
        LastName::class,
        DateOfBirth::class,
        LicenseExpiry::class,
    ];

    /**
     * @var Input[]
     */
    private array $fields = [];

    public function run()
    {
        $this->createFields();
        $this->askQuestions();
        $this->showResponses();
    }

    private function createFields(): void
    {
        foreach(self::QUESTIONS as $questionClass) {
            $this->fields[] = new $questionClass();
        }
    }

    private function askQuestions(): void
    {
        foreach($this->fields as $field) {
            $field->getInput();
        }
    }

    private function showResponses(): void
    {
        echo "\nResponses:\n";
        foreach($this->fields as $field) {
            echo '  - '.$field->getLabel().': '.$field->getValue()."\n";
        }
        echo "\nThank You!\n\n";
    }
}