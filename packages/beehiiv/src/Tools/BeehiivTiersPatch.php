<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update a tier OAuth Scope: tiers:write.
 *
 * Executes the official beehiiv API operation tiers_patch.
 */
class BeehiivTiersPatch extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_tiers_patch';
}
