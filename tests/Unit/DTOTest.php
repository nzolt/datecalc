<?php

namespace Tests\Unit;

use App\Data\DTOdateTime;
use PHPUnit\Framework\TestCase;

class DTOTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDTOdateSuccessTest()
    {
        $dto = new DTOdateTime('1967/05/09', 'Y/m/d H:i', '2019/11/25 07:45');
        $this->assertInstanceOf('App\Data\DTOdateTime', $dto);
        $this->assertSame(52, $dto->getDiffYears());
        $this->assertSame(18996, $dto->getDiffDays());
        $this->assertSame(460639, $dto->getDiffHours());

        $dto = new DTOdateTime('1967/05/09 13:25', 'Y/m/d H:i', '2019/11/25 07:45');
        $this->assertInstanceOf('App\Data\DTOdateTime', $dto);
        $this->assertSame(52, $dto->getDiffYears());
        $this->assertSame(18995, $dto->getDiffDays());
        $this->assertSame(460626, $dto->getDiffHours());
    }

    public function testDTOdateWrongTest()
    {
        $dto = new DTOdateTime('1967-05 09', 'Y/m/d H:i', '2019/11/25 07:45');
        $this->assertInstanceOf('App\Data\DTOdateTime', $dto);
        $this->assertSame(0, $dto->getDiffYears());
        $this->assertSame(0, $dto->getDiffDays());
        $this->assertSame(0, $dto->getDiffHours());
    }

    public function testDTOdateArrayTest()
    {
        $dto = new DTOdateTime('1967-05 09', 'Y/m/d H:i', '2019/11/25 07:45');
        $this->assertIsArray($dto->__toArray());
    }
}