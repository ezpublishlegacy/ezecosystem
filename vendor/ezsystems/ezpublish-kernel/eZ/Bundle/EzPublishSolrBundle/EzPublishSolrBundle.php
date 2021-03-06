<?php
/**
 * File containing the EzPublishSolrBundle class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version 2014.07.0
 */

namespace eZ\Bundle\EzPublishSolrBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use eZ\Publish\Core\Base\Container\Compiler\Storage\Solr\AggregateCriterionVisitorPass;
use eZ\Publish\Core\Base\Container\Compiler\Storage\Solr\AggregateFacetBuilderVisitorPass;
use eZ\Publish\Core\Base\Container\Compiler\Storage\Solr\AggregateFieldValueMapperPass;
use eZ\Publish\Core\Base\Container\Compiler\Storage\Solr\AggregateSortClauseVisitorPass;
use eZ\Publish\Core\Base\Container\Compiler\Storage\Solr\FieldRegistryPass;
use eZ\Publish\Core\Base\Container\Compiler\Storage\Solr\SignalSlotPass;

class EzPublishSolrBundle extends Bundle
{
    public function build( ContainerBuilder $container )
    {
        parent::build( $container );
        $container->addCompilerPass( new AggregateCriterionVisitorPass );
        $container->addCompilerPass( new AggregateFacetBuilderVisitorPass );
        $container->addCompilerPass( new AggregateFieldValueMapperPass );
        $container->addCompilerPass( new AggregateSortClauseVisitorPass );
        $container->addCompilerPass( new FieldRegistryPass );
        $container->addCompilerPass( new SignalSlotPass );
    }
}
