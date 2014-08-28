<?php
/**
 * File containing the ParameterProviderInterface interface.
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
 * @version 
 */

namespace eZ\Publish\Core\MVC\Symfony\FieldType\View;

use eZ\Publish\API\Repository\Values\Content\Field;

/**
 * Interface for services providing additional parameters to a fieldtype's view template (using ez_render_field() helper).
 * Each instance of this interface needs to be correctly registered in the ParameterProviderRegistry.
 *
 * @see \eZ\Publish\Core\MVC\Symfony\FieldType\View\ParameterProviderRegistryInterface
 */
interface ParameterProviderInterface
{
    /**
     * Returns a hash of parameters to inject to the associated fieldtype's view template.
     * Returned parameters will only be available for associated field type
     *
     * Key is the parameter name (the variable name exposed in the template, in the 'parameters' array).
     * Value is the parameter's value.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\Field $field The field parameters are provided for.
     *
     * @return array
     */
    public function getViewParameters( Field $field );
}
