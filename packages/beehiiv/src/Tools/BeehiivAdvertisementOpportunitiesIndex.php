<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get advertisement opportunities OAuth Scope: posts:read.
 *
 * Executes the official beehiiv API operation advertisementOpportunities_index.
 */
class BeehiivAdvertisementOpportunitiesIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_advertisement_opportunities_index';
}
