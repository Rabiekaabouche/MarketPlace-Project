<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\Data;
use App\Repositories\Repository;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->data = new Data();
        $this->repository = new Repository();
        $this->repository->createDatabase();
    }

    function testInsertClient(): void
    {
        $client = $this->data->Clients();
        $this->repository->addUser('jc@gmail.com', 'secret', 0);
        $this->assertEquals($this->repository->insertClient($client[0]), 1);
    }

    function testInsertVendeur(): void
    {
        $vendeur = $this->data->Vendeurs();
        $this->repository->addUser('victor@gmail.com', 'secret', 0);
        $this->assertEquals($this->repository->insertVendeur($vendeur[0]), 2);
    }

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
