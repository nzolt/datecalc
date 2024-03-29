<?php

namespace Tests\Unit;

use App\Data\Validators\NameValidator;
use App\Data\Validators\Exceptions\InvalidNameException;
use PHPUnit\Framework\TestCase;

class NameValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * A Date is valid.
     *
     * @return void
     */
    public function testValidNameTest()
    {
        $validator = NameValidator::validateName('John Doe');
        $this->assertTrue($validator);

        $validator = NameValidator::validateName('Mr. John Doe');
        $this->assertTrue($validator);
    }

    /**
     * A Date is invalid.
     *
     * @return void
     */
    public function testInvalidNameTest()
    {
        $this->expectException(InvalidNameException::class);
        $valid = NameValidator::validateName('john.doe99');
        $this->assertFalse($valid);

        $this->expectException(InvalidNameException::class);
        $valid = NameValidator::validateName('John_Doe');
        $this->assertFalse($valid);
    }

    /**
     * A Date is invalid.
     *
     * @return void
     */
    public function testEmptyNameTest()
    {
        $this->expectException(InvalidNameException::class);
        $valid = NameValidator::validateName('');
        $this->assertFalse($valid);
    }
}
