<?php
declare(strict_types=1);

class FirstNameTest extends \PHPUnit\Framework\TestCase
{
    public function testLabel()
    {
        self::assertEquals('First Name', (new \Quest\fields\FirstName())->getLabel());
    }
    public function testValue()
    {
        $field = new \Quest\fields\FirstName();
        $field->setValue('  Bob ');
        self::assertEquals('Bob', $field->getValue());
    }
}