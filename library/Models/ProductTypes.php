<?php

/**
 * This file is part of the Phalcon API.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Api\Models;

use Phalcon\Api\Constants\Relationships;
use Phalcon\Api\Mvc\Model\AbstractModel;
use Phalcon\Filter\Filter;

/**
 * Class ProductTypes
 */
class ProductTypes extends AbstractModel
{
    /**
     * Initialize relationships and model properties
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->setSource('co_product_types');

        $this->hasMany(
            'id',
            Products::class,
            'typeId',
            [
                'alias'    => Relationships::PRODUCTS,
                'reusable' => true,
            ]
        );

        parent::initialize();
    }

    /**
     * Model filters
     *
     * @return array<string,string>
     */
    public function getModelFilters(): array
    {
        return [
            'id'          => Filter::FILTER_ABSINT,
            'name'        => Filter::FILTER_STRING,
            'description' => Filter::FILTER_STRING,
        ];
    }
}
