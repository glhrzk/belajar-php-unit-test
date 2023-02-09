<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\TestCase;

use PHPUnit\Util\Exception;

use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\once;

class ProductServiceMockTest extends TestCase
{
    private ProductRepository $repository;
    private ProductService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ProductRepository::class);
        $this->service = new ProductService($this->repository);
    }

    /**
     * @test
     */
    public function Stub()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->method("findById")->willReturn($product);

        $result = $this->repository->findById("1");
        $this->assertSame($product, $result);
    }

    /** @test */
    public function StubMap()
    {
        $product1 = new Product();
        $product1->setId("1");

        $product2 = new Product();
        $product2->setId("2");


        $map = [
            ["1", $product1],
            ["2", $product2],
        ];

        $this->repository->method("findById")
            ->willReturnMap(
                $map
            );

        $this->assertSame($product1, $this->repository->findById("1"));
        $this->assertSame($product2, $this->repository->findById("2"));
    }

    /** @test */
    public function StubCallback()
    {
        $this->repository->method("findById")
            ->willReturnCallback(
                function (string $id) {
                    $product = new Product();
                    $product->setId($id);

                    return $product;
                }
            );

        $this->assertEquals("1", $this->repository->findById("1")->getId());
        $this->assertEquals("2", $this->repository->findById("2")->getId());
        $this->assertEquals("3", $this->repository->findById("3")->getId());
    }


    /** @test */
    public function RegisterSuccess()
    {
        $this->repository->method("findById")->willReturn(null);
        $this->repository->method("save")->willReturnArgument(0);
        /**
         * willReturnArgument, sama saja dengan -> function register, memanggil -> interface repository, memanggil -> function save (dengan parameter Product)
         * maka akan dikirim balik si parameter produknya, karena di argumennya di set 0.
         */
        $product = new Product();
        $product->setId("1");
        $product->setName("Contoh");

        $result = $this->service->register($product);


        /**
         * Equals artinya membandingkan 2 buat object.
         * dengan memandingkan data object saat ini product dengan result yang tadi dikirimkan.
         */
        $this->assertEquals($product->getId(), $result->getId());
        $this->assertEquals($product->getName(), $result->getName());
    }


    /** @test */
    public function RegisterException()
    {
        $this->expectException(Exception::class);

        $productInDB = new Product();
        $productInDB->setId("1");

        $this->repository->method("findById")->willReturn($productInDB);

        $product = new Product();
        $product->setId("1");

        $this->service->register($product);
    }

    /** @test */
    public function DeleteSuccess()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->expects(self::once())
            ->method("delete")
            ->with(self::equalTo($product));

        $this->repository->method("findById")->willReturn($product);

        /**
         * kenapa harus method findById yang kita return Stub object?
         * karena di dalam function delete (yang ada dalam service) itu memanggil findById, jika datanya tidak ditemukan maka akan Exception
         */

        $this->service->delete("1");
        $this->assertTrue(true, "Success delete");
    }

    /** @test */
    public function DeleteException()
    {
        $this->repository->expects(self::once())
            ->method("delete");

        $this->expectException(Exception::class);

        $this->repository->method("findById")
            ->willReturn(\null)
            ->with(self::equalTo("1"));

        $this->service->delete("1");
    }

    /** @test */
    public function Mock()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->expects(self::once())
            ->method("findById")
            ->willReturn($product);

        $result = $this->repository->findById("2");

        $this->assertEquals($product->getId(), $result->getId());
    }
}
