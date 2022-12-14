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

namespace Phalcon\Api\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Phalcon\Api\Constants\Relationships;
use Phalcon\Api\Models\Products;

/**
 * Class ProductsTransformer
 */
class ProductsTransformer extends BaseTransformer
{
    protected array $availableIncludes = [
        Relationships::COMPANIES,
        Relationships::PRODUCT_TYPES,
    ];

    /**
     * Includes the companies
     *
     * @param Products $product
     *
     * @return Collection
     */
    public function includeCompanies(Products $product): Collection
    {
        return $this->getRelatedData(
            'collection',
            $product,
            CompaniesTransformer::class,
            Relationships::COMPANIES
        );
    }

    /**
     * Includes the product types
     *
     * @param Products $product
     *
     * @return Item
     */
    public function includeProductTypes(Products $product): Item
    {
        return $this->getRelatedData(
            'item',
            $product,
            BaseTransformer::class,
            Relationships::PRODUCT_TYPES
        );
    }
}
