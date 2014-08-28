<?php
/**
 * MoveUserGroupSignal class
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
 * @version 
 */

namespace eZ\Publish\Core\SignalSlot\Signal\UserService;

use eZ\Publish\Core\SignalSlot\Signal;

/**
 * MoveUserGroupSignal class
 * @package eZ\Publish\Core\SignalSlot\Signal\UserService
 */
class MoveUserGroupSignal extends Signal
{
    /**
     * UserGroupId
     *
     * @var mixed
     */
    public $userGroupId;

    /**
     * NewParentId
     *
     * @var mixed
     */
    public $newParentId;
}
