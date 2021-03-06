<?php
/**
 * File containing the eZ\Publish\API\Repository\Values\Content\Query\SortClause\Target\MapLocationTarget class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version 2014.07.0
 *
 *
 * @package eZ\Publish\API\Repository\Values\Content\Query
 */

namespace eZ\Publish\API\Repository\Values\Content\Query\SortClause\Target;

use eZ\Publish\API\Repository\Values\Content\Query\SortClause\Target;

/**
 * Struct that stores extra value information for a MapLocationDistance SortClause object
 * @package eZ\Publish\API\Repository\Values\Content\Query
 */
class MapLocationTarget extends Target
{
    /**
     * Latitude of a geographical location
     *
     * @var float
     */
    public $latitude;

    /**
     * Longitude of a geographical location
     *
     * @var float
     */
    public $longitude;

    /**
     * Identifier of a targeted Field ContentType
     *
     * @var string
     */
    public $typeIdentifier;

    /**
     * Identifier of a targeted Field FieldDefinition
     *
     * @var string
     */
    public $fieldIdentifier;

    /**
     * Language code of the targeted Field
     *
     * @var null|string
     */
    public $languageCode;

    /**
     * @param float $latitude
     * @param float $longitude
     * @param string $typeIdentifier
     * @param string $fieldIdentifier
     * @param null|string $languageCode
     */
    public function __construct(
        $latitude,
        $longitude,
        $typeIdentifier,
        $fieldIdentifier,
        $languageCode
    )
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->typeIdentifier = $typeIdentifier;
        $this->fieldIdentifier = $fieldIdentifier;
        $this->languageCode = $languageCode;
    }
}
