<?php
/**
 * File containing the Float Value class
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
 * @version 
 */

namespace eZ\Publish\Core\FieldType\Float;

use eZ\Publish\Core\FieldType\Value as BaseValue;

/**
 * Value for Float field type
 */
class Value extends BaseValue
{
    /**
     * Float content
     *
     * @var float
     */
    public $value;

    /**
     * Construct a new Value object and initialize with $value
     *
     * @param float|null $value
     */
    public function __construct( $value = null )
    {
        $this->value = $value;
    }

    /**
     * @see \eZ\Publish\Core\FieldType\Value
     */
    public function __toString()
    {
        return (string)$this->value;
    }
}
