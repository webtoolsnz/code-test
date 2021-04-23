<?php
declare(strict_types=1);

class DateOfBirthTest extends \PHPUnit\Framework\TestCase
{
    public function testLabel()
    {
        self::assertEquals('Date Of Birth', (new \Quest\fields\DateOfBirth())->getLabel());
    }
    
    public function testValue()
    {
        $field = new \Quest\fields\DateOfBirth();
        $field->setValue('  04/11/2020');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  04.11.2020');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  04-11-2020');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  4/11/2020');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  4.11.2020');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  4-11-2020');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  2020-11-04');
        self::assertEquals('Wed 4th Nov, 2020', $field->getValue());

        $field->setValue('  23/04/21');
        self::assertEquals('Fri 23th Apr, 2021', $field->getValue());

        $field->setValue('  23-04-21');
        self::assertEquals('Fri 23th Apr, 2021', $field->getValue());

        $field->setValue('  23.04.21');
        self::assertEquals('Fri 23th Apr, 2021', $field->getValue());

        $field->setValue('  23/4/21');
        self::assertEquals('Fri 23th Apr, 2021', $field->getValue());

        $field->setValue('  23-4-21');
        self::assertEquals('Fri 23th Apr, 2021', $field->getValue());

        $field->setValue('  23.4.21');
        self::assertEquals('Fri 23th Apr, 2021', $field->getValue());

        $field->setValue('  04-11-24');
        self::assertEquals('Mon 4th Nov, 2024', $field->getValue());

        $field->setValue('  04/11/24');
        self::assertEquals('Mon 4th Nov, 2024', $field->getValue());

        $field->setValue('  04.11.24');
        self::assertEquals('Mon 4th Nov, 2024', $field->getValue());

        $field->setValue('  4-11-24');
        self::assertEquals('Mon 4th Nov, 2024', $field->getValue());

        $field->setValue('  4/11/24');
        self::assertEquals('Mon 4th Nov, 2024', $field->getValue());

        $field->setValue('  4.11.24');
        self::assertEquals('Mon 4th Nov, 2024', $field->getValue());

        $field->setValue('  04/11/30');
        self::assertEquals('Tue 4th Nov, 1930', $field->getValue());

        $field->setValue('  4/11/86');
        self::assertEquals('Tue 4th Nov, 1986', $field->getValue());
    }
}