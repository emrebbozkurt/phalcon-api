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

use League\Fractal\Resource\Item;
use Phalcon\Api\Constants\Relationships;
use Phalcon\Api\Models\Individuals;

/**
 * Class IndividualsTransformer
 */
class IndividualsTransformer extends BaseTransformer
{
    /** @var array */
    protected array $availableIncludes = [
        Relationships::COMPANIES,
        Relationships::INDIVIDUAL_TYPES,
    ];

    /** @var string */
    protected string $resource = Relationships::INDIVIDUALS;

    /**
     * Includes the companies
     *
     * @param Individuals $individual
     *
     * @return Item
     */
    public function includeCompanies(Individuals $individual): Item
    {
        return $this->getRelatedData(
            'item',
            $individual,
            CompaniesTransformer::class,
            Relationships::COMPANIES
        );
    }

    /**
     * Includes the product types
     *
     * @param Individuals $individual
     *
     * @return Item
     */
    public function includeIndividualTypes(Individuals $individual): Item
    {
        return $this->getRelatedData(
            'item',
            $individual,
            BaseTransformer::class,
            Relationships::INDIVIDUAL_TYPES
        );
    }
}
