<?php

namespace Phalcon\Api\Tests\integration\library\Models;

use IntegrationTester;
use Phalcon\Api\Constants\Relationships;
use Phalcon\Api\Models\Products;
use Phalcon\Api\Models\ProductTypes;
use Phalcon\Filter\Filter;

class ProductTypesCest
{
    /**
     * @param IntegrationTester $I
     *
     * @return void
     */
    public function validateModel(IntegrationTester $I)
    {
        $I->haveModelDefinition(
            ProductTypes::class,
            [
                'id',
                'name',
                'description',
            ]
        );
    }

    /**
     * @param IntegrationTester $I
     *
     * @return void
     */
    public function validateFilters(IntegrationTester $I)
    {
        $model    = new ProductTypes();
        $expected = [
            'id'          => Filter::FILTER_ABSINT,
            'name'        => Filter::FILTER_STRING,
            'description' => Filter::FILTER_STRING,
        ];
        $I->assertSame($expected, $model->getModelFilters());
    }

    /**
     * @param IntegrationTester $I
     *
     * @return void
     */
    public function validateRelationships(IntegrationTester $I)
    {
        $actual   = $I->getModelRelationships(ProductTypes::class);
        $expected = [
            [
                2,
                'id',
                Products::class,
                'typeId',
                ['alias' => Relationships::PRODUCTS, 'reusable' => true]
            ],
        ];
        $I->assertSame($expected, $actual);
    }
}
