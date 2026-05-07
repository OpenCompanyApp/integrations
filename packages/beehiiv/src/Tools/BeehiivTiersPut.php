<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update a tier OAuth Scope: tiers:write.
 *
 * Executes the official beehiiv API operation tiers_put.
 */
class BeehiivTiersPut extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_tiers_put';
}
