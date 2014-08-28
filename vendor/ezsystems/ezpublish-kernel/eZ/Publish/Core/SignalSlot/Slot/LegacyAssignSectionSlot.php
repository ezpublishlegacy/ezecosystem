<?php
/**
 * File containing the Legacy\AssignSectionSlot class
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
 * @version 
 */

namespace eZ\Publish\Core\SignalSlot\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use eZ\Publish\Core\SignalSlot\Slot\AbstractLegacySlot;
use eZContentCacheManager;
use eZContentObject;
use eZSearch;

/**
 * A legacy slot handling AssignSectionSignal.
 */
class LegacyAssignSectionSlot extends AbstractLegacySlot
{
    /**
     * Receive the given $signal and react on it
     *
     * @param \eZ\Publish\Core\SignalSlot\Signal $signal
     *
     * @return void
     */
    public function receive( Signal $signal )
    {
        if ( !$signal instanceof Signal\SectionService\AssignSectionSignal )
            return;// @todo Error Logging? No exception seem to be defined for this case

        $kernel = $this->getLegacyKernel();
        $kernel->runCallback(
            function () use ( $signal )
            {
                eZContentCacheManager::clearContentCacheIfNeeded( $signal->contentId );
                eZSearch::updateObjectsSection( array( $signal->contentId ), $signal->sectionId );
                eZContentObject::clearCache();// Clear all object memory cache to free memory
            },
            false
        );
    }
}
