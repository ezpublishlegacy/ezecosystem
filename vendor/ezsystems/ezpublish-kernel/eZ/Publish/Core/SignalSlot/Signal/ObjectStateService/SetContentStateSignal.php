<?php
/**
 * SetContentStateSignal class
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
 * @version 
 */

namespace eZ\Publish\Core\SignalSlot\Signal\ObjectStateService;

use eZ\Publish\Core\SignalSlot\Signal;

/**
 * SetContentStateSignal class
 * @package eZ\Publish\Core\SignalSlot\Signal\ObjectStateService
 */
class SetContentStateSignal extends Signal
{
    /**
     * ContentId
     *
     * @var mixed
     */
    public $contentId;

    /**
     * ObjectStateGroupId
     *
     * @var mixed
     */
    public $objectStateGroupId;

    /**
     * ObjectStateId
     *
     * @var mixed
     */
    public $objectStateId;
}
