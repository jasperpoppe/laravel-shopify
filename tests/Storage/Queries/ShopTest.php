<?php

namespace Osiset\ShopifyApp\Test\Storage\Queries;

use Osiset\ShopifyApp\Contracts\Queries\Shop as IShopQuery;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use Osiset\ShopifyApp\Objects\Values\ShopId;
use Osiset\ShopifyApp\Test\TestCase;

class ShopTest extends TestCase
{
    protected $query;

    public function setUp(): void
    {
        parent::setUp();

        $this->query = $this->app->make(IShopQuery::class);
    }

    public function testShopGetById(): void
    {
        // Create a shop
        $shop = factory($this->model)->create();

        // Query it
        $this->assertNotNull($this->query->getById($shop->getId()));

        // Query non-existant
        $this->assertNull($this->query->getById(new ShopId(10)));
    }

    public function testShopGetByDomain(): void
    {
        // Create a shop
        $shop = factory($this->model)->create();

        // Query it
        $this->assertNotNull($this->query->getByDomain($shop->getDomain()));

        // Query non-existant
        $this->assertNull($this->query->getByDomain(new ShopDomain('non-existant.myshopify.com')));
    }

    public function testShopGetAll(): void
    {
        // Create a shop
        $shop = factory($this->model)->create();

        // Ensure we get a result
        $this->assertEquals(1, $this->query->getAll()->count());
    }
}
